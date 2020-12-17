from node.node import Node

class Prd_sun(Node):
    def __init__(self,meta,_id, max_pwr):
        self.meta = meta
        self.max_power = int(self.meta['power'])
        super().__init__( _id, max_pwr)
        

    def update(self,datalog,t):
        
        cost = int(self.meta['cost'])
        sun_eff = int(self.meta['eff'])/100
        sun_meteo = int(100)

        puissance = sun_eff*sun_meteo
        if puissance > max_power:
            puissance =  max_power

        price = puissance*cost
        puissance = puissance
        temps = t

        datalog.update_datalog(self._id,puissance,price,temps)