import asyncio
import websockets

class Socket:
    def __init__(self,host,port)
    async def ecoute(websocket, path):
        async for message in websocket:
            await websocket.send(message)

    asyncio.get_event_loop().run_until_complete(websockets.serve(echo, 'localhost', 8765))
    asyncio.get_event_loop().run_forever()
