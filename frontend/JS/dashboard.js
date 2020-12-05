let graphMan = new graphManager();

let labs = [1,2,3,4,5,6,7,8,9,10];


function getDashboardData(){
    let ajx = new ajaxHandler();
    ajx.sendRequest("getDashBoardData","a",update);
}

function setDataset(data){
    let dt = JSON.parse(data);

    for(let i = 0; i < dt.length;i++){
        array_graphInfo = dt[i];     
        let temp_graph = graphMan.getGraph(array_graphInfo["id"]);
        graphMan.setDatasets(temp_graph,array_graphInfo["set"])
    }
}

function update(data){
    let dt = JSON.parse(data);

    for(let i = 0; i < dt.length;i++){
        array_graphInfo = dt[i];     
        let temp_graph = graphMan.getGraph(array_graphInfo["id"]);
        graphMan.update(temp_graph,array_graphInfo["data"])
    }
}

timerFunction.push(getDashboardData);

graphMan.create_graph("cns_graph",labs,[],0,10);
graphMan.create_graph("prd_graph",labs,[],0,10);
graphMan.create_graph("str_graph",labs,[],0,10);

setDataset(defaultData_set);