class Datalog:
    def __init__(self,db,id_sim):
        self.datalog = {"PWR":0,"price":0,"CO2":0}
        self.db = db
        self.id_sim = id_sim

    def update_datalog(self,_id,power,price,t):
        self.datalog["PWR"] = power
        self.datalog["price"] = price

        self.db.sendUpdate(_id,t,self.datalog)

    def update_data(self,_id,power,price,CO2,t):
        self.datalog["PWR"] = power
        self.datalog["price"] = price
        self.datalog["CO2"] = CO2

        self.db.sendUpdate(_id,t,self.datalog)