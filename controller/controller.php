<?php
    session_start();

    include_once("backend/header.php");
    include_once("backend/editor.php");

    include_once("backend\inc\action.php");
    include_once("backend\inc\graph.php");
    include_once("backend\inc\javascriptInculder.php");
    include_once("backend\inc\database.php");
    include_once("backend\inc\simdata.php");
    include_once("backend\inc\\node.php");

    class Controller {  

        public function __construct(){    
            $this->BDD = bdd::getBDD();
        } 


        public function invoke()  
        {  

            if(isset($_GET["a"])){
                $action = htmlspecialchars($_GET["a"]);

                switch($action){
                    case "addNodeType":
                        ActionHandler::addNodeType();
                        break;
                    case "logoff":
                        ActionHandler::LogOff();
                        break;
                }

            }

            if(isset($_SESSION["simulation"])){         //check if we are connected

                if(!isset($_SESSION["status"])){
                    $_SESSION["status"] = 0;
                }

                include_once("frontend/struct.php");        //if yes -> show the page
            }else{    
                include_once("frontend/special/login.php"); //if not -> show the login page
            }
            
        }

    }  
?>