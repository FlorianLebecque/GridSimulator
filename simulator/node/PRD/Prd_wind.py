from node.node import Node
import random

class Prd_wind(Node):
    def __init__(self,meta,_id, max_pwr):
        self.meta = meta
        self.max_power = int(self.meta['power'])
        self.power_cursor = 100
        super().__init__( _id, max_pwr)
        

    def update(self,datalog,t):

        cost = int(self.meta['cost'])
        wind_eff = int(self.meta['eff'])/100
        wind_meteo = int(300)

        puissance = wind_eff*wind_meteo
        if puissance > self.max_power:
            puissance =  self.max_power

        price = cost*puissance

        puissance = puissance

        temps = t

        datalog.update_datalog(self._id,puissance,price,temps)

        return puissance, 0