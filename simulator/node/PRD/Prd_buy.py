from node.AdjustableNodePrd import AdjustableNodePrd
import random

class Prd_buy(AdjustableNodePrd):
    def __init__(self,meta,_id, ligne_pwr):
        self.max_power = int(meta['power'])
        self.cost = int(meta['cost'])
        self.prior = 1
        super().__init__( _id, ligne_pwr)
        
        self.power_cursor = 0

    def update(self,datalog,t):
        
        if self.enable:
            puissance = self.getCurPower(t)
            price = self.cost*puissance
            
        else:
            puissance = 0
            price = 0

        datalog.update_datalog(self._id,puissance,price,t)
        return puissance,0

    def getCurPower(self,t):
        if self.enable:
            return self.max_power*(self.power_cursor/100)
        else:
            return 0