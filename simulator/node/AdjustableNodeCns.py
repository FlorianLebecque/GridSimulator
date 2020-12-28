from node.NodeC import NodeC
class AdjustableNodeCns(NodeC):
    def __init__(self, _id, max_pwr):
        self.power_cursor = 100
        super().__init__( _id, max_pwr)

    def cns_minimize(self,target):
        if self.power_cursor >= 10:
            self.power_cursor -= 10
            return self._id

        return -1
    
    