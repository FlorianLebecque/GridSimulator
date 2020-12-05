
<div class="row wideContainer">
    <div class="col-sm-12">
        <div class="main">
            <button class="collapsible">Electrical data</button>
            <div class="collasibleContent"><hr>
                <div class="row">
                    <div class="col-lg-8 graphContainer" >
                        <h3>Production</h3>
                        <canvas id="prd_graph"></canvas>
                    </div>
                    
                    <div class="col-lg-4 graphContainer" >
                        <h3>Storage</h3>
                        <canvas id="str_graph"></canvas>
                    </div>
                </div><hr>
                <div class="row">
                    <div class="col graphContainer">
                        <h3>Consumption</h3>
                        <canvas id="cns_graph"></canvas>
                    </div>
                </div>
            </div>  
        </div>
    </div>
    <div class="col-lg-6">
        <div class=" main">
            <button class="collapsible">Money</button>
            <div class="collasibleContent"><hr>
                <div class="row">
                    <div class="col">
                        <h3>Upkeep</h3>
                        <canvas id="ukp_graph" width="400" height="400"> </canvas>
                    </div>
                    
                    <div class="col">
                        <h3>Sales</h3>
                        <canvas id="sls_graph" width="400" height="400">  </canvas>
                    </div>
                </div>
            </div>  
        </div>
    </div>
    <div class="col-lg-6">
        <div class=" main">
            <button class="collapsible">Weathers data</button>
            <div class="collasibleContent"><hr>
                <div class="row">
                    <div class="col">
                        <h3>Sun</h3>
                        <canvas id="sun_graph" width="400" height="200"> </canvas>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <h3>Wind</h3>
                        <canvas id="wnd_graph" width="400" height="200">  </canvas>
                    </div>
                </div>
            </div>  
        </div>
    </div>
    
</div>

<script>

    let graphMan = new graphManager();
    let defaultData_set = <?php $this->graphControl->getDashBoardDatasets() ?>;
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

</script>