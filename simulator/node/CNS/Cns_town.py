from node.NodeC import NodeC
import random

class Cns_town(NodeC):
    def __init__(self,meta,_id, max_pwr):
        self.meta = meta
        self.max_power = int(self.meta['power'])
        self.prior = 2
        super().__init__( _id, max_pwr)
        

    def update(self,datalog,t):

        temps = t

        if self.enable:
            if self._id == 82:
                print("bite")
            cost = int(self.meta['cost'])

            
            puissance = self.max_power+random.randint(-1,1)
            price = cost*puissance

        else:
            puissance = 0
            price = 0

        datalog.update_datalog(self._id,puissance,price,temps)
        return 0,puissance

