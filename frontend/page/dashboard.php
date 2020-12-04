<div class="container main">
        <div class="row">
            <div class="col-6">
                <h2>Consumption</h2>
                <canvas id="myChart" width="400" height="400"> </canvas>
            </div>
            
            <div class="col-6">
                <h2>Production</h2>
                
                <canvas id="myChart2" width="400" height="400">  </canvas>
                   
            </div>
        </div>
    </div>

    <div class="container main">
        
    </div>

    <script>
    var ctx = $('#myChart');
    var ctx2 = $('#myChart2');

    data=[1,2,1,1,2,3,2,2,2,3,2,1];
    var myLineChart = new Chart(ctx2, {
        type: 'line',
        "data":{
                "labels":[10,20,30,40,50,60,70],
  
                "datasets":[
                    {
                        "label":"My First Dataset",
                        "data":[65,59,80,81,56,55,40],              
                        "borderColor":"rgb(75, 192, 192)",
                        "lineTension":0.1
                    }
                ]
                
            },
        options: {
            scales: {
                yAxes: [{
                    stacked: true
                }]
            },
            title: {
            display: true,
            text: 'Production'
            }
        }
    });

    var chart2 = new Chart(
        document.getElementById("myChart"),
        {
            "type":"line",
            "data":{
                "labels":[10,20,30,40,50,60,70],
  
                "datasets":[
                    {
                        "label":"My First Dataset",
                        "data":[10,12,15,15,13,12,50],              
                        "borderColor":"rgb(75, 192, 192)",
                        "lineTension":0.1
                    }
                ]
                
            },
            "options":{}}
        );
    
    function randomize(){
        let lastval = myLineChart.data.datasets[0].data[myLineChart.data.datasets[0].data.length-1];
        let lastval2 = chart2.data.datasets[0].data[chart2.data.datasets[0].data.length-1];
        getData(myLineChart,lastval);
        getData(chart2,lastval2);
        

    }
    function addData(chart, label, data) {
        chart.data.labels.push(label);
        chart.data.datasets.forEach((dataset) => {
            dataset.data.push(data);
        });
        chart.update();
    }

    

    setInterval(randomize, 1000)

</script>

<script type="text/javascript">
        function getData(chart,str) {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    
                    let lastLab = chart.data.labels[chart.data.labels.length-1];
                    let newValue = this.responseText;

                    addData(chart,lastLab+10,newValue);

                }
            };
            xmlhttp.open("GET", "ajaxHandler.php?q=" + str, true);
            xmlhttp.send();
        }
</script>