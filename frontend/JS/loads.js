let graphMan = new graphManager();

let label = [-4.5,-4.0,-3.5,-3.0,-2.5,-2,-1.5,-1.0,-0.5,0];


setTimeout(
    function(){
        graphMan.load_graph(array_graphID);
    },1000
)


function getDashboardData(){
    ajaxHandler.sendRequest("getGraphData",JSON.stringify(array_graphID),graphUpdater.update,graphMan);
}

timerFunction.push(getDashboardData);