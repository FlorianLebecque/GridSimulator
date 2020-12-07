
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
    let defaultData_set = <?php getDHdData::getDashBoardDatasets() ?>;
</script>