from node.NodeC import NodeC
class AdjustableNodeCns(NodeC):
    def __init__(self, _id, ligne_pwr,datalog):
        self.power_cursor = 100
        super().__init__( _id, ligne_pwr,datalog)

    def enable_cons(self,param):    #param : (bill,t)
        if self.enable == False:
            self.enable = True
            return self.adjust(param)
        
        return -1

    def adjust(self,param):

        bill = param[0]
        t = param[1]

        if self.enable:
            cur_power = abs(self.getCurPower(1))
            target = cur_power + (bill)

            if target > self.max_power: #on doit trop monté
                self.power_cursor = 100
                return -1
            elif target < 0:              #on doit trop diminuer
                self.power_cursor = 0
                self.enable = False
                self.datalog.update_log(self._id,t,'disable_cons')
                return self._id
            else:
                self.power_cursor = ((target)/self.max_power)*100
                return self._id

        return -1

    def minimize_cons(self,param): #param =  (bill,t)
        return self.adjust(param)