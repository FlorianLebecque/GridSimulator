
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


        bill = self.getCurPower(t)

        while abs(bill) > self.ligne_power and nbrTry < 15:
            print("***************LIGNE POWER EXCEDEED***************")
            print("ID : ",self._id)
            print("LIGNE PWR : ", self.ligne_power," BILL :",abs(bill))
            print(tested_strat)
            
            nbrTry+=1
            print("TRY  : ",nbrTry,"START BILL : ",bill)
            if bill > 0: #si on produit trop

                strat = [("minimize_prod",(bill,t)),("disable_prod",t)]

                res = self.tryStrat(strat,tested_strat,False)
                if res != -1:
                    tested_strat.append(res)

            elif bill < 0: #si on consome trop
        
                strat = [("minimize_cons",bill),("disable_cons",t)]
                res = self.tryStrat(strat,tested_strat,True)
                if res != -1:
                    tested_strat.append(res)

            else:
                break
        
            bill = self.getCurPower(t)
             
        int_c = int_p = 0

        for child in self.childs :
            if child.userEnable:
                int_np,int_nc = child.callUpdate(datalog,t)
                int_p += int_np
                int_c += int_nc

        return int_p,int_c

            #function that find all the node wich have the selected attribute
    
    def sendMsg(self,act,node_id):
        pass

    def tryStrat(self,strat,excepts,needReverse):

        for s in strat:
            node_id = self.tryAttribute(s[0],s[1],excepts,needReverse)
            print("      - strat : ",s, "node : ",node_id)
            if node_id != -1:
                self.sendMsg(s[0],node_id)
                return (s[0],node_id)
        
        return -1

    def tryAttribute(self,attr,param,excepts,needReverse):
        target_node = self.getNodeArray(attr,needReverse)
        node_id = -1
        
        for child in target_node:
            if child.userEnable:
                alreadytry = False
                
                if len(excepts)>0:
                    for ex in excepts:
                        if ex[0] == attr and child._id == ex[1]:
                            alreadytry = True
                
                if alreadytry == False:
                    attr_func = getattr(child,attr)
                    node_id = attr_func(param)
                    if node_id != -1:
                        return node_id

        return -1

    def getNodeArray(self,attr,needReverse):
    
        target_node = []
        temp_node = []
        for child in self.childs:
            if child.prior == 100:          #check if it's a node
                temp_node = child.getNodeArray(attr,needReverse)
            elif(hasattr(child,attr)):      #check if we have the correct attribute
                target_node.append(child)

        result_node = target_node + temp_node

        #we need to sort by prior
        return sorted(result_node, key=lambda x: x.prior, reverse=needReverse)

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
