
    
class graphManager{

    constructor(){
        this.graphs = [];
    }

    create_graph(str_PanelID,array_labels,array_data,int_axeMin=0,int_axeMax=10) {
        let ctx = $('#'+str_PanelID);

        let myLineChart = new Chart(ctx, {
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

        this.graphs.push(myLineChart);
    }

    newDataSet(){
        
    }

    addData(chart, label, data) {
        chart.data.labels.push(label);
        chart.data.datasets.forEach((dataset) => {
            dataset.data.push(data);
        });
        chart.update();
    }

    update(data){
        console.log("update chart")
    }


}


