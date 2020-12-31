
class ajaxHandler{
    constructor(){

    }

    static sendRequest(act,req,func,param = ""){

        let state = wb.websocket_server.readyState

        
            if(state == 1){
                wb.websocket_server.send(
                    JSON.stringify({
                        'type':'chat',
                        'user_id':simId,
                        'chat_msg':act+"_"+req
                    })
                );
            }
            
        

        

        /*
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                return func(this.response,param);
            }
        };
        xmlhttp.open("GET", "ajaxHandler.php?a=" + act+"&p="+req, true);
        xmlhttp.send();
        */
    }
}