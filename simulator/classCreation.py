import random
import datalog

from node.NodeN import NodeN

from node.CNS.Cns_diss import Cns_diss
from node.CNS.Cns_enter import Cns_enter
from node.CNS.Cns_sale import Cns_sale
from node.CNS.Cns_town import Cns_town
from node.PRD.Prd_buy import Prd_buy
from node.PRD.Prd_gaz import Prd_gaz
from node.PRD.Prd_nuck import Prd_nuck
from node.PRD.Prd_sun import Prd_sun
from node.PRD.Prd_wind import Prd_wind

class nodeCreator:
    def __init__(self,nodes,types,childs):
        self.nodes = nodes
        self.types = types
        self.childs = childs

    def nodeCreation(self,_id,ligne_pwr):
        #Creation des instances de nodes
        if (_id == 'null'):
            _id = list(self.nodes.keys())[0]
            ligne_pwr = 10**100
        else :
            pass
        
        id_type = str(self.nodes[_id]['id_type'])

        if (id_type == '0'):
            temps_node = NodeN(_id,ligne_pwr)

            if _id in self.childs:
                i=0
                for child in self.childs[_id]['id_child'] :
                    ligne_pwr = self.childs[_id]['max_pwr'][i]
                    i+=1
                    temps_node.childs.append(self.nodeCreation(str(child),ligne_pwr))
                return temps_node
            else :
                return temps_node
        else :

            if (self.types[id_type]['type'] == 'prd_gaz'):
                return Prd_gaz(self.types[id_type]['meta'],_id,ligne_pwr)

            if (self.types[id_type]['type'] == 'prd_nuck'):
                return Prd_nuck(self.types[id_type]['meta'],_id,ligne_pwr)

            if (self.types[id_type]['type'] == 'prd_wind'):
                return Prd_wind(self.types[id_type]['meta'],_id,ligne_pwr)

            if (self.types[id_type]['type'] == 'prd_sun'):
                return Prd_sun(self.types[id_type]['meta'],_id,ligne_pwr)

            if (self.types[id_type]['type'] == 'prd_buy'):
                return Prd_buy(self.types[id_type]['meta'],_id,ligne_pwr)

            if (self.types[id_type]['type'] == 'cns_town'):
                return Cns_town(self.types[id_type]['meta'],_id,ligne_pwr)

            if (self.types[id_type]['type'] == 'cns_enter'):
                return Cns_enter(self.types[id_type]['meta'],_id,ligne_pwr)

            if (self.types[id_type]['type'] == 'cns_diss'):
                return Cns_diss(self.types[id_type]['meta'],_id,ligne_pwr)

            if (self.types[id_type]['type'] == 'cns_sale'):
                return Cns_sale(self.types[id_type]['meta'],_id,ligne_pwr)

            else :
                print('error')