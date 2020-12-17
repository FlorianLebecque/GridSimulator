import socket
while (True):
    msgClient = input('Message client :')
    msgToSend = str.encode(msgClient)
    addrPort = ("127.0.0.1", 5005)
    bufferSize = 1024
    # Créer un socket UDP coté client
    s = socket.socket(socket.AF_INET, socket.SOCK_DGRAM)

    # Envoyer au serveur à l'aide du socket UDP créé
    s.sendto(msgToSend, addrPort)
