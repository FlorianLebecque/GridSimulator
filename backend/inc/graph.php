<?php
    class graphHandler{

        function getDashBoardData(){
            echo json_encode($this->getDataSet());
        }

        function getDataSet(){

            
            $set["label"] = "Nucleaire";
            $set["data"] = [5,6,5,4,5,6,5,4,5,6];
            $set["borderColor"] = "rgb(62, 240, 53)";
            $set["lineTension"] = 0.2;
            $set["fill"] = "origin";
            $set["backgroundColor"] = "rgba(62, 240, 53,0.2)";



            $data["id"] = "prd_graph";
            $data["set"][0] = $set;

            $dt[0] = $data;

            return $dt;

        }
    }
?>