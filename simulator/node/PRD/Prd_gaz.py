from node.AdjustableNodePrd import AdjustableNodePrd
import random

class Prd_gaz(AdjustableNodePrd):
    def __init__(self,meta,_id, ligne_pwr):
        self.meta = meta
        self.max_power = int(self.meta['power'])
        self.prior = 3
        super().__init__( _id, ligne_pwr)

    def update(self,datalog,t):

        temps = t

        if self.enable:
            cost = int(self.meta['cost'])

            puissance = self.getCurPower(t)
            price = puissance * cost      

        else:
            puissance = 0
            price = 0

        datalog.update_data(self._id,puissance,price,10,temps)
        return puissance,0

    def getCurPower(self,t):
        return self.max_power*(self.power_cursor/100)