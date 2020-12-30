from node.NodeC import NodeC
class AdjustableNodeCns(NodeC):
    def __init__(self, _id, ligne_pwr):
        self.power_cursor = 100
        super().__init__( _id, ligne_pwr)

    def adjust(self,bill):
        if self.enable:
            old_cursor = self.power_cursor

            cur_power = abs(self.getCurPower(1))
            target = abs(cur_power + (bill))

            if target > self.max_power :
                if bill > 0:
                    if self.power_cursor != 100:
                        self.power_cursor = 100
                    else:
                        return -1
                else:
                    self.power_cursor = 0
            else:
                self.power_cursor = ((target)/self.max_power)*100

            if self.power_cursor < 5:
                self.enable = False
                return -1
            else:
                return self._id


        return -1

    def minimize_cons(self,bill):
        return self.adjust(bill)