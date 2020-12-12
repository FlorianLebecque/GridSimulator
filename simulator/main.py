import time
import pymysql.cursors 
import asyncio

import classCreation as cc
from Database import Db 

#######################################   CREATION CONNECION DB   ####################################


connDb = Db('localhost','root','','projet_poo','utf8mb4',pymysql.cursors.DictCursor)


#######################################   CREATION CONNECION SOCKET   ################################


#connSocket = Socket('localhost',5600)

#######################################   DIFFERENTS CAS   ###########################################
state = "LOAD_SIM"
start_time = time.time()

while(state):
    if (state == "WAIT"):
        if((connSocket.ecoute(websocket, path)) == "START"):
            pass


    if (state == "LOAD_SIM"):
        
        nodes = connDb.getNodes(5)
        types = connDb.getTypes(5)
        childs = connDb.getChilds(5)

        connDb.nprint(nodes)
        connDb.nprint(types)
        connDb.nprint(childs)

        NodeMaker = cc.nodeCreator(nodes,types,childs)
        primaryNode = NodeMaker.nodeCreation('null','null')

        print(primaryNode)

        state ="RUNNING"
        break

    if (state == "RUNNING"):

        state ="STOP"
        break

#######################################   CLOSE   ###########################################


connDb.close_Db()