from node.AdjustableNodeCns import AdjustableNodeCns
import random

class Cns_sale(AdjustableNodeCns):
    def __init__(self,meta,_id, ligne_pwr):
        self.meta = meta
        self.max_power = int(self.meta['power'])
        self.power_cursor = 100
        self.prior = 2
        super().__init__( _id, ligne_pwr)
        
    def update(self,datalog,t):

        temps = t

        if self.enable:
            cost = int(self.meta['cost'])
            puissance = self.max_power+random.randint(-1,1)
            price = cost*puissance
            
        else:
            puissance = 0
            price = 0

        datalog.update_datalog(self._id,puissance,price,temps)
        return 0,puissance


    def trySale(self,target):
        if(self.power_cursor <=90):
            self.power_cursor += 10
            return self._id
        else:
            return -1
