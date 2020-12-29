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

        bill = self.getCurPower(t)
        
        clear()
        print("---------------SIM---------------")
        meteoHandler.getSun(t)
        print("Bill : ",bill)

        nbrTry = 0
        tested_strat = []

        while abs(bill)>1 and nbrTry < 10:
            nbrTry+=1
            print("TRY  : ",nbrTry," BILL : ",bill)
            if bill > 0: #si on produit trop

                strat = [("enable_cons",t),("trySale",bill),("minimize_prod",bill),("max_dissp",bill),("disable_prod",t)]

                res = self.TryStrat(strat,tested_strat)
                if res != -1:
                    tested_strat.append(res)

            elif bill < 0:
        
                strat = [("minimize_cons",bill),("maximize_prod",bill),("enable_prod",t),("disable_cons",t)]
                res = self.TryStrat(strat,tested_strat)
                if res != -1:
                    tested_strat.append(res)

            else:
                break
        
            bill = self.getCurPower(t)

        for child in self.childs :
            int_np,int_nc = child.callUpdate(datalog,t)
    
    def getCurPower(self,t):

        cur_power = 0
        for child in self.childs:
            cur_power += child.getCurPower(t)

        return cur_power
