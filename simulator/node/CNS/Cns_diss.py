from node.AdjustableNodeCns import AdjustableNodeCns
import random

class Cns_diss(AdjustableNodeCns):
    def __init__(self,meta,_id, ligne_pwr):
        self.cost = 0
        self.max_power = int(meta['power'])
        self.prior = 4
        super().__init__( _id, ligne_pwr)
        

    def update(self,datalog,t):
        if self.enable:

            puissance = abs(self.getCurPower(t))
            
        else:
            puissance = 0
  

        datalog.update_datalog(self._id,puissance,self.cost,t)
        return 0,puissance

    def max_dissp(self,bill):
        return self.adjust(bill)

    def getCurPower(self,t):
        if self.enable:
            return -self.max_power*(self.power_cursor/100)
        else:
            return 0