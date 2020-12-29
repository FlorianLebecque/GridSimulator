import time
import pymysql.cursors 
import json



from Database import Db 
from clientSocket import Socket as S

from datalog import Datalog
from classCreation import nodeCreator
from node.node import Node


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
        
        nodes = connDb.getNodes(id_sim)
        types = connDb.getTypes(id_sim)
        childs = connDb.getChilds(id_sim)

        #connDb.nprint(nodes)
        #connDb.nprint(types)
        #connDb.nprint(childs)
    
        simDatalog = Datalog(connDb,id_sim)
        nodeClass = nodeCreator(nodes,types,childs)
        primaryNode = nodeClass.nodeCreation('null','null')

        last_time = connDb.getLastTime(id_sim)['LASTTIME']

        if (last_time is not None):
            start_sim = time.time() - last_time

        else :
            start_sim = time.time()
        
        t_inter2 = time.time() - 1
        i=0

        state = "RUNNING"
        
    if (state == "RUNNING"):

        while (state == "RUNNING"):

            t = time.time() - start_sim 
            t_inter = time.time() - t_inter2

            if (t_inter >= 0.5):
                t_inter2 = time.time()
                primaryNode.firstUpdate(simDatalog,t)
                
            else :
                msg = cSocket.recvMessage()
                if msg is not None :
                    print(msg)
                    s_msg = msg.split('_')
                    if (s_msg[0] == 'stopsim'):
                        state ="STOP"
                    else :
                        state = "RUNNING"
            

    if (state == "STOP"):

        #clear tout ce qui faut clear
        state = "WAIT"

#######################################   CLOSE   ###########################################


