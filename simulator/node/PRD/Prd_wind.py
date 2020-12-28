from node.AdjustableNodePrd import AdjustableNodePrd
import random

class Prd_wind(AdjustableNodePrd):
    def __init__(self,meta,_id, ligne_pwr):
        self.meta = meta
        self.max_power = int(self.meta['power'])
        self.cost = int(self.meta['cost'])
        self.prior = 4
        self.wind_eff = int(self.meta['eff'])
        self.wind_meteo = int(100)
        
        super().__init__( _id, ligne_pwr)

    def update(self,datalog,t):

        temps = t

        if self.enable:
            

            puissance = self.getCurPower(t)

            price = self.cost*self.max_power

        else:
            puissance = 0
            price = 0

        datalog.update_datalog(self._id,puissance,price,temps)
        return puissance,0
    
    def getCurPower(self,t):
        return (self.wind_eff/100)*(self.wind_meteo/100)*(self.power_cursor/100)*self.max_power