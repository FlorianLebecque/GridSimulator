from node.NodeP import NodeP

class AdjustableNodePrd(NodeP):
    def __init__(self, _id, ligne_pwr):
        self.power_cursor = 100
        super().__init__( _id, ligne_pwr)    

    def minimize_prod(self,target):
        return self.adjust(target)

        
    def maximize_prod(self,target):
        return self.adjust(target)

    def adjust(self,bill):
        cur_power = self.getCurPower(1)
        target = abs(cur_power - (bill))

        if target > self.max_power :
            if self.power_cursor != 100:
                self.power_cursor = 100
                return self._id
            return -1
        else:

            self.power_cursor = ((target)/self.max_power)*100

            return self._id