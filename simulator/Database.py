import pymysql.cursors
import json

class Db:
    def __init__(self,host,user,password,db,charset,cursorclass):
        self.connection = pymysql.connect(host='localhost',user='root',password='',db='poo_elec',charset='utf8mb4',cursorclass=pymysql.cursors.DictCursor)

    def close_Db(self):
        self.connection.close()  # Closez la connexion (Close connection).   

    def nprint(self,dictionaire):
        print('-------------------------------------------------------')
        for keys,valeus in dictionaire.items() :
            print('{} :  {}'.format(keys, valeus))

    def getNodes(self,id_sim):

        with self.connection.cursor() as nodes:
            nodes.execute('SELECT node.`id`,node.`id_type`,node.`label` FROM `pe_node` AS node INNER JOIN pe_sim AS sim ON node.`id_sim` = sim.id WHERE node.`id_sim` =%s',id_sim)

        output = {}
        for node in nodes :
            key = str(node['id'])
            dict_info = {'id_type':node['id_type'],'label':node['label']}
            output[key] = dict_info
        return output
            
    def getTypes(self,id_sim):
        
        with self.connection.cursor() as typs:
            typs.execute('SELECT tnode.`id`,tnode.label ,tnode.`type_simple`,tnode.`type`,tnode.`meta` FROM `pe_type_node` AS tnode INNER JOIN pe_sim AS sm ON tnode.`id_sim` = sm.id WHERE tnode.`id_sim` = %s',id_sim)
        
        output = {}
        for typ in typs :
            key = str(typ['id'])
            dict_info = {'label':typ['label'],'type_simple':typ['type_simple'],'type':typ['type'],'meta':eval(typ['meta'])}
            output[key] = dict_info
        return output

    def getChilds(self,id_sim):
        with self.connection.cursor() as childs:
            childs.execute('SELECT child.`id_parent`,child.`id_child`,child.`max_pwr` FROM `pe_node_children` AS child INNER JOIN pe_node AS node ON child.`id_parent` = node.id WHERE node.id_sim =%s',id_sim)
        
        output = {}
        for child in childs :
            key = str(child['id_parent'])
            if (key in output):
                output[key]['id_child'].append(child['id_child'])
                output[key]['max_pwr'].append(child['max_pwr'])
            else :
                dict_info = {'id_child':[child['id_child']],'max_pwr':[child['max_pwr']]}
                output[key] = dict_info
        return output

    def sendUpdate(self,node_id,time,data):
        with self.connection.cursor() as datas:
            datas.execute('INSERT INTO `pe_data`( `node_id`, `time`, `data`) VALUES (%s,%s,%s)',(node_id,time,json.dumps(data)))

        self.connection.commit()

    def getLastTime(self,id_sim):
        with self.connection.cursor() as times:
            times.execute('SELECT MAX(DAT.time) as LASTTIME FROM `pe_data` AS DAT INNER JOIN pe_node as NODE ON NODE.id = DAT.`node_id` WHERE NODE.id_sim = %s',id_sim)
        for time in times :
            pass
        return time
