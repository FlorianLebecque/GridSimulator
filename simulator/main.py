import time
import pymysql.cursors 
import json


from Database import Db 
from clientSocket import Socket as S

from datalog import Datalog
#from classCreation import nodeCreator
#from node.node import Node
from sim_time import s_stime


#######################################   CREATION CONNECION DB   ####################################


connDb = Db('localhost','root','','projet_poo','utf8mb4',pymysql.cursors.DictCursor)


#######################################   CREATION CONNECION SOCKET   ################################

cSocket = S("127.0.0.1",5005,1024)


#######################################   DIFFERENTS CAS   ###########################################
state = "WAIT"


while(state):
    if (state == "WAIT"):
        while (state == "WAIT"):
            msg = cSocket.recvMessage()
            if msg is not None :
                print(msg)
                s_msg = msg.split('_')
                if (s_msg[0] == 'startsim'):
                    id_sim = s_msg[1]
                    state ="LOAD_SIM"
                else :
                    state = "WAIT"

        state = "LOAD_SIM"

    if (state == "LOAD_SIM"):
        
        nodes = connDb.getNodes(id_sim)     #Recuperations des Nodes 
        types = connDb.getTypes(id_sim)     #Recuperations des Types
        childs = connDb.getChilds(id_sim)   #Recuperations des Childs

        #connDb.nprint(nodes)
        #connDb.nprint(types)
        #connDb.nprint(childs)
    
        #simDatalog = Datalog(connDb,id_sim)                 #Creation Datalog
        #nodeClass = nodeCreator(nodes,types,childs)         #Création Classe Node
        #primaryNode = nodeClass.nodeCreation('null','null') #Creation du tableau de nodes 

        T = s_stime()                                       #Creation de la classe qui gère le temps dans la simu
        last_time = connDb.getLastTime(id_sim)['LASTTIME']  #Chercher la dernière valeur de la derniere simu si elle existe
        start_sim,t_inter2 = T.init_time(last_time)         #Instantiation des deux var de temps
        

        state = "RUNNING"

    if (state == "RUNNING"):

        while (state == "RUNNING"):
            t = T.diff_time(start_sim)
            t_inter = T.diff_time(t_inter2)

            if (t_inter >= 0.01):
                t_inter2 = time.time()
                print(t_inter2)
                #primaryNode.update(simDatalog,t)

            else :
                msg = cSocket.recvMessage()
                if msg is not None :
                    s_msg = msg.split('_')
                    if (s_msg[0] == 'stopsim'):
                        state ="STOP"
                    else :
                        state = "RUNNING"


    if (state == "STOP"):

        #clear tout ce qui faut clear
        state = "WAIT"

#######################################   CLOSE   ###########################################


