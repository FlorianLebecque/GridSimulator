
class ajaxHandler{
    constructor(){

    }

    static sendRequest(act,req,func,param = ""){

        let state = wb.websocket_server.readyState

        
        if(state == 1){

            wb.websocket_server.onmessage = function(e){
                

                var json = JSON.parse(e.data);

                let data = json.msg.split('-')

                switch(json.type) {
                    case 'chat':
                    
                        if(data[1]=="update"){
                            
                            return graphUpdater.update(data[0],graphMan)
                        }else if (data[1]=="setDataset"){
                            return graphUpdater.setDataset(data[0],graphMan)

                        }else{
                            return window[data[1]](data[0],param)
                        }        
                }
            }

            wb.websocket_server.send(
                JSON.stringify({
                    'type':'chat',
                    'user_id':simId,
                    'chat_msg':act+"-"+req+"-"+func.name
                })
            );

        }else{
            console.log("error")
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