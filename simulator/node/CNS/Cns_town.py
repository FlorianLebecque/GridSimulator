from node.NodeC import NodeC
from meteo import meteoHandler
import random
import math as m

class Cns_town(NodeC):
    def __init__(self,meta,_id, ligne_pwr):
        self.max_power = int(meta['power'])
        self.cost = int(meta['cost'])
        self.prior = 3
        self.randomArray = []
        for i in range(0,48):
            self.randomArray.append(random.uniform(-self.max_power*0.1,self.max_power*0.1))
       
        super().__init__( _id, ligne_pwr)
        

    def update(self,datalog,t):

        if self.enable:
            
            puissance = abs(self.getCurPower(t))
            price = self.cost*puissance

        else:
            puissance = 0
            price = 0

        datalog.update_datalog(self._id,puissance,price,t)
        return 0,puissance

    def getCurPower(self,t):
        if self.enable:
            tmp_t = m.floor(t % 24)
            if(tmp_t == 0):
                self.randomArray = self.getRandomArray()

            return -(meteoHandler.getCns(t)*self.max_power + self.randomArray[tmp_t])
        else:
            return 0
        