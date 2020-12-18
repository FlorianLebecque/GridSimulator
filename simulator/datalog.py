class Datalog:
    def __init__(self,db,id_sim):
        self.datalog = {}
        self.db = db
        self.id_sim = id_sim

    def update_datalog(self,_id,power,price,alert,t):
        self.datalog["PWR"] = power
        self.datalog["price"] = price
        self.datalog["MESS"]

        self.db.sendUpdate(_id,t,self.datalog)

    def update_log(self,name,_id):

        if (name == 'surProd'):
            return ''
        
        if (name == 'sousProd'):
            pass
        
        if (name == 'surCharge'):
            pass
        
        if (name == 'blackOut'):
            pass
         