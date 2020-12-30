<?php
    session_start();

    include_once("backend\inc\graph.php");
    include_once("backend\inc\simdata.php");
    include_once("backend\inc\database.php");
    include_once("backend\inc\\node.php");
    
    //action requested
    $action = $_REQUEST["a"];

    //get the parameters for the action
    if(isset($_REQUEST["p"])){
        $param = $_REQUEST["p"];
    }else{
        $param = "";
    }

    $socket = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);

    //sort the ajax request by action
    switch($action){

        case "getGraphDataSet":                             // action wich return the datasets for the given charts
            echo graphDataSetHander::getDataSets($param);   //      $param : array with the charts 'id'
            break;                                          //          ["cns_all","prd_all","prd_1_PWR"]

        case "getGraphData":
            echo graphDataHandler::getData($param);
            break;

        case "addNewNode":
            echo nodeHandler::addNode($param);
            break;

        case "rmvNode":
            echo nodeHandler::rmvNode($param);
            break;

        case "rmvType":
            echo nodeHandler::rmvType($param);
            break;

        case "getSummary":
            echo json_encode(simdataHandler::getSummary($param));
            break;

        case "getLog":
            echo json_encode(simdataHandler::getLog($param));
            break;

        case "disable":
            $data = "disable_".$param;
            socket_sendto($socket,$data , strlen($data), 0, "127.0.0.1", 5005);

            echo "ghe";
            break;

        case "enable":
            $data = "enable_".$param;
            socket_sendto($socket,$data , strlen($data), 0, "127.0.0.1", 5005);
            echo "ok";
            break;

        case "startSim":
            //start the sim

            $a["1"] = 1;
            $a["2"] = file_get_contents("public/img/svgPauseIcon.html");

            $_SESSION["status"] = 1;

            $data = "startsim_".$_SESSION["simulation"];
            socket_sendto($socket,$data , strlen($data), 0, "127.0.0.1", 5005);
            
            echo  json_encode($a);
            break;
        case "stopSim":
            //stop the sim
            $a["1"] = 0;
            $a["2"] = file_get_contents("public/img/svgPlayIcon.html");

            $_SESSION["status"] = 0;

            $data = "stopsim_".$_SESSION["simulation"];
            socket_sendto($socket,$data , strlen($data), 0, "127.0.0.1", 5005);

            echo json_encode($a);
            break;
    }


    socket_close($socket);
?>