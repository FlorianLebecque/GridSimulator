from node.NodeP import NodeP
import random

class Prd_nuck(NodeP):
    def __init__(self,meta,_id, ligne_pwr):
        self.max_power = int(self.meta['power'])
        self.prior = 2
        self.start_time = int(meta['t1'])
        self.end_time = int(meta['t2'])
        self.cost = int(meta['cost'])
        super().__init__( _id, ligne_pwr)
        

    def update(self,datalog,t):

        if self.enable: 
            price = self.cost*self.max_power
            puissance = self.getCurPower(t)

        else:
            puissance = 0
            price = 0

        datalog.update_datalog(self._id,puissance,price,t)
        return puissance,0

    def getCurPower(t):
        temp_t = t
        if (temp_t <= self.start_time):
            return (temp_t*(self.max_power/self.start_time))
        else :
            return self.max_power