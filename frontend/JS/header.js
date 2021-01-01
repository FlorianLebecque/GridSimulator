function StartStop_Sim(str) {
    if(status == 0){
        queryHandler.sendRequest("startSim",str,updateButton);
    }else{
        queryHandler.sendRequest("stopSim",str,updateButton);
    }   
}

function updateButton(data){
    
    let dt = JSON.parse(data)
    status = dt["1"]

    ajaxHandler.sendRequest("updateStatus",status,callback)

    $("#status").html(dt["2"])
}
function callback(){}