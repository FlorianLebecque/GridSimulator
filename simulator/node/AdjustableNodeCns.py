from node.node import Node
class AdjustableNodeCns(Node):

    def cns_minimize(self,target):
        if self.power_cursor >= 10:
            self.power_cursor -= 10
            return self._id

        return -1
    
    