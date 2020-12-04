<?php
    session_start();

    include_once("backend/header.php");
    

    class Controller {  
         
        public $hdrData;
        public $status;

        public function __construct(){    
           $this->hdrData = new headerData();
           $this->status = false;
        } 


        public function invoke()  
        {  
            



            //display the webpage
            include_once("frontend/struct.php");
        }

    }  
?>

