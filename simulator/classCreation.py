class nodeCreator:
    def __init__(self,nodes,types,childs):
        self.nodes = nodes
        self.types = types
        self.childs = childs

    def nodeCreation(self,id,max_pwr):
        #Creation des instances de nodes
        if (id == 'null'):
            id = list(self.nodes.keys())[0]
            max_pwr = 10**100
        else :
            pass
        
        
        id_type = str(self.nodes[id]['id_type'])

        if (id_type == '0'):

            temps_node = Node(id,max_pwr)
            i=0
            for child in self.childs[id]['id_child'] :
                
                max_pwr = self.childs[id]['max_pwr'][i]
                i+=1
                temps_node.childs.append(self.nodeCreation(str(child),max_pwr))
            return temps_node

        else :

            if (self.types[id_type]['type'] == 'prd_gaz'):
                return Prd_gaz(self.types[id_type]['meta'])

            if (self.types[id_type]['type'] == 'prd_nuck'):
                return Prd_nuck(self.types[id_type]['meta'])

            if (self.types[id_type]['type'] == 'prd_wind'):
                return Prd_wind(self.types[id_type]['meta'])

            if (self.types[id_type]['type'] == 'prd_sun'):
                return Prd_sun(self.types[id_type]['meta'])

            if (self.types[id_type]['type'] == 'prd_buy'):
                return Prd_buy(self.types[id_type]['meta'])

            if (self.types[id_type]['type'] == 'cns_town'):
                return Cns_town(self.types[id_type]['meta'])

            if (self.types[id_type]['type'] == 'cns_enter'):
                return Cns_enter(self.types[id_type]['meta'])

            if (self.types[id_type]['type'] == 'cns_diss'):
                return Cns_diss(self.types[id_type]['meta'])

            if (self.types[id_type]['type'] == 'cns_sale'):
                return Cns_sale(self.types[id_type]['meta'])

            else :
                print('error')

        

class Node:
    def __init__(self,id,max_pwr):
        self.id = id
        self.max_pwr = max_pwr
        self.childs = []
        self.enable = 'true'
    
    def update(self,datalog,t):
        pass

class Prd_gaz(Node):
    def __init__(self,meta):
        self.meta = meta

    def update(self,datalog,t):

        energy = datalog['need']

        cost = energy * self.meta['cost']

        co2 = energy * self.meta['co2']

        return {'energy':energy,'price':cost,'co2':co2}
    
class Prd_nuck(Node):
    def __init__(self,meta):
        self.meta = meta

    def update(self,datalog,t):

        start_time = int(self.meta['start_time'])
        stop_time = int(self.meta['stop_time'])
        max_power = int(self.meta['max_power'])

        energy=0
        if (t < start_time):
            energy =  (t*(max_power/start_time))
        else :
            energy =  max_power

        price = 50*energy

        co2 = 2*energy

        return {'energy':energy,'price':price,'co2':co2}

class Prd_wind(Node):
    def __init__(self,meta):
        self.meta = meta

    def update(self,datalog,t):

        wind_eff = int(self.meta['wind_eff'])/100
        max_power = int(self.meta['max_power'])
        wind_meteo = int(300)

        energy= wind_eff*wind_meteo
        if energy > max_power:
            energy =  max_power

        price = 10*energy

        co2 = 0

        return {'energy':energy,'price':price,'co2':co2}

class Prd_sun(Node):
    def __init__(self,meta):
        self.meta = meta

    def update(self,datalog,t):

        sun_eff = int(self.meta['wind_eff'])/100
        max_power = int(self.meta['max_power'])
        sun_meteo = int(300)

        energy= sun_eff*sun_meteo
        if energy > max_power:
            energy =  max_power

        price = 10*energy

        co2 = 0

        return {'energy':energy,'price':price,'co2':co2}

class Prd_buy(Node):
    def __init__(self,meta):
        self.meta = meta

    def update(self,datalog,t):

        sun_eff = int(self.meta['wind_eff'])/100
        max_power = int(self.meta['max_power'])
        sun_meteo = int(300)

        energy= sun_eff*sun_meteo
        if energy > max_power:
            energy =  max_power

        price = 10*energy

        co2 = 0

        return {'energy':energy,'price':price,'co2':co2}

class Cns_town(Node):
    def __init__(self,meta):
        self.meta = meta

    def update(self,datalog,t):

        energy = self.meta['cons']

        price = energy * self.meta['price']

        co2 = 0

        return {'energy':energy,'price':price,'co2':co2}

class Cns_enter(Node):
    def __init__(self,meta):
        self.meta = meta

    def update(self,datalog,t):

        energy = self.meta['cons']

        price = energy * self.meta['price']

        co2 = 0

        return {'energy':energy,'price':price,'co2':co2}

class Cns_diss(Node):
    def __init__(self,meta):
        self.meta = meta

    def update(self,datalog,t):

        energy = self.meta['cons']

        price = energy * self.meta['price']

        co2 = 0

        return {'energy':energy,'price':price,'co2':co2}

class Cns_sale(Node):
    def __init__(self,meta):
        self.meta = meta

    def update(self,datalog,t):

        energy = self.meta['cons']

        price = energy * self.meta['price']

        co2 = 0

        return {'energy':energy,'price':price,'co2':co2}


