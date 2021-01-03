from node.AdjustableNodeCns import AdjustableNodeCns
import random

class Cns_diss(AdjustableNodeCns):
    def __init__(self,meta,_id, ligne_pwr,datalog):
        self.cost = 0
        self.max_power = float(meta['power'])
        self.prior = 4
        super().__init__( _id, ligne_pwr,datalog)
        

    def update(self,t):
        if self.enable:

            puissance = abs(self.getCurPower(t))
            
        else:
            puissance = 0
  

        self.datalog.update_datalog(self._id,puissance,self.cost,t)
        return 0,puissance

    def max_dissp(self,param):
        return self.adjust(param)

    def getCurPower(self,t):
        if self.enable and self.userEnable:
            return -self.max_power*(self.power_cursor/100)
        else:
            return 0