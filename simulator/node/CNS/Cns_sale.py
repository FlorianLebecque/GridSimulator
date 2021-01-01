from node.AdjustableNodeCns import AdjustableNodeCns
import random

class Cns_sale(AdjustableNodeCns):
    def __init__(self,meta,_id, ligne_pwr,datalog):
        self.max_power = ligne_pwr
        self.power_cursor = 100
        self.cost = int(meta['cost'])
        self.prior = 1
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

    def trySale(self,param):
        return self.adjust(param)

    def getCurPower(self,t):
        if self.enable and self.userEnable:
            return -self.max_power*(self.power_cursor/100)
        else:
            return 0

