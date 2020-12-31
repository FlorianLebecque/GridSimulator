from node.node import Node
class NodeC(Node):
    def __init__(self, _id, ligne_pwr):
        super().__init__( _id, ligne_pwr)    

    def disable_cons(self,b):
        if self.enable:
            self.enable = False
            return self._id
        
        return -1

    def enable_cons(self,param):    #param : (bill,t)
        if self.enable == False:

            self.enable = True
            return self._id
        
        return -1