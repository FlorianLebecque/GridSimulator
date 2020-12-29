from node.NodeC import NodeC
class AdjustableNodeCns(NodeC):
    def __init__(self, _id, ligne_pwr):
        self.power_cursor = 100
        super().__init__( _id, ligne_pwr)

    def adjust(self,bill):

        cur_power = self.max_power*(self.power_cursor/100)
        target = abs(cur_power + (bill))

        if self.power_cursor < 5:
            self.enable = False
            return -1

        if target > self.max_power :
            if self.power_cursor != 100:
                self.power_cursor = 100
                return self._id
            return -1
        else:

            self.power_cursor = ((target)/self.max_power)*100

            return self._id

    def minimize_cons(self,bill):
        return self.adjust(bill)