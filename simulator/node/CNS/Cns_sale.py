from node.AdjustableNodeCns import AdjustableNodeCns
import random

class Cns_sale(AdjustableNodeCns):
    def __init__(self,meta,_id, ligne_pwr):
        self.max_power = ligne_pwr
        self.power_cursor = 100
        self.cost = int(meta['cost'])
        self.prior = 2
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
        return -self.max_power*(self.power_cursor/100)

    def trySale(self,bill):
        return self.adjust(bill)
