from node.node import Node
from meteo import meteoHandler
import random

class Prd_sun(Node):
    def __init__(self,meta,_id, ligne_pwr):
        self.max_power = int(meta['power'])
        self.prior = 99

        self.sun_eff = int(meta['eff'])
        self.cost = int(meta['cost'])

        super().__init__( _id, ligne_pwr)

        self.m = meteoHandler()
        

    def update(self,datalog,t):

        sun_meteo = meteoHandler.getSun(t)

        puissance = (self.sun_eff/100)*sun_meteo*self.max_power
        if puissance > self.max_power:
            puissance =  self.max_power

        price = self.max_power*self.cost

        datalog.update_datalog(self._id,puissance,price,t)

        return puissance, 0

    def getCurPower(self,t):
        pass