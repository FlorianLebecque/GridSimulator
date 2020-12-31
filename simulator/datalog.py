class Datalog:
    def __init__(self,db,id_sim):
        self.datalog = {"PWR":0,"price":0,"CO2":0}
        self.db = db
        self.id_sim = id_sim

    def update_datalog(self,_id,power,price,t):
        CO2=0
        self.db.sendUpdate(self.id_sim,_id,t,power,price,CO2)

    def update_data(self,_id,power,price,CO2,t):
        self.db.sendUpdate(self.id_sim,_id,t,power,price,CO2)

    def update_log(self,name,_id):
        if (name == 'minimize_cons'):
            return 'Sur-production du circuit'
        
        if (name == 'disable_cons'):
            return 'Sur-production du circuit'

        if (name == 'minimize_prod'):
            return 'Sur-production du circuit'
        
        if (name == 'disable_prod'):
            return 'Sur-production du circuit'
        
        if (name == 'surProd'):
            return 'Sur-production du circuit'
        
        if (name == 'sousProd'):
            return 'Sous-production du circuit'
        
        if (name == 'surCharge'):
            return 'Surchange sur ({})'.format(_id)
        
        if (name == 'blackOut'):
            return 'Blackout sur ({})'.format(_id)

        else:
            pass
         