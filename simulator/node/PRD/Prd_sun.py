from node.node import Node
import random

class Prd_sun(Node):
    def __init__(self,meta,_id, ligne_pwr):
        self.meta = meta
        self.max_power = int(self.meta['power'])
        self.prior = 99
        super().__init__( _id, ligne_pwr)
        

    def update(self,datalog,t):
        
        cost = int(self.meta['cost'])
        sun_eff = int(self.meta['eff'])/100
        sun_meteo = int(100)

        puissance = sun_eff*sun_meteo
        if puissance > self.max_power:
            puissance =  self.max_power

        price = self.max_power*cost
        puissance = puissance
        temps = t

        datalog.update_datalog(self._id,puissance,price,temps)

        return puissance, 0
