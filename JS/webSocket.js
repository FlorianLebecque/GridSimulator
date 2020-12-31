class webSocketHandler{
    
    constructor(){

        let host = window.location.hostname

        this.websocket_server = new WebSocket("ws://"+host+":5002/");

        this.websocket_server.onopen = function(e) {
            this.send(
                JSON.stringify({
                    'type':'socket',
                    'user_id':simId
                })
            );
        };

        this.websocket_server.onerror = function(e) {
            // Errorhandling
        }

        

        
    }

}
