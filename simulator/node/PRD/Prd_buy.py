from node.AdjustableNodePrd import AdjustableNodePrd
import random

class Prd_buy(AdjustableNodePrd):
    def __init__(self,meta,_id, ligne_pwr):
        self.meta = meta
        self.max_power = 15 #int(self.meta['power'])
        self.prior = 1
        super().__init__( _id, ligne_pwr)
        
        self.power_cursor = 0

    def update(self,datalog,t):

        temps = t

        if self.enable:
            cost = int(self.meta['cost'])

            puissance = self.getCurPower(t)

            price = cost*puissance
            
        else:
            puissance = 0
            price = 0

        datalog.update_datalog(self._id,puissance,price,temps)
        return puissance,0

    def getCurPower(self,t):
        return self.max_power*(self.power_cursor/100)