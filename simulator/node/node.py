
class Node:
    def __init__(self, _id , max_pwr):
        self._id = _id
        self.ligne_power = max_pwr
        self.childs = []
        self.enable = True
        self.simpleType = "n"
        self.prior = 100
    
    def firstUpdate(self,datalog,t):
        int_p = 0
        int_c = 0

        for child in self.childs :
            int_np,int_nc = child.update(datalog,t)
            int_p += int_np
            int_c += int_nc
        
        bill = int_p-int_c

        if int_p > int_c: #si on produit trop

            #try to enable cns
            node_id = self.enable_cons(bill)

            if node_id == -1:
                #try to sale
                node_id = self.trySale(bill)

            #try to slow prod
            if node_id == -1:    
                node_id = self.minimize_prod(bill)

            #try to dissip power
            if node_id == -1:       
                node_id = self.max_dissp(bill)

            #try to shutdown prod
            if node_id == -1:       
                node_id = self.disable_prod()

        elif int_c > int_p:
            #try to max prod
            node_id = self.maximize_prod(bill)

            if node_id == -1:
                #try to enable prod
                node_id = self.enable_prod(bill)

            #try to minimize sale and dissip
            if node_id == -1:
                node_id = self.minimize_cons(bill)

            #cut a building
            if node_id == -1:
                node_id = self.disable_cons()

    def trySale(self,target):
        node_id = -1
        for child in self.childs:
            if(hasattr(child,'trySale')):
                node_id = child.trySale(target);
                if node_id != -1:
                    return node_id

        return node_id

    def max_dissp(self,target):
        node_id = -1
        for child in self.childs:
            if(hasattr(child,'max_dissp')):
                node_id = child.max_dissp(target);
                if node_id != -1:
                    return node_id

        return node_id

    def enable_cons(self):
        node_node,target_node = self.__getNodeArray("enable_cons")

            #we first explore the rest of the node
        node_id = -1
        for Node in node_node:
            node_id = Node.enable_cons()
            if node_id != -1:
                return node_id
        
        for child in target_node:
            node_id = child.enable_cons()
            if node_id != -1:
                return node_id

        return node_id        

    def disable_prod(self):

        node_node,target_node = self.__getNodeArray("disable_prod")

            #we first explore the rest of the node
        node_id = -1
        for Node in node_node:
            node_id = Node.disable_prod()
            if node_id != -1:
                return node_id
        
        for child in target_node:
            node_id = child.disable_prod()
            if node_id != -1:
                return node_id

        return node_id

    def disable_cons(self):

        node_node,target_node = self.__getNodeArray("disable_cons")

            #we first explore the rest of the node
        node_id = -1
        for Node in node_node:
            node_id = Node.disable_cons()
            if node_id != -1:
                return node_id
        
        for child in target_node:
            node_id = child.disable_cons()
            if node_id != -1:
                return node_id

        return node_id

    def minimize_cons(self,target):

        node_node,target_node = self.__getNodeArray("minimize_cons")

            #we first explore the rest of the node
        node_id = -1
        for Node in node_node:
            node_id = Node.minimize_cons(target)
            if node_id != -1:
                return node_id
        
        for child in target_node:
            node_id = child.minimize_cons(target)
            if node_id != -1:
                return node_id

        return node_id

    def minimize_prod(self,target):

        node_node,target_node = self.__getNodeArray("minimize_prod")

            #we first explore the rest of the node
        node_id = -1
        for Node in node_node:
            node_id = Node.minimize_prod(target)
            if node_id != -1:
                return node_id

        for child in target_node:
            node_id = child.minimize_prod(target)
            if node_id != -1:
                return node_id

        return node_id

    def maximize_prod(self,target):

        node_node,target_node = self.__getNodeArray("maximize_prod")

            #we first explore the rest of the node
        node_id = -1
        for Node in node_node:
            node_id = Node.maximize_prod(target)
            if node_id != -1:
                return node_id
        
        for child in reversed(target_node):        #we invert the list to get the priority right
            node_id = child.maximize_prod(target)
            if node_id != -1:
                return node_id

        return node_id

    def __getNodeArray(self,attr):
            #first we get all the child that can minimize their prod
        int_maxPrior = 0
        target_node = []
        node_node = []
        for child in self.childs:
            if(hasattr(child,attr)):                    #check if we have the correct attribute
                int_pos = 0
                if child.prior == 100:                  #check if it's a node
                    node_node.append(child)
                else:
                    if(len(target_node) > 0):           #we sort them by priority
                        for c in target_node:
                            if child.prior > c.prior:
                                int_pos+=1
                    else:
                        int_pos = 0

                    target_node.insert(int_pos,child)

        return node_node,target_node

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