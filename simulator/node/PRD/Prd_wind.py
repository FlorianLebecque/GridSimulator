from node.AdjustableNodePrd import AdjustableNodePrd
import random

class Prd_wind(AdjustableNodePrd):
    def __init__(self,meta,_id, ligne_pwr):
        self.meta = meta
        self.max_power = int(self.meta['power'])
        self.prior = 4
        super().__init__( _id, ligne_pwr)

    def update(self,datalog,t):

        temps = t

        if self.enable:
            cost = int(self.meta['cost'])
            wind_eff = int(self.meta['eff'])/100
            wind_meteo = int(100)

            puissance = (wind_eff)*(wind_meteo/100)*(self.power_cursor/100)*self.max_power

            price = cost*self.max_power

        else:
            puissance = 0
            price = 0

        datalog.update_datalog(self._id,puissance,price,temps)
        return puissance,0