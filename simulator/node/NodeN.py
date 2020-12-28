from node.node import Node
class NodeN(Node):

    def __init__(self, _id , ligne_pwr):
        self.simpleType = "n"
        self.prior = 100
        super().__init__( _id, ligne_pwr)

    def firstUpdate(self,datalog,t):
        int_p = 0
        int_c = 0

        for child in self.childs :
            int_np,int_nc = child.update(datalog,t)
            int_p += int_np
            int_c += int_nc
        
        
        bill = int_p-int_c
        print("---------------SIM---------------")
        print("time : ",t)
        print("Prd : ",int_p," Cns : ",int_c)
        print("Bill : ",bill)

        if int_p > int_c: #si on produit trop
            strat = ["enable_cons","trySale","minimize_prod","max_dissp","disable_prod"]
            self.TryStrat(strat,bill)
           
        elif int_c > int_p:
            strat = ["minimize_cons","maximize_prod","enable_prod","disable_cons"]
            self.TryStrat(strat,bill)
 
        #function that find all the node wich have the selected attribute
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

    def TryStrat(self,strat,bill):
        for s in strat:
            node_id = self.TryAttribute(s,bill)
            print("strat : ",s, "node : ",node_id)
            if node_id != -1:
                break
        
    def TryAttribute(self,attr,param):
        target_node = self.getNodeArray(attr)
        node_id = -1
        for child in target_node:
            attr_func = getattr(child,attr)
            node_id = attr_func(param)
            if node_id != -1:
                return node_id

        return node_id