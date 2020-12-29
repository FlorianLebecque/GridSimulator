import math as m
class meteoHandler:

    @staticmethod
    def getSun(t):
        t = t % 24      #cylce the time on a 24 periode

        print("time : ",t%24," sun : ",m.exp((-1/2)*(((t-12)/5*m.sqrt(2))**2)))

        return m.exp((-1/2)*(((t-12)/5*m.sqrt(2))**2)) #normal distribution center on 12

    @staticmethod
    def getWind(t):
        t = t % 24
        return (m.exp((-1/2)*((t-6)/2.5*m.sqrt(2))**2) + m.exp((-1/2)*((t-18)/2.5*m.sqrt(2))**2))/1.5