from node.NodeP import NodeP

class AdjustableNodePrd(NodeP):
    def __init__(self, _id, max_pwr):
        self.power_cursor = 100
        super().__init__( _id, max_pwr)    

    def minimize_prod(self,target):
        print("-------------------------")
        print(self.max_power)
        print("try min prd : ",self._id)
        print(self.power_cursor)
        print(self.prior)
        if self.power_cursor >= 10:
            self.power_cursor -=10
            return self._id
   
        return -1
        
    def maximize_prod(self,target):
        print("-------------------------")
        print(self.max_power)
        print("try max prd : ",self._id)
        print(self.power_cursor)
        print(self.prior)
        if self.power_cursor <=90:
            self.power_cursor +=10
            return self._id

        return -1