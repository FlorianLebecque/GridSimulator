from node.node import Node
import random

class Prd_buy(Node):
    def __init__(self,meta,_id, max_pwr):
        self.meta = meta
        self.max_power = 15 #int(self.meta['power'])
        self.power_cursor = 0
        self.prior = 1
        super().__init__( _id, max_pwr)
        

    def update(self,datalog,t):

        temps = t

        if self.enable:
            cost = int(self.meta['cost'])

            puissance = self.max_power * (self.power_cursor/100)

            price = cost*puissance
            
        else:
            puissance = 0
            price = 0

        datalog.update_datalog(self._id,puissance,price,temps)
        return puissance,0

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