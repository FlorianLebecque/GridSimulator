from node.node import Node
import random

class Cns_enter(Node):
    def __init__(self,meta,_id, max_pwr):
        self.meta = meta
        self.max_power = int(self.meta['power'])
        super().__init__( _id, max_pwr)
        

    def update(self,datalog,t):
        if self.enable:
            cost = int(self.meta['cost'])

            
            puissance = self.max_power+random.randint(-1,1)
            price = cost*puissance
            temps = t

            datalog.update_datalog(self._id,puissance,price,temps)
            
            return 0,puissance
        else:
            return 0,0

    def disable_cons(self):
        if self.enable:
            self.enable = False
            return self._id
        
        return -1

    def enable_cons(self):
        if self.enable == False:
            self.enable = True
            return self._id
        
        return -1