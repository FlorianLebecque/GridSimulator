<?php
    session_start();

    include_once("backend/header.php");
    

    class Controller {  
         
        public $hdrData;

        public function __construct(){    
           $this->hdrData = new headerData();
        } 


        public function invoke()  
        {  
            //display the webpage
            include_once("frontend/struct.php");
        }

    }  
?>