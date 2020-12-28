from node.NodeP import NodeP
import random

class Prd_nuck(NodeP):
    def __init__(self,meta,_id, ligne_pwr):
        self.meta = meta
        self.max_power = int(self.meta['power'])
        self.prior = 2
        super().__init__( _id, ligne_pwr)
        

    def update(self,datalog,t):
        
        temps = t

        if self.enable:
            start_time = int(self.meta['t1'])
            #stop_time = int(self.meta['t2'])

            cost = int(self.meta['cost'])

            temp_t = t
            if (temp_t <= start_time):
                puissance = (temp_t*(self.max_power/start_time))
            else :
                puissance = self.max_power
                
            price = cost*self.max_power
            puissance = puissance


        else:
            puissance = 0
            price = 0

        datalog.update_datalog(self._id,puissance,price,temps)
        return puissance,0