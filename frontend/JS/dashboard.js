let graphMan = new graphManager();

let label = [0,0,0,0,0,0,0,0,0,0];

array_graphID = [
    "cns_all",
    "prd_all_PWR",
    "str_all",
    "mUP_all",
    "mSL_all",
    "prd_all_CO2"
]

graphMan.load_graph(array_graphID);


function getDashboardData(){
    ajaxHandler.sendRequest("getGraphData",JSON.stringify(array_graphID),graphUpdater.update,graphMan);
}

timerFunction.push(getDashboardData);