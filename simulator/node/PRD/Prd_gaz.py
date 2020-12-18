from node.node import Node
import random

class Prd_gaz(Node):
    def __init__(self,meta,_id, max_pwr):
        self.meta = meta
        self.max_power = int(self.meta['power'])
        self.power_cursor = 100
        super().__init__( _id, max_pwr)

    def update(self,datalog,t):

        cost = int(self.meta['cost'])

        price = self.max_power * cost

        puissance = self.max_power+random.randint(-5,5)

        temps = t

        datalog.update_datalog(self._id,puissance,price,temps)

        return puissance, 0