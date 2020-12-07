<?php
    session_start();

    include_once("backend/header.php");
    include_once("backend\inc\graph.php");
    include_once("backend\inc\javascriptInculder.php");
    

    class Controller {  
         
        public $hdrData;
        public $graphControl;

        public function __construct(){    
           $this->graphControl = new getDHdData();

            $_SESSION["data"] = [5,2,5,6,6,6,5,6,5,4];
            $_SESSION["data1"] = [5,2,5,6,6,6,5,6,5,4];

        } 


        public function invoke()  
        {  
            //display the webpage
            include_once("frontend/struct.php");
        }

    }  
?>