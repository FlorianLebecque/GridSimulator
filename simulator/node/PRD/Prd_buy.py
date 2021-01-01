from node.AdjustableNodePrd import AdjustableNodePrd
import random

class Prd_buy(AdjustableNodePrd):
    def __init__(self,meta,_id, ligne_pwr,datalog):
        self.max_power = int(meta['power'])
        self.cost = int(meta['cost'])
        self.prior = 1
        super().__init__( _id, ligne_pwr,datalog)
        
        self.power_cursor = 0

    def update(self,t):
        
        if self.enable:
            puissance = self.getCurPower(t)
            price = self.cost*puissance
            
        else:
            puissance = 0
            price = 0

        self.datalog.update_datalog(self._id,puissance,price,t)
        return puissance,0

    def getCurPower(self,t):
        if self.enable and self.userEnable:
            return self.max_power*(self.power_cursor/100)
        else:
            return 0