<?php

    class nodeHandler{

        public static function getNodes($sim,$BDD){

            $nodes_array = simdataHandler::getNode($sim,$BDD);
            $type_array = simdataHandler::getNodeType($sim,$BDD);
            $child_array = simdataHandler::getNodeChild($sim,$BDD);

            

            $nodes_array = self::formatNode_array($nodes_array);
            $type_array = self::formatType_array($type_array);
            $child_array = self::formatChild_array($child_array);


            //find the n1 node id

            $int_FirstNodeID = simdataHandler::getFirstNode($sim,$BDD)[0]["id"];

            //$int_fistNodeID = ;
            return self::createNode($int_FirstNodeID,$nodes_array,$type_array,$child_array,$BDD);
        }

            //recursive function that create a node based on it's type
        private static function createNode($id,$nodes_array,$type_array,$child_array,$BDD){

            $cur_node = $nodes_array[$id];
            $temp_node = [];

            if($cur_node["id_type"] == 0){

                $temp_node = array(
                    "id" => $id,
                    "type" => "n",
                    "label"=> $cur_node["label"],
                    "child" => [],
                    "enable"=> 1
                );

                if(isset($child_array[$id])){
                    for($i = 0;$i < count($child_array[$id]);$i++){
                        array_push($temp_node["child"],self::createNode($child_array[$id][$i]["id_child"],$nodes_array,$type_array,$child_array,$BDD));    
                    }
                }

            }else{

                $node_type =$type_array[$cur_node["id_type"]]["type"];
                
                $temp_node = array(
                    "id" => $id,
                    "type" => $node_type,
                    "label"=> $cur_node["label"],
                    "child" => [],
                    "enable" => 1
                );

            }

            return $temp_node;
        }   


            //format the nodes data into a assoc array
        private static function formatNode_array($nodes_array){

            $new_nodeArray = [];

            for($i = 0;$i < count($nodes_array);$i++){
                $new_nodeArray[$nodes_array[$i]["id"]] = array(
                    "id_type" => $nodes_array[$i]["id_type"],
                    "label" => $nodes_array[$i]["label"]
                );
            }

            return $new_nodeArray;
        }

        private static function formatType_array($type_array){

            $new_typeArray = [];

            for($i = 0;$i < count($type_array);$i++){
                $new_typeArray[$type_array[$i]["id"]] = array(
                    "label" => $type_array[$i]["label"],
                    "type" => $type_array[$i]["type"],
                    "meta" => $type_array[$i]["meta"]
                );
            }

            return $new_typeArray;
        }

        private static function formatChild_array($child_array){

            $new_ChildArray = [];

            for($i = 0;$i < count($child_array);$i++){
                if(isset($new_ChildArray[$child_array[$i]["id_parent"]])){
                    array_push($new_ChildArray[$child_array[$i]["id_parent"]],array(
                        "id_child" => $child_array[$i]["id_child"],
                        "max_pwr" => $child_array[$i]["max_pwr"]
                    ));
                    
                }else{

                    $new_ChildArray[$child_array[$i]["id_parent"]] = array(
                        array(
                            "id_child" => $child_array[$i]["id_child"],
                            "max_pwr" => $child_array[$i]["max_pwr"]
                        )
                    );

                }
            }

            return $new_ChildArray;
        }

        public static function addNode($param,$BDD){
            $array_param = preg_split ('/_/',$param,-1,PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);   //decompose the param (idSim_idParent_typeID_label)

            $sim = $array_param[0];
            $parent_id = $array_param[1];
            $type_id = $array_param[2];
            $node_label = $array_param[3];
            $link_power = $array_param[4];

            simdataHandler::InsertNode($sim,$parent_id,$type_id,$node_label,$link_power,$BDD);

            return json_encode(self::getNodes($sim));
        }

        public static function rmvNode($param,$BDD){

            $array_param = preg_split ('/_/',$param,-1,PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);   //decompose the param (idSim_idParent_typeID_label)
            simdataHandler::DeleteNode($array_param[1],$BDD);
            return json_encode(self::getNodes($array_param[0]));

        }

        public static function rmvType($param,$BDD){
            $array_param = preg_split ('/_/',$param,-1,PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
            simdataHandler::rmvType($array_param[0],$array_param[1],$BDD);
            return json_encode(self::getNodes($array_param[0]));
        }

    }

?>