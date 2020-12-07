<?php
    
    class getDHdData{

        function getDashBoardDatasets(){
            echo "'".json_encode($this->getDataSet())."'";
        }

        function getDashBoardData(){
            echo json_encode($this->getDatas());
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

            $set["data"] = [1,2,3,4,5,6,7,8,9,10];
            $data["set"][1] = $set;

            $dt[0] = $data;

            $set["label"] = "Maison";
            $set["data"] = [5,6,5,4,5,6,5,4,5,6];
            $set["borderColor"] = "rgb(75, 192, 192)";
            $set["lineTension"] = 0.2;
            $set["fill"] = "origin";
            $set["backgroundColor"] = "rgba(75, 192, 192,0.2)";

            $data1["id"] = "cns_graph";
            $data1["set"][0] = $set;

            $dt[1] = $data1;

            return $dt;

        }

        function getDatas(){

            $data[0]["id"] = "prd_graph";


            $dt = $_SESSION["data"];

            $new_val = abs($dt[count($dt)-1] + rand(-1,1));

            array_push($dt,$new_val);
            $dt = array_slice($dt,1,10);
            $_SESSION["data"] = $dt;

            $data[0]["data"] = $dt;



            $data[1]["id"] = "cns_graph";

            $dt = $_SESSION["data1"];
            $new_val = abs($dt[count($dt)-1] + rand(-1,1));

            array_push($dt,$new_val);
            $dt = array_slice($dt,1,10);
            $_SESSION["data1"] = $dt;

            $data[1]["data"] = $dt;

            return $data;
        }
    }
?>