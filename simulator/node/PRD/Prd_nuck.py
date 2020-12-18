from node.node import Node
import random

class Prd_nuck(Node):
    def __init__(self,meta,_id, max_pwr):
        self.meta = meta
        self.max_power = int(self.meta['power'])
        super().__init__( _id, max_pwr)
        

    def update(self,datalog,t):
        

        start_time = int(self.meta['t1'])
        #stop_time = int(self.meta['t2'])

        cost = int(self.meta['cost'])

        temp_t = t
        if (temp_t <= start_time):
            puissance = (temp_t*(self.max_power/start_time))

        else :
            puissance = self.max_power

        price = cost*puissance

        puissance = puissance

        temps = t

        datalog.update_datalog(self._id,puissance,price,temps)

        return puissance, 0