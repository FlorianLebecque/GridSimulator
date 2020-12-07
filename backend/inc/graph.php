<?php
    
    class getDHdData{

        static public function getDashBoardDatasets(){
            echo "'".json_encode(self::getDataSet())."'";
        }

        static public function getDashBoardData(){
            echo json_encode(self::getDatas());
        }

        static private function getDataSet(){

            
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

        static private function getDatas(){

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


    class graphArray{
            //function that create the production or consumation graphics array
        static public function createPrdArray($type){   // type -> define if we use prd or cns
            $data = simdataHandler::getNode($_SESSION["simulation"],$type);
            for($i = 0; $i < count($data);$i++){
                echo '<div class="col-lg-4 graphContainer" >';
                echo '<h3>'.$data[$i]["label"].'</h3>';
                echo '<canvas id="prd_'.$data[$i]["id"].'"></canvas>';
                echo '</div>';
            }
        }
    }

?>