from node.node import Node
from datalog import Datalog as D

class NodeP(Node):
    def __init__(self, _id, ligne_pwr,datalog):
        self.enableAtTime = 0
        self.disableAtTime = 0
        super().__init__( _id, ligne_pwr,datalog)    

    def disable_prod(self,t):
        print(self)
        if self.enable:
            self.enable = False
            self.disableAtTime = t
            return self._id

        return -1

    def enable_prod(self,t):
        if self.enable == False:
            self.enable = True
            self.enableAtTime = t
            return self._id
        
        return -1