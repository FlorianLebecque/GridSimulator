from node.node import Node
class NodeP(Node):
    def __init__(self, _id, ligne_pwr):
        super().__init__( _id, ligne_pwr)    


    def disable_prod(self,b):
        if self.enable:
            self.enable = False
            return self._id

        return -1

    def enable_prod(self,b):
        if self.enable == False:
            self.enable = True
            return self._id
        
        return -1