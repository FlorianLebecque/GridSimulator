<?php

    session_start();

    $action = $_REQUEST["a"]; //action
    $param = $_REQUEST["p"];

    //sort the query request by action
    switch($action){

        case "updateStatus":     
            $_SESSION["status"] = $param;
            return 0;
            break;

    }

    return "error";
?>