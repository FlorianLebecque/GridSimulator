from node.node import Node
class AdjustableNodePrd(Node):
    def minimize_prod(self,target):

        if self.power_cursor >= 10:
            self.power_cursor -=10
            return self._id
        print("error")
        return -1
        
    def maximize_prod(self,target):
        if self.power_cursor <=90:
            self.power_cursor +=10
            return self._id
        print("error")
        return -1
    pass