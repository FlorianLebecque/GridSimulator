<?php
    
    class graphDataHandler{

        static public function getData($str_arrayID){
            $array_GraphID = json_decode($str_arrayID);

            $dt = [];
            $index = 0;
            for($i = 0; $i < count($array_GraphID);$i++){
                $str_id = $array_GraphID[$i];   //get the current id we are working on

                $array_idData = preg_split ('/_/',$str_id,-1,PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);

                $dt[$index] = self::getDataNode($str_id,array_slice($array_idData,1));
                $index++;

            }

            return JSON_encode($dt);    //convert the array into json string for data transfer
        }

        private static function getDataNode($str_id,$idData){
            $id = $idData[0]; //all or the node id

                //sort if we are looking for a specific node or not
            switch($id){
                case "all":     //not a node
                    return self::generateAllData($str_id);
                    break;
                default:        //here $id is the id of the node
                    return self::generateData($str_id);
                    break;
            }
        }

        private static function generateAllData($str_id){
            $array_idData = preg_split ('/_/',$str_id,-1,PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);   //decompose the str_id (prd_all_PWR)

            $data["id"] = $str_id;

            $sim_id =$array_idData[count($array_idData)-1];


            if($array_idData[0]=="cns"){                            //if it's a cns (consumption)
                $dt = simdataHandler::getALL($sim_id,"c","PWR");
            }elseif($array_idData[0]=="mUP"){
                $dt = simdataHandler::getALL($sim_id,"p","price");
            }elseif($array_idData[0]=="mSL"){
                $dt = simdataHandler::getALL($sim_id,"c","price");
            }else{                                                  //if it's a production
                if($array_idData[2]=="PWR"){                            //we want the power
                    $dt = simdataHandler::getALL($sim_id,"p","PWR");
                }else{                                                  //CO2 production
                    $dt = simdataHandler::getALL($sim_id,"p","CO2");
                }
            }

            $data["data"] = $dt;
            return $data;        
        }    

        private static function generateData($str_id){
            $array_idData = preg_split ('/_/',$str_id,-1,PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);   //decompose the str_id (prd_all_PWR)

            $data["id"] = $str_id;

            if($array_idData[0]=="cns"){                            //if it's a cns (consumption)
                $dt = simdataHandler::getNodeData($array_idData[1],"PWR");
            }else{                                                  //if it's a production
                if($array_idData[2]=="PWR"){                            //we want the power
                    $dt = simdataHandler::getNodeData($array_idData[1],"PWR");
                }else{                                                  //CO2 production
                    $dt = simdataHandler::getNodeData($array_idData[1],"CO2");
                }
            }

            $data["data"] = $dt;
            return $data;        
        }   

    }

    class graphArray{
            //function that create the production or consumation graphics array
        static public function createGraphArray($type,$dataType = "PWR"){                       // type -> define if we use prd or cns | datatype -> power or co2
            $data = simdataHandler::getNode_by_type($_SESSION["simulation"],$type);     // get the node data needed

            $count = count($data);

            $int_numRow = floor($count / 3);
            if($count % 3 != 0){
                $int_numRow += 1;
            }

            for($i = 0; $i < $int_numRow; $i++){
                echo "<div class='row'>";

                for($j = $i*3; $j < 3+($i*3);$j++){
                    if($j < $count){
                        echo '<div class="col-lg-4 graphContainer" >';
                        echo '<h3>'.$data[$j]["label"].'</h3>';
                        echo '<canvas id="prd_'.$data[$j]["id"].'_'.$dataType.'"></canvas>';
                        echo '</div>';
                    } 
                }

                echo "</div><br><br>";
            }

        }
    }
    
    //------------------------------------------------------
    //      Class that handle all the dataset creation
    //------------------------------------------------------
    class graphDataSetHander{

        //------------------------------------------------
        //      function that sort datasets request
        //------------------------------------------------
        public static function getDataSets($str_arrayID){
            $array_GraphID = json_decode($str_arrayID);         //convert the string into a real array

            $dt = [];       //array of assoc array contains [[cns_all,set],[prd_all_PWR,set],[prd_1_PWR,set]]
            $index = 0;     //counter to know how many array are created

            for($i = 0; $i < count($array_GraphID);$i++){
                $str_id = $array_GraphID[$i];   //get the current id we are working on

                $array_idData = preg_split ('/_/',$str_id,-1,PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);

                $sim_id = $array_idData[count($array_idData)-1];

                $dt[$index] = self::getDataSetNode($str_id,array_slice ($array_idData,1),$sim_id);
                $index++;
            }

            return JSON_encode($dt);    //convert the array into json string for data transfer
        }
        //-------------------------------------------------------------------------
        //      function that get the dataset for the correct type of node
        //-------------------------------------------------------------------------
        private static function getDataSetNode($str_id,$idData,$sim){
            $id = $idData[0]; //all or the node id

                //sort if we are looking for a specific node or not
            switch($id){
                case "all":     //not a node

                    return self::generateAllDataSet($str_id,$sim);
                    break;
                default:        //here $id is the id of the node
                    return self::generateNodeDataSet($str_id);
                    break;
            }
        }

        //------------------------------------------------
        //      function to generate the dataset array
        //------------------------------------------------
        private static function generateAllDataSet($str_id,$sim){

            $array_idData = preg_split ('/_/',$str_id,-1,PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);   //decompose the str_id (prd_all_PWR)

            if($array_idData[0]=="cns"){                            //if it's a cns (consumption)
                $set["label"] = "All power consumtion";
                $set["borderColor"] = "rgb(0, 186, 219)";
                $set["backgroundColor"] = "rgba(0, 186, 219,0.2)";
                $set["data"] = simdataHandler::getALL($sim,"c","PWR");
            }elseif($array_idData[0]=="mUP"){
                $set["label"] = "Production Cost";
                $set["borderColor"] = "rgb(242, 66, 245)";
                $set["backgroundColor"] = "rgba(242, 66, 245,0.2)";
                $set["data"] = simdataHandler::getALL($sim,"p","price");
            }elseif($array_idData[0]=="mSL"){
                $set["label"] = "Money intake";
                $set["borderColor"] = "rgb(255, 227, 46)";
                $set["backgroundColor"] = "rgba(255, 227, 46,0.2)";
                $set["data"] = simdataHandler::getALL($sim,"c","price");
            }else{                                                  //if it's a production
                if($array_idData[2]=="PWR"){                            //we want the power
                    $set["label"] = "All power production";
                    $set["borderColor"] = "rgb(44, 219, 0)";
                    $set["backgroundColor"] = "rgba(44, 219, 0,0.2)";
                    $set["data"] = simdataHandler::getALL($sim,"p","PWR");
                }else{                                                  //CO2 production
                    $set["label"] = "All CO2 production";
                    $set["borderColor"] = "rgb(219, 0, 0)";
                    $set["backgroundColor"] = "rgba(219, 0, 0,0.2)";
                    $set["data"] = simdataHandler::getALL($sim,"p","CO2");
                 }
            }

            $set["lineTension"] = 0.2;              //make line smooth
            $set["fill"] = "origin";                //create an area under the line
            
            $data["id"] = $str_id;
            $data["set"][0] = $set;

            //data is an array with [0] -> str_id (prd_all_PWR) and [1] -> the new generated set

            return $data;
        }

        //------------------------------------------------
        //      function to generate the dataset array
        //------------------------------------------------
        private static function generateNodeDataSet($str_id){

            $array_idData = preg_split ('/_/',$str_id,-1,PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);

            $label = simdataHandler::getNodeLabel($array_idData[1]);

            $set["label"] = $label[0]["label"];

                //generate random color for the charts
            $r = rand(20,255);
            $g = rand(20,255);
            $b = rand(20,255);

            $set["borderColor"] = "rgb(".$r.", ".$g.", ".$b.")";
            $set["backgroundColor"] = "rgba(".$r.", ".$g.", ".$b.",0.2)";

            $set["data"] = simdataHandler::getNodeData($array_idData[1],$array_idData[2]);   //placeholder data (must be change by last availaible data)
            $set["lineTension"] = 0.2;              //make line smooth
            $set["fill"] = "origin";                //create an area under the line
            
            $data["id"] = $str_id;
            $data["set"][0] = $set;

            //data is an array with [0] -> str_id (prd_1_PWR) and [1] -> the new generated set

            return $data;
        }

    }

?>