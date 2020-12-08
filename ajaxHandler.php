<?php

    session_start();

    include_once("backend\inc\graph.php");
    

    $action = htmlspecialchars($_REQUEST["a"],ENT_QUOTES,'UTF-8',false);
    if(isset($_REQUEST["p"])){
        $param = $_REQUEST["p"];
    }else{
        $param = "";
    }
    


    switch($action){
        case "getdata":
            
            break;
        case "getDashBoardData":
            getDHdData::getDashBoardData();
            break;
        
        case "getGraphDataSet":
            echo graphDataSetHander::getDataSets($param);
            break;

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