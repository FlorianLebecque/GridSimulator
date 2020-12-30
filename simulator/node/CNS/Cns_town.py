from node.NodeC import NodeC
from meteo import meteoHandler
import random

class Cns_town(NodeC):
    def __init__(self,meta,_id, ligne_pwr):
        self.max_power = int(meta['power'])
        self.cost = int(meta['cost'])
        self.prior = 1
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
            return -meteoHandler.getCns(t)*self.max_power
        else:
            return 0
        