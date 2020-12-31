<div class="row wideContainer">
    <div class="col-sm-12">
        <div class="row main">
            <div class="col">
                <div class="row">
                    <h2 class="col">Power</h2>
                </div>
                <hr>
                <div class="row">
                    <div class="col">
                        <?php
                            graphArray::createGraphArray("c","PWR",$this->BDD);
                        ?>
                    </div>
                </div> 
            </div>
        </div>
    </div>
</div>

<?php

    $data = simdataHandler::getNode_by_type($_SESSION["simulation"],"c",$this->BDD);

    $array_graphID = [];
    for($i = 0; $i < count($data); $i++){
        array_push($array_graphID,"prd_".$data[$i]["id"]."_PWR");
    }

?>

<script>
    let array_graphID = <?php echo json_encode($array_graphID) ?>
</script>
