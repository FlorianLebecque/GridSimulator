<?php
    session_start();

    include_once("backend\inc\graph.php");
    
    //action requested
    $action = $_REQUEST["a"];

    //get the parameters for the action
    if(isset($_REQUEST["p"])){
        $param = $_REQUEST["p"];
    }else{
        $param = "";
    }

    //sort the ajax request by action

    switch($action){

        case "getGraphDataSet":                             // action wich return the datasets for the given charts
            echo graphDataSetHander::getDataSets($param);   //      $param : array with the charts 'id'
            break;                                          //          ["cns_all","prd_all","prd_1_PWR"]

        case "startSim":
            //start the sim

            $a["1"] = 1;
            $a["2"] = file_get_contents("public/img/svgPauseIcon.html");

            $_SESSION["status"] = 1;

            echo  json_encode($a);
            break;
        case "stopSim":
            //stop the sim
            $a["1"] = 0;
            $a["2"] = file_get_contents("public/img/svgPlayIcon.html");

            $_SESSION["status"] = 0;

            echo json_encode($a);
            break;
    }
?>