from node.NodeC import NodeC
from meteo import meteoHandler

import math as m

class Cns_enter(NodeC):
    def __init__(self,meta,_id, ligne_pwr,datalog):
        self.max_power = float(meta['power'])
        self.cost = float(meta['cost'])
        self.prior = 2
        self.randomArray = self.getRandomArray()
        super().__init__( _id, ligne_pwr,datalog)
        

    def update(self,t):

        if self.enable:
            puissance = abs(self.getCurPower(t))
            price = self.cost*puissance
            
        else:
            puissance = 0
            price = 0

        self.datalog.update_datalog(self._id,puissance,price,t)
        return 0,puissance

    

    def getCurPower(self,t):
        if self.enable and self.userEnable:
            tmp_t = m.floor(t % 24)
            if(tmp_t == 0):
                self.randomArray = self.getRandomArray()

            return -(meteoHandler.getCns(t)*self.max_power + self.randomArray[tmp_t])
        else:
            return 0
