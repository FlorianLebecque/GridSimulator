let graphMan = new graphManager();

let label = [0,0,0,0,0,0,0,0,0,0];



graphMan.load_graph(array_graphID);


function getDashboardData(){
    ajaxHandler.sendRequest("getGraphData",JSON.stringify(array_graphID),graphUpdater.update,graphMan);
}

timerFunction.push(getDashboardData);

chart = createTreantJs(nodeArray,"#tree-simple")


function nodeClick(params) {

    let cur_node = getNode(nodeArray,params);

    if(cur_node["enable"]==0){
        cur_node["enable"] = 1;

        $("#"+params).css("background-color", "var(--Accent)");

        ajaxHandler.sendRequest("enable",params,callback);
    }else{
        cur_node["enable"] = 0;
        $("#"+params).css("background-color", "var(--Selected)");

        ajaxHandler.sendRequest("disable",params,callback);
    }

    
    
}

function callback(){

}