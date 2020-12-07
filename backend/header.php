<?php
    class headerData{
            //create the html tag
        function getCentral(){
            $data = $this->formatData();

            foreach($data as $central){
                echo "<option>";
                echo $central;
                echo "</option>";
            }
        }
            //formate the data
        function formatData(){
            return array("Central 1","Central 2","Central 3");  
        }
            //get the data from the database
        function retreiveData(){
            
        }

        function getPageTitle(){
            if(isset($_GET["p"])){
                $str_title = htmlspecialchars($_GET["p"]);
            }else{
                $str_title = "Dashboard";
            }
            echo " ".ucfirst($str_title);
        }

            //get the state of the simulation
        function getSimState(){
            echo file_get_contents("public/img/svgPlayIcon.html");
        }

    }
?>