
class Node:
    def __init__(self, _id , ligne_pwr):
        self._id = _id
        self.ligne_power = ligne_pwr
        self.childs = []
        self.enable = True
        self.userEnable = True
    
    def __str__(self):
        return str(self.id) + " - " + str(type(self))

    def callUpdate(self,datalog,t):
        if self.userEnable:
            return self.update(datalog,t)
        else:
            return 0,0

    def update(self,datalog,t):

        int_p = 0
        int_c = 0

        for child in self.childs :
            int_np,int_nc = child.callUpdate(datalog,t)
            int_p += int_np
            int_c += int_nc

        bill = int_p - int_c

        if abs(bill) > self.ligne_power: #on depasse calbe
            if bill < 0:        #désactive un consomateur
                #node_id = self.disable_cons(self.ligne_power - bill)
                

                strat = ["minimize_prod","max_dissp","disable_prod"]
                #self.TryStrat(strat,bill)
                #datalog.update_datalog(node_id,puissance,price,temps)
            #else:               #désactive un producteur
                #node_id = self.disable_prod()


        return int_p,int_c

            #function that find all the node wich have the selected attribute
    

    def TryStrat(self,strat,excepts):

        for s in strat:
            node_id = self.TryAttribute(s[0],s[1],excepts)
            print("strat : ",s, "node : ",node_id)
            if node_id != -1:
                return (s[0],node_id)
        
        return -1

    def TryAttribute(self,attr,param,excepts):
        target_node = self.getNodeArray(attr)
        node_id = -1
        
        for child in target_node:
            alreadytry = False
            
            for ex in excepts:
                if ex[0] == attr and child._id == ex[1]:
                    alreadytry = True
            
            if not alreadytry:
                attr_func = getattr(child,attr)
                node_id = attr_func(param)
                if node_id != -1:
                    return node_id

        return node_id

    def getNodeArray(self,attr):
    
        target_node = []
        temp_node = []
        for child in self.childs:
            if child.prior == 100:          #check if it's a node
                temp_node = child.getNodeArray(attr)
            elif(hasattr(child,attr)):      #check if we have the correct attribute
                target_node.append(child)

        result_node = target_node + temp_node

        #we need to sort by prior
        return sorted(result_node, key=lambda x: x.prior, reverse=False)

    def setUserEnable(self,node_id,en):
        if self._id == node_id:
            self.userEnable = en
            return self._id
        else:
            for child in self.childs:
                node = child.setUserEnable(node_id,en)
                if node != -1:
                    return node
        
        return -1
