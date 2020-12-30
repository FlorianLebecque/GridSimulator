from node.AdjustableNodePrd import AdjustableNodePrd
from meteo import meteoHandler
import random

class Prd_wind(AdjustableNodePrd):
    def __init__(self,meta,_id, ligne_pwr):
        self.max_power = int(meta['power'])
        self.cost = int(meta['cost'])
        self.prior = 3
        self.wind_eff = int(meta['eff'])
        
        
        super().__init__( _id, ligne_pwr)

    def update(self,datalog,t):

        if self.enable:
           
            puissance = self.getCurPower(t)
            price = self.cost*self.max_power

        else:
            puissance = 0
            price = 0

        datalog.update_datalog(self._id,puissance,price,t)
        return puissance,0
    
    def getCurPower(self,t):
        if self.enable:
            return (self.wind_eff/100)*(meteoHandler.getWind(t))*(self.power_cursor/100)*self.max_power
        else:
            return 0