from node.node import Node
class NodeN(Node):

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
            node_id = self.enable_cons()

            #try to sale
            if node_id == -1:
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
            print("max_prod : ",node_id)

            #try to enable prod
            if node_id == -1:
                node_id = self.enable_prod()

            print("enable_prod : ",node_id)

            #try to minimize sale and dissip
            if node_id == -1:
                node_id = self.minimize_cons(bill)

            print("minimize_cons : ",node_id)

            #cut a building
            if node_id == -1:
                node_id = self.disable_cons()

            print("disable_cons : ",node_id)

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

    def enable_prod(self):
        node_node,target_node = self.__getNodeArray("enable_prod")

            #we first explore the rest of the node
        node_id = -1
        for node in node_node:
            node_id = node.enable_prod()
            if node_id != -1:
                return node_id
        
        for child in target_node:
            node_id = child.enable_prod()
            if node_id != -1:
                return node_id

        return node_id 

    def enable_cons(self):
        node_node,target_node = self.__getNodeArray("enable_cons")

            #we first explore the rest of the node
        node_id = -1
        for node in node_node:
            node_id = node.enable_cons()
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
        for node in node_node:
            node_id = node.disable_prod()
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
        for node in node_node:
            node_id = node.disable_cons()
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
        for node in node_node:
            node_id = node.minimize_cons(target)
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
        for node in node_node:
            node_id = node.minimize_prod(target)
            if node_id != -1:
                return node_id

        for child in target_node:
            node_id = child.minimize_prod(target)
            if node_id != -1:
                return node_id
        print(node_id)
        return node_id

    def maximize_prod(self,target):

        node_node,target_node = self.__getNodeArray("maximize_prod")

            #we first explore the rest of the node
        node_id = -1
        for node in node_node:
            node_id = node.maximize_prod(target)
            if node_id != -1:
                return node_id
        
        for child in reversed(target_node):        #we invert the list to get the priority right
            node_id = child.maximize_prod(target)
            if node_id != -1:
                return node_id

        return node_id