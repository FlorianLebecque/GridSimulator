import random 
class nodeCreator:
    def __init__(self,nodes,types,childs):
        self.nodes = nodes
        self.types = types
        self.childs = childs

    def nodeCreation(self,_id,max_pwr):
        #Creation des instances de nodes
        if (_id == 'null'):
            _id = list(self.nodes.keys())[0]
            max_pwr = 10**100
        else :
            pass
        
        id_type = str(self.nodes[_id]['id_type'])

        if (id_type == '0'):
            temps_node = Node(_id,max_pwr)

            if _id in self.childs:
                i=0
                for child in self.childs[_id]['id_child'] :
                    max_pwr = self.childs[_id]['max_pwr'][i]
                    i+=1
                    temps_node.childs.append(self.nodeCreation(str(child),max_pwr))
                return temps_node
            else :
                return temps_node
        else :

            if (self.types[id_type]['type'] == 'prd_gaz'):
                return Prd_gaz(self.types[id_type]['meta'],_id,max_pwr)

            if (self.types[id_type]['type'] == 'prd_nuck'):
                return Prd_nuck(self.types[id_type]['meta'],_id,max_pwr)

            if (self.types[id_type]['type'] == 'prd_wind'):
                return Prd_wind(self.types[id_type]['meta'],_id,max_pwr)

            if (self.types[id_type]['type'] == 'prd_sun'):
                return Prd_sun(self.types[id_type]['meta'],_id,max_pwr)

            if (self.types[id_type]['type'] == 'prd_buy'):
                return Prd_buy(self.types[id_type]['meta'],_id,max_pwr)

            if (self.types[id_type]['type'] == 'cns_town'):
                return Cns_town(self.types[id_type]['meta'],_id,max_pwr)

            if (self.types[id_type]['type'] == 'cns_enter'):
                return Cns_enter(self.types[id_type]['meta'],_id,max_pwr)

            if (self.types[id_type]['type'] == 'cns_diss'):
                return Cns_diss(self.types[id_type]['meta'],_id,max_pwr)

            if (self.types[id_type]['type'] == 'cns_sale'):
                return Cns_sale(self.types[id_type]['meta'],_id,max_pwr)

            else :
                print('error')

class Datalog:
    def __init__(self,db,id_sim):
        self.datalog = {"PWR":0,"price":0,"CO2":0}
        self.db = db
        self.id_sim = id_sim

    def update_datalog(self,_id,power,price,t):
        self.datalog["PWR"] = power
        self.datalog["price"] = price

        self.db.sendUpdate(_id,t,self.datalog)

    def update_datalog(self,_id,power,price,t):
        self.datalog["PWR"] = power
        self.datalog["price"] = price

        self.db.sendUpdate(_id,t,self.datalog)

class Node:
    def __init__(self, _id , max_pwr):
        self._id = _id
        self.max_pwr = max_pwr
        self.childs = []
        self.enable = True
        self.simpleType = "n"
    
    def firstUpdate(self):
        pass

    def update(self,datalog,t):

        int_p = 0
        int_c = 0

        for child in self.childs :
            int_np,int_nc = child.update(datalog,t)
            int_p += int_np
            int_c += int_nc

        bill = int_p - int_c

        

        if abs(bill) > self.max_pwr: #on depasse calbe
            if bill < 0:        #désactive un consomateur
                prior_type = [Cns_diss,Cns_sale,Cns_town,Cns_enter]
                node_id = -1
                int_count = 0
                while(node_id == -1):
                    node_id = self.disable_by_type(prior_type[int_count],self.max_pwr - bill)
                    int_count += 1

                #datalog.update_datalog(node_id,puissance,price,temps)
            else:               #désactive un producteur
                prior_type = [Prd_buy,Prd_nuck,Prd_wind,Prd_gaz]
                node_id = -1
                int_count = 0
                while(node_id == -1):
                    node_id = self.disable_by_type(prior_type[int_count],self.max_pwr - bill)
                    int_count += 1

        return int_p,int_c

            

    def disable_by_type(self,node_type,atleat):
        node_child = []
        node_corType = []
        for child in self.childs :
            if isinstance(child,node_type):
                node_corType.append(child)
            elif isinstance(child,Node):
                node_child.append(child)

        value = -1
        for child in node_child:
            value = child.disable_by_type(self,node_type)
            if value == 1:
                return child.id

        if len(node_corType) == 0:
            return -1

        int_min = 1000000
        node_MinPwrNode = ""
        for child in node_corType:
            if child.max_power < int_min:
                int_min = child.max_power
                node_MinPwrNode = child

        node_MinPwrNode.enable = False
        return child.id


class Prd_gaz(Node):
    def __init__(self,meta,_id, max_pwr):
        self.meta = meta
        super().__init__( _id, max_pwr)

    def update(self,datalog,t):
        max_power = int(self.meta['power'])

        cost = int(self.meta['cost'])

        price = max_power * cost

        puissance = max_power+random.randint(-5,5)

        temps = t

        datalog.update_datalog(self._id,puissance,price,temps)

class Prd_nuck(Node):
    def __init__(self,meta,_id, max_pwr):
        self.meta = meta
        super().__init__( _id, max_pwr)
        

    def update(self,datalog,t):
        

        start_time = int(self.meta['t1'])
        #stop_time = int(self.meta['t2'])
        max_power = int(self.meta['power'])
        cost = int(self.meta['cost'])

        temp_t = t
        if (temp_t <= start_time):
            puissance = (temp_t*(max_power/start_time))

        else :
            puissance = max_power

        price = cost*puissance

        puissance = puissance

        temps = t

        datalog.update_datalog(self._id,puissance,price,temps)

class Prd_wind(Node):
    def __init__(self,meta,_id, max_pwr):
        self.meta = meta
        super().__init__( _id, max_pwr)
        

    def update(self,datalog,t):

        cost = int(self.meta['cost'])
        wind_eff = int(self.meta['eff'])/100
        max_power = int(self.meta['power'])
        wind_meteo = int(300)

        puissance = wind_eff*wind_meteo
        if puissance > max_power:
            puissance =  max_power

        price = cost*puissance

        puissance = puissance

        temps = t

        datalog.update_datalog(self._id,puissance,price,temps)

class Prd_sun(Node):
    def __init__(self,meta,_id, max_pwr):
        self.meta = meta
        super().__init__( _id, max_pwr)
        

    def update(self,datalog,t):
        
        cost = int(self.meta['cost'])
        sun_eff = int(self.meta['eff'])/100
        max_power = int(self.meta['power'])
        sun_meteo = int(100)

        puissance = sun_eff*sun_meteo
        if puissance > max_power:
            puissance =  max_power

        price = puissance*cost
        puissance = puissance
        temps = t

        datalog.update_datalog(self._id,puissance,price,temps)

class Prd_buy(Node):
    def __init__(self,meta,_id, max_pwr):
        self.meta = meta
        super().__init__( _id, max_pwr)
        

    def update(self,datalog,t):

        cost = int(self.meta['cost'])
        puissance = self.max_pwr

        price = cost*puissance
        puissance = puissance
        temps = t

        datalog.update_datalog(self._id,puissance,price,temps)

class Cns_town(Node):
    def __init__(self,meta,_id, max_pwr):
        self.meta = meta
        super().__init__( _id, max_pwr)
        

    def update(self,datalog,t):

        max_power = int(self.meta['power'])
        cost = int(self.meta['cost'])

        price = -cost*max_power
        puissance = max_power+random.randint(-1,1)
        temps = t

        datalog.update_datalog(self._id,puissance,price,temps)

class Cns_enter(Node):
    def __init__(self,meta,_id, max_pwr):
        self.meta = meta
        super().__init__( _id, max_pwr)
        

    def update(self,datalog,t):

        max_power = int(self.meta['power'])
        cost = int(self.meta['cost'])

        price = -cost*max_power
        puissance = max_power+random.randint(-1,1)
        temps = t

        datalog.update_datalog(self._id,puissance,price,temps)

class Cns_diss(Node):
    def __init__(self,meta,_id, max_pwr):
        self.meta = meta
        super().__init__( _id, max_pwr)
        

    def update(self,datalog,t):

        max_power = int(self.meta['power'])
        cost = int(self.meta['cost'])

        price = -cost*max_power
        puissance = max_power+random.randint(-1,1)
        temps = t

        datalog.update_datalog(self._id,puissance,price,temps)

class Cns_sale(Node):
    def __init__(self,meta,_id, max_pwr):
        self.meta = meta
        super().__init__( _id, max_pwr)
        

    def update(self,datalog,t):

        max_power = int(self.meta['power'])
        cost = int(self.meta['cost'])

        price = -cost*max_power
        puissance = max_power+random.randint(-1,1)
        temps = t

        datalog.update_datalog(self._id,puissance,price,temps)

