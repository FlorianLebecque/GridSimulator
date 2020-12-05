
    
class graphManager{

    constructor(){
        this.graphs = [];
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


    update(grh,data){
        console.log(data)
        grh.data.datasets = data;
        grh.update();
    }


}


