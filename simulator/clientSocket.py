import socket

class Socket:
    def __init__(self,adress,port,buffer_size):
        self.port = port
        self.adress = adress 
        self.buffer_size = buffer_size
        self.s = socket.socket(socket.AF_INET, socket.SOCK_DGRAM)
        self.s.settimeout(0.005)
        self.s.bind((self.adress ,self.port))

    def recvMessage(self):
        
        try :
            data = self.s.recvfrom(self.buffer_size)
            return data[0].decode()
        
        except:
            return None

