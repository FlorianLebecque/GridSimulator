
from node.node import Node
from meteo import meteoHandler
import os

def clear(): os.system('cls') #on Windows System

class NodeN(Node):

    def __init__(self, _id , ligne_pwr,datalog):
        self.simpleType = "n"
        self.prior = 100
        super().__init__(_id, ligne_pwr,datalog)

    def firstUpdate(self,t):

        bill = self.getCurPower(t)
        
        clear()
        print("___________________________SIM___________________________")
        print("time : ",t,' hour : ',t%24)
        print("sun : ",meteoHandler.getSun(t)," wind : ", meteoHandler.getWind(t))

        nbrTry = 0
        tested_strat = []

        while abs(bill)>0.5 and nbrTry < 15:
            print("_____________Tested strat______________")
            print(tested_strat)
            
            nbrTry+=1
            print("TRY  : ",nbrTry,"START BILL : ",bill)
            if bill > 0: #si on produit trop

                strat = [("enable_cons",(bill,t)),("trySale",(bill,t)),("minimize_prod",(bill,t)),("max_dissp",(bill,t)),("disable_prod",t)]

                res = self.tryStrat(strat,tested_strat,False,t)
                if res != -1:
                    tested_strat.append(res)

            elif bill < 0: #si on consome trop
        
                strat = [("minimize_cons",(bill,t)),("maximize_prod",(bill,t)),("enable_prod",t),("disable_cons",t)]
                res = self.tryStrat(strat,tested_strat,True,t)
                if res != -1:
                    tested_strat.append(res)

            else:
                break
        
            bill = self.getCurPower(t)
            print("_______________________________________")

        print("FINAL BILL : ",bill)

        if abs(bill)>1:            #send log message 
            if bill > 0:
                self.datalog.update_log(self._id,t,'posBill')    
            else:
                self.datalog.update_log(self._id,t,'negBill')    

        for child in self.childs :
            int_np,int_nc = child.callUpdate(t)
    
    def getCurPower(self,t):

        cur_power = 0
        for child in self.childs:
            if child.userEnable:
                cur_power += child.getCurPower(t)

        return cur_power
