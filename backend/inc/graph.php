<?php
    
    class getDHdData{

        static public function getDashBoardDatasets(){
            echo "'".json_encode(self::getDataSet())."'";
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
        static public function createGraphArray($type,$dataType){                                   // type -> define if we use prd or cns
            $data = simdataHandler::getNode_by_type($_SESSION["simulation"],$type);     // get the node data needed
            for($i = 0; $i < count($data);$i++){
                echo '<div class="col-lg-4 graphContainer" >';
                echo '<h3>'.$data[$i]["label"].'</h3>';
                echo '<canvas id="prd_'.$data[$i]["id"].'_'.$dataType.'"></canvas>';
                echo '</div>';
            }
        }

        static public function createGraphArray_CO2($type){                                   // type -> define if we use prd or cns
            $data = simdataHandler::getNode_by_type($_SESSION["simulation"],$type);     // get the node data needed
            for($i = 0; $i < count($data);$i++){
                echo '<div class="col-lg-4 graphContainer" >';
                echo '<h3>'.$data[$i]["label"].'</h3>';
                echo '<canvas id="prd_'.$data[$i]["id"].'_CO2"></canvas>';
                echo '</div>';
            }
        }
    }

    class graphDataSetHander{
        public static function getDataSets($str_arrayID){
            $array_GraphID = json_decode($str_arrayID);

            $dt = [];
            $index = 0;

            for($i = 0; $i < count($array_GraphID);$i++){
                $str_id = $array_GraphID[$i];   //prd_1_PWR -> productor, node 1, power

                $array_idData = preg_split ('/_/',$str_id,-1,PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);

                switch($array_idData[0]){   //check the type of graph
                    case "cns":
                        $dt[$index] = self::generateDataSetNode($str_id,array_slice ($array_idData,1));
                        $index++;
                        break;
                    case "prd":
                        $dt[$index] = self::generateDataSetNode($str_id,array_slice ($array_idData,1));
                        $index++;
                        break;
                    case "str":
                        break;
                    case "mUP":
                        break;
                    case "mSL":
                        break;
                }
                

            }

            return JSON_encode($dt);
        }

        private static function generateDataSetNode($str_id,$idData){
            $id = $idData[0]; //all or the node id

            if(count($idData)>1){
                $param = $idData[1];
            }else{
                $param = "";
            }

            switch($id){
                case "all":
                    return self::getAllDataSet($str_id,$param);
                    break;
                default:
                    break;
            }
        }

        private static function getAllDataSet($str_id,$soption){

            $array_idData = preg_split ('/_/',$str_id,-1,PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);

            if($array_idData[0]=="cns"){
                $set["label"] = "All power consumtion";
                $set["borderColor"] = "rgb(0, 186, 219)";
                $set["backgroundColor"] = "rgba(0, 186, 219,0.2)";
            }else{
                if($array_idData[2]=="PWR"){
                    $set["label"] = "All power production";
                    $set["borderColor"] = "rgb(44, 219, 0)";
                    $set["backgroundColor"] = "rgba(44, 219, 0,0.2)";
                }else{
                    $set["label"] = "All CO2 production";
                    $set["borderColor"] = "rgb(219, 0, 0)";
                    $set["backgroundColor"] = "rgba(219, 0, 0,0.2)";
                }

                
            }

            
            $set["data"] = [5,6,5,4,5,6,5,4,5,6];
            
            $set["lineTension"] = 0.2;
            $set["fill"] = "origin";
            

            $data["id"] = $str_id;
            $data["set"][0] = $set;

            return $data;
        }

    }

?>