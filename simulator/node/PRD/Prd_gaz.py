from node.node import Node
import random

class Prd_gaz(Node):
    def __init__(self,meta,_id, max_pwr):
        self.meta = meta
        self.max_power = int(self.meta['power'])
        self.power_cursor = 100
        self.prior = 3
        super().__init__( _id, max_pwr)

    def update(self,datalog,t):
        if self.enable:
            cost = int(self.meta['cost'])

            

            puissance = self.max_power*(self.power_cursor/100)
            price = puissance * cost

            temps = t

            datalog.update_data(self._id,puissance,price,10,temps)

            return puissance, 0
        else:
            return 0,0

    def minimize_prod(self,target):
        if self.power_cursor >= 10:
            self.power_cursor -=10
            return self._id
        
        return -1

    def maximize_prod(self,target):
        if self.power_cursor <=90:
            self.power_cursor +=10
            return self._id
            
        return -1

    def disable_prod(self):
        if self.enable:
            self.enable = False
            return self._id

        return -1

    def enable_prod(self):
        if self.enable == False:
            self.enable = True
            return self._id
        
        return -1