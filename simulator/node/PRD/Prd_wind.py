from node.AdjustableNodePrd import AdjustableNodePrd
from meteo import meteoHandler
import random

class Prd_wind(AdjustableNodePrd):
    def __init__(self,meta,_id, ligne_pwr,datalog):
        self.max_power = float(meta['power'])
        self.cost = float(meta['cost'])
        self.prior = 3
        self.wind_eff = float(meta['eff'])

        super().__init__( _id, ligne_pwr,datalog)

    def update(self,t):

        if self.enable:
           
            puissance = self.getCurPower(t)
            price = self.cost*self.max_power

        else:
            puissance = 0
            price = 0

        self.datalog.update_datalog(self._id,puissance,price,t)
        return puissance,0
    
    def getMaxPower(self,t):
        return self.max_power * meteoHandler.getWind(t)*(self.wind_eff/100)

    def getCurPower(self,t):
        if self.enable and self.userEnable:
            return (self.wind_eff/100)*(meteoHandler.getWind(t))*(self.power_cursor/100)*self.max_power
        else:
            return 0