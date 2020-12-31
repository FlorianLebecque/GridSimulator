let graphMan = new graphManager();

let label = [-4.5,-4.0,-3.5,-3.0,-2.5,-2,-1.5,-1.0,-0.5,0];

graphMan.load_graph(array_graphID);


function getDashboardData(){
    ajaxHandler.sendRequest("getGraphData",JSON.stringify(array_graphID),graphUpdater.update,graphMan);
}

timerFunction.push(getDashboardData);