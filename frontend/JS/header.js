function StartStop_Sim(str) {
    if(status == 0){
        ajaxHandler.sendRequest("startSim",str,updateButton);
    }else{
        ajaxHandler.sendRequest("stopSim",str,updateButton);
    }   
}

function updateButton(data){
    
    let dt = JSON.parse(data)
    status = dt["1"]
    $("#status").html(dt["2"])
}