<?php
    include_once("backend\inc\graph.php");
    

    $action = htmlspecialchars($_REQUEST["a"]);
    if(isset($_REQUEST["p"])){
        $param = htmlspecialchars($_REQUEST["p"]);
    }else{
        $param = "";
    }
    


    switch($action){
        case "getdata":
            
            break;
        case "getDashBoardData":
            $grh = new graphHandler();
            $grh->getDashBoardData();
            break;
        case "startSim":
            //start the sim

            $a["1"] = 1;
            $a["2"] = file_get_contents("public/img/svgPauseIcon.html");

            echo  json_encode($a);
            break;
        case "stopSim":
            //stop the sim
            $a["1"] = 0;
            $a["2"] = file_get_contents("public/img/svgPlayIcon.html");

            echo json_encode($a);
            break;
    }
?>