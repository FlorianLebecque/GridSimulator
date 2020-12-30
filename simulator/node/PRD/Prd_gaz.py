from node.AdjustableNodePrd import AdjustableNodePrd
import random

class Prd_gaz(AdjustableNodePrd):
    def __init__(self,meta,_id, ligne_pwr):
        self.max_power = int(meta['power'])
        self.prior = 3
        self.cost = int(meta['cost'])
        self.CO2 = int(meta['co2'])
        super().__init__( _id, ligne_pwr)

    def update(self,datalog,t):

        if self.enable:
            puissance = self.getCurPower(t)
            price = puissance * self.cost      
            CO2 = self.CO2 * self.power_cursor/100
        else:
            puissance = 0
            price = 0
            CO2 = 0

        datalog.update_data(self._id,puissance,price,CO2,t)
        return puissance,0

    def getCurPower(self,t):
        if self.enable:
            return self.max_power*(self.power_cursor/100)
        else:
            return 0