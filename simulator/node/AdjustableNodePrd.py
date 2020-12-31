from node.NodeP import NodeP

class AdjustableNodePrd(NodeP):
    def __init__(self, _id, ligne_pwr):
        self.power_cursor = 100
        super().__init__( _id, ligne_pwr)    

    def minimize_prod(self,target):
        return self.adjust(target)

    def maximize_prod(self,target):
        return self.adjust(target)

    def getMaxPower(self,t):
        return self.max_power

    def adjust(self,param):     #param : (bill,t)
        bill = param[0]
        t = param[1]
        
        if(self.enable):

            cur_power = self.getCurPower(t)
            target = cur_power - (bill)

            if target > self.getMaxPower(t): #on doit trop monté
                self.power_cursor = 100
                return -1
            elif target < 0:              #on doit trop diminuer
                self.power_cursor = 0
                self.enable = False
                return -1
            else:
                self.power_cursor = ((target)/self.max_power)*100
                return self._id

        return -1
