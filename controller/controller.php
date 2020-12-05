<?php
    session_start();

    include_once("backend/header.php");
    include_once("backend\inc\graph.php");

    class Controller {  
         
        public $hdrData;
        public $grahpManager;
        public $status;

        public function __construct(){    
           $this->hdrData = new headerData();
           $this->grahpManager = new graphHandler();

           $this->status = false;
        } 


        public function invoke()  
        {  
            //display the webpage
            include_once("frontend/struct.php");
        }

    }  
?>