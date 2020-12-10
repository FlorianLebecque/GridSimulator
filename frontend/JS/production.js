let graphMan = new graphManager();

let label = [0,0,0,0,0,0,0,0,0,0];

graphMan.load_graph(array_graphID);


function getDashboardData(){
    ajaxHandler.sendRequest("getGraphData",JSON.stringify(array_graphID),graphUpdater.update,graphMan);
}

timerFunction.push(getDashboardData);