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
        #while (state == "WAIT"):
        msg = cSocket.recvMessage()
        if msg is not None :
            print(msg)
            s_msg = msg.split('_')
            if (s_msg[0] == 'startsim'):
                id_sim = s_msg[1]
                state ="LOAD_SIM"
            else :
                state = "WAIT"

        #state = "LOAD_SIM"

    if (state == "LOAD_SIM"):
        
        nodes = connDb.getNodes(id_sim)
        types = connDb.getTypes(id_sim)
        childs = connDb.getChilds(id_sim)
    
        simDatalog = Datalog(connDb,id_sim)
        nodeClass = nodeCreator(nodes,types,childs,simDatalog)
        primaryNode = nodeClass.nodeCreation('null','null')

        last_time = connDb.getLastTime(id_sim)['LASTTIME']

        if (last_time is None):
            start_sim = 0
        else:
            start_sim = last_time
        
        t_inter2 = time.time() - 1
        i=0

        t = start_sim

        state = "RUNNING"
        
    if (state == "RUNNING"):

        #while (state == "RUNNING"):

        t_inter = time.time() - t_inter2

        if (t_inter >= 0.2):
            t_inter2 = time.time()
            primaryNode.firstUpdate(t)
            t+=0.5

        else :
            msg = cSocket.recvMessage()
            if msg is not None :
                print(msg)
                s_msg = msg.split('_')
                if (s_msg[0] == 'stopsim'):
                    state ="STOP"
                elif (s_msg[0] == 'enable'):
                    primaryNode.setUserEnable(s_msg[1],True,t)
                elif (s_msg[0] == 'disable'):
                    primaryNode.setUserEnable(s_msg[1],False,t)
                else :
                    state = "RUNNING"
            

    if (state == "STOP"):

        #clear tout ce qui faut clear
        state = "WAIT"

#######################################   CLOSE   ###########################################