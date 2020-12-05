<?php
    echo $this->status;
?>
<div class="container main">
    <button class="collapsible">Electrical data</button>
    <div class="collasibleContent">
        <div class="row">
            <div class="col-6">
                <h3>Consumption</h3>
                <canvas id="cns_graph" width="400" height="400"> </canvas>
            </div>
            
            <div class="col-6">
                <h3>Production</h3>
                <canvas id="prd_graph" width="400" height="400">  </canvas>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <h3>Storage</h3>
                <canvas id="str_graph" width="400" height="200"> </canvas>
            </div>
        </div>
    </div>  
</div>

<div class="container main">
    <button class="collapsible">Weathers data</button>
    <div class="collasibleContent">
        <div class="row">
            <div class="col-6">
                <h3>Sun</h3>
                <canvas id="cns_graph" width="400" height="400"> </canvas>
            </div>
            
            <div class="col-6">
                <h3>Wind</h3>
                <canvas id="prd_graph" width="400" height="400">  </canvas>
            </div>
        </div>
    </div>  
</div>

<div class="container main">
    <button class="collapsible">Money</button>
    <div class="collasibleContent">
        <div class="row">
            <div class="col-6">
                <h3>Upkeep</h3>
                <canvas id="cns_graph" width="400" height="400"> </canvas>
            </div>
            
            <div class="col-6">
                <h3>Sales</h3>
                <canvas id="prd_graph" width="400" height="400">  </canvas>
            </div>
        </div>
    </div>  
</div>

<script>
    
    let graphMan = new graphManager();

    let labs = [1,2,3,4,5,6,7,8,9,10];
    let dataSet = [
					{
                        "label":"Nuclear",
                        "data":[5,6,5,4,5,6,5,4,5,6],
						"borderColor":CL_GREEN,
                        "lineTension":0.4,
                        "fill": "origin",
                        "backgroundColor":CL_GREEN_A
                    },
                    {
                        "label":"Wind",
                        "data":[5,6,1,8,2,3,6,4,8,3],
						"borderColor":CL_BLUE,
                        "lineTension":0.4,
                        "fill": "origin",
                        "backgroundColor":CL_BLUE_A
					}
				]

    graphMan.create_graph("cns_graph",labs,dataSet,0,10);
    graphMan.create_graph("prd_graph",labs,dataSet,0,10);
    graphMan.create_graph("str_graph",labs,dataSet,0,10);


</script>