function StartStop_Sim(str) {
    if(status == 0){
        ajaxHandler.sendRequest("startSim","a",updateButton);
    }else{
        ajaxHandler.sendRequest("stopSim","a",updateButton);
    }   
}

function updateButton(data){
    let dt = JSON.parse(data)
    status = dt["1"]
    $("#status").html(dt["2"])
}