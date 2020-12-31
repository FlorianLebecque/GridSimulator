<?php

    include_once("backend\inc\graph.php");
    include_once("backend\inc\simdata.php");
    include_once("backend\inc\database.php");
    include_once("backend\inc\\node.php");
    
    class ajaxQueryHandler{

        public static function getResult($action,$param,$BDD){
            //action requested
            $socket = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);

            //sort the ajax request by action
            switch($action){

                case "getGraphDataSet":                                     // action wich return the datasets for the given charts
                    return graphDataSetHander::getDataSets($param,$BDD);    //      $param : array with the charts 'id'
                break;                                                      //          ["cns_all","prd_all","prd_1_PWR"]

                case "getGraphData":
                    return graphDataHandler::getData($param,$BDD);
                    break;

                case "addNewNode":
                    return nodeHandler::addNode($param,$BDD);
                    break;

                case "rmvNode":
                    return nodeHandler::rmvNode($param,$BDD);
                    break;

                case "rmvType":
                    return nodeHandler::rmvType($param,$BDD);
                    break;

                case "getSummary":
                    return json_encode(simdataHandler::getSummary($param,$BDD));
                    break;

                case "getLog":
                    return json_encode(simdataHandler::getLog($param,$BDD));
                    break;

                case "disable":
                    $data = "disable_".$param;
                    socket_sendto($socket,$data , strlen($data), 0, "127.0.0.1", 5005);

                    return "ghe";
                    break;

                case "enable":
                    $data = "enable_".$param;
                    socket_sendto($socket,$data , strlen($data), 0, "127.0.0.1", 5005);
                    return "ok";
                    break;

                case "startSim":
                    //start the sim

                    $a["1"] = 1;
                    $a["2"] = file_get_contents("../../public/img/svgPauseIcon.html");

                    $data = "startsim_".$param;
                    socket_sendto($socket,$data , strlen($data), 0, "127.0.0.1", 5005);
                    
                    return  json_encode($a);
                    break;
                case "stopSim":
                    //stop the sim
                    $a["1"] = 0;
                    $a["2"] = file_get_contents("../../public/img/svgPlayIcon.html");

                    $data = "stopsim_".$param;
                    socket_sendto($socket,$data , strlen($data), 0, "127.0.0.1", 5005);

                    return json_encode($a);
                    break;
            }

            return "error";

            socket_close($socket);
        } 
    }
?>