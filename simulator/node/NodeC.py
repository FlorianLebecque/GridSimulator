from node.node import Node
import random

class NodeC(Node):
    def __init__(self, _id, ligne_pwr ,datalog):
        super().__init__( _id, ligne_pwr,datalog)    

    def getRandomArray(self):
        temp = []
        for i in range(0,48):
            temp.append(random.uniform(-self.max_power*0.1,self.max_power*0.1))
        return temp


    def disable_cons(self,t):
        if self.enable:
            self.enable = False
            return self._id
        
        return -1

    def enable_cons(self,param):    #param : (bill,t)
        if self.enable == False:
            self.enable = True
            return self._id
        
        return -1