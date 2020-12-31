<script>

    let array_graphID = [
        "cns_all_"+simId,
        "prd_all_PWR_"+simId,
        "mUP_all_"+simId,
        "mSL_all_"+simId,
        "prd_all_CO2_"+simId
    ]   

    let nodeArray = <?php echo json_encode(editorData::getNodeTree($_SESSION["simulation"])) ?>
</script>
<div class="row wideContainer">

    <div class="col-sm-12">
        <div class="main"> 
            <div class="row">
                <div class="col-12">
                    <h2>Essential</h2>
                </div>
            </div><hr>
            <div class="row">
                <div class="col-12">
                    <h3>Summary</h3>
                    <table class="table">
                        <tbody>
                            <tr>
                                <td id="time_field">Time : </td>
                                <td id="hour_field">Hour : </td>
                            </tr>
                            <tr>
                                <td id="sun_field">Sun : </td>
                                <td id="wind_field">Wind : </td>
                            </tr>
                            <tr>
                                <td id="bill_field">Bill : </td>
                                <td id="prd_field">Production :  </td>
                                <td id="cns_field">Consumption : </td>
                            </tr>
                        </tbody>
                        
                    </table>
                    <h3>Log</h3>
                    <div class="logPanel" id="logPanel">
                        
                    </div> 
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-12">
        <div class="main"> 
            <button class="collapsible">Node grid</button>
            <div class="collasibleContent"><hr>
                <div class="row">
                    <div class="col-12">
                        <div id="tree-simple"> </div>
                    </div>
                </div>
            </div>  
        </div>
    </div>

    <div class="col-sm-12">
        <div class="main">
            <button class="collapsible">Electrical data</button>
            <div class="collasibleContent"><hr>
                <div class="row">
                    <div class="col-lg-6 graphContainer" >
                        <h3>Production</h3>
                        <canvas id="prd_all_PWR_<?php echo $_SESSION["simulation"] ?>"></canvas>
                    </div>
                    <div class="col-lg-6 graphContainer">
                        <h3>Consumption</h3>
                        <canvas id="cns_all_<?php echo $_SESSION["simulation"] ?>"></canvas>
                    </div>
                </div>
            </div>  
        </div>
    </div>
    <div class="col-lg-12">
        <div class=" main">
            <button class="collapsible">CO2</button>
            <div class="collasibleContent"><hr>
                <div class="row">
                    <div class="col graphContainer">
                        <h3>CO2 Emission</h3>
                        <canvas id="prd_all_CO2_<?php echo $_SESSION["simulation"] ?>"> </canvas>
                    </div>
                </div>
            </div>  
        </div>
    </div>
    <div class="col-lg-12">
        <div class=" main">
            <button class="collapsible">Money</button>
            <div class="collasibleContent"><hr>
                <div class="row">
                    <div class="col-lg-6 graphContainer">
                        <h3>Upkeep</h3>
                        <canvas id="mUP_all_<?php echo $_SESSION["simulation"] ?>"> </canvas>
                    </div>
                    
                    <div class="col-lg-6 graphContainer">
                        <h3>Sales</h3>
                        <canvas id="mSL_all_<?php echo $_SESSION["simulation"] ?>">  </canvas>
                    </div>
                </div>
            </div>  
        </div>
    </div>
    
</div>