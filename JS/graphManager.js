class graphManager{

    constructor(){
        this.graphs = [];
    }

    load_graph(array_graphID){
        for(let i = 0; i < array_graphID.length;i++){
            this.create_graph(array_graphID[i],label,[],0,10);
        }
        ajaxHandler.sendRequest("getGraphDataSet",JSON.stringify(array_graphID),graphUpdater.setDataset,this);
    }

    create_graph(str_PanelID,array_labels,array_data,int_axeMin=0,int_axeMax=10) {
        let ctx = $('#'+str_PanelID);

        let myLineChart = new Chart(ctx, {
            name:str_PanelID,
            type: 'line',
            "data":{
                "labels":array_labels,
                "datasets":array_data
            },
            options: {
                
                responsive:true,
                maintainAspectRatio:false,
                scales: {
                    yAxes: [{
                        ticks: {
                            suggestedMin: int_axeMin,
                            suggestedMax: int_axeMax
                        }
                    }],
                    xAxes: [{
                        gridLines: {
                          display: true
                        }
                      }]
                }
            }
        });

        this.graphs.push([str_PanelID,myLineChart]);
    }

    addData(chart, label, data) {
        chart.data.labels.push(label);
        chart.data.datasets.forEach((dataset) => {
            dataset.data.push(data);
        });
        chart.update();
    }

    getGraph(id){
        for(let i = 0; i < this.graphs.length;i++){
            if(this.graphs[i][0] == id){
                return this.graphs[i][1]
            }
        }
        return -1;
    }

    setDatasets(grh,data){
        grh.data.datasets = data;
        grh.update();
    }

    update(grh,data){
        grh.data.datasets[0].data = data;
        grh.update();
    }
}

class graphUpdater{
    constructor(){}

    static setDataset(data,graphMan){
        let dt = JSON.parse(data);

        for(let i = 0; i < dt.length;i++){
            let array_graphInfo = dt[i];     
            console.log(array_graphInfo)
            let temp_graph = graphMan.getGraph(array_graphInfo["id"]);
            graphMan.setDatasets(temp_graph,array_graphInfo["set"]);
        }
    }

    static update(data,graphMan){
        let dt = JSON.parse(data);
    
        for(let i = 0; i < dt.length;i++){
            let array_graphInfo = dt[i];     
            let temp_graph = graphMan.getGraph(array_graphInfo["id"]);
            graphMan.update(temp_graph,array_graphInfo["data"])
        }
    }

}