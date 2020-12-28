
class Node:
    def __init__(self, _id , max_pwr):
        self._id = _id
        self.ligne_power = max_pwr
        self.childs = []
        self.enable = True
        self.simpleType = "n"
        self.prior = 100
    
    def __str__(self):
        return str(self.id) + " - " + str(type(self))

    def update(self,datalog,t):

        int_p = 0
        int_c = 0

        for child in self.childs :
            int_np,int_nc = child.update(datalog,t)
            int_p += int_np
            int_c += int_nc

        bill = int_p - int_c

#        if abs(bill) > self.ligne_power: #on depasse calbe
#            if bill < 0:        #désactive un consomateur
                #node_id = self.disable_cons(self.ligne_power - bill)

                #datalog.update_datalog(node_id,puissance,price,temps)
#            else:               #désactive un producteur
                #node_id = self.disable_prod()


        return int_p,int_c