from node.node import Node
from meteo import meteoHandler
import os

def clear(): os.system('cls') #on Windows System

class NodeN(Node):

    def __init__(self, _id , ligne_pwr):
        self.simpleType = "n"
        self.prior = 100
        super().__init__( _id, ligne_pwr)

    def firstUpdate(self,datalog,t):
        int_p = 0
        int_c = 0

        for child in self.childs :
            int_np,int_nc = child.callUpdate(datalog,t)
            int_p += int_np
            int_c += int_nc
        
        
        bill = int_p-int_c
        

        if int_p > int_c: #si on produit trop
            clear()
            print("---------------SIM---------------")
            meteoHandler.getSun(t)
            print("Prd : ",int_p," Cns : ",int_c)
            print("Bill : ",bill)
            strat = ["enable_cons","trySale","minimize_prod","max_dissp","disable_prod"]
            self.TryStrat(strat,bill)
            
        elif int_c > int_p:
            clear()
            print("---------------SIM---------------")
            meteoHandler.getSun(t)
            print("Prd : ",int_p," Cns : ",int_c)
            print("Bill : ",bill)
            strat = ["minimize_cons","maximize_prod","enable_prod","disable_cons"]
            self.TryStrat(strat,bill)