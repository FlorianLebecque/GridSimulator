<?php

    class simdataHandler{

        static public function getNodeType($sim,$BDD){           //
            $req = bddQuery::getNodeTypeQuery($sim);        //  get the node type for the simulation
            return bdd::getData($req,$BDD);                      //
        }

        static public function getNodeTypeField($BDD){          //
            $req = bddQuery::getNodeTypeFieldQuery();       //  get the type_meta_field
            return bdd::getData($req,$BDD);                      //
        }

        static public function getNodeType_by_simpleType($sim,$stype,$BDD){      //
            $req = bddQuery::getNodeTypeQuery_by_simpleType($sim,$stype);   //  get the node type for the simulation but filter on the simple type
            return bdd::getData($req,$BDD);                                      //
        }

        static public function getNodeTypeField_by_type($type,$BDD){     //
            $req = bddQuery::getNodeTypeFieldQuery_by_type($type);  //  get the type meta field with a condition on the type
            return bdd::getData($req,$BDD);                              //
        }

        static public function getNode_by_type($sim,$type,$BDD){         //function to get the node by type (P,C,N)
            $req = bddQuery::getNopeQuery_by_type($sim,$type);      //get the mysql query require to get the data
            return bdd::getData($req,$BDD);                              //get the all the node
        }

        static public function getNodeLabel($id,$BDD){           //
            $req = bddQuery::getNodeLabelQuery($id);        //  get node label
            return bdd::getData($req,$BDD);                      //
        }
        
        public static function getNode($sim,$BDD){
            $req = bddQuery::getNodeQuery($sim);
            return bdd::getData($req,$BDD);
        }

        public static function getNodeID_by_st($sim,$simple_type,$BDD){
            $req = bddQuery::getNodeID_by_stQuery($sim,$simple_type);
            return bdd::getData($req,$BDD);
        }

        static public function getALL($sim,$type,$key,$BDD){

            $nodes_id = (self::getNodeID_by_st($sim,$type,$BDD));

            //return $nodes_id;

            $value = [0,0,0,0,0,0,0,0,0,0];
            for($i = 0; $i < count($nodes_id);$i++){
                $node_data = self::getNodeData($nodes_id[$i]["id"],$key,$BDD);
                
                for($j = 0; $j < count($node_data);$j++){
                    $value[$j] += $node_data[$j];
                }

            } 

            return $value;
        }

        static public function getNodeData($id,$key,$BDD){
            $req = bddQuery::getNodeDataQuery($id,$key);
           
            $data = bdd::getData($req,$BDD);

            $dt = [];
            for($i = count($data)-1; $i >= 0 ;$i--){      
                array_push($dt,$data[$i][$key]);

            }

            return $dt;
        }

        static public function addNewNodeType($label,$sim,$stype,$type,$meta,$BDD){          //
            $req = bddQuery::getAddNewNodeTypeQuery($label,$sim,$stype,$type,$meta);    //  Add a new node type in pe_node_type
            return bdd::setData($req,$BDD);                                                  //
        }

        public static function getNodeChild($sim,$BDD){
            $req = bddQuery::getNodeChildQuery($sim);
            return bdd::getData($req,$BDD);
        }

        public static function getFirstNode($sim,$BDD){
            $req = bddQuery::getFirstNodeQuery($sim);
            return bdd::getData($req,$BDD);
        }

        public static function InsertNode($sim,$parent_id,$type_id,$node_label,$max_power,$BDD){
            $req = bddQuery::InsertNodeQuery($sim,$type_id,$node_label);
            bdd::setData($req,$BDD);

            $node_id = self::getLastNode($sim,$BDD)[0]["id"];

            $req = bddQuery::InsertChildQuery($parent_id,$node_id,$max_power);
            return bdd::setData($req,$BDD);
            
        }

        public static function getLastNode($sim,$BDD){
            $req = bddQuery::getLastNodeQuery($sim);
            return bdd::getData($req,$BDD);
        }

        public static function getLastSim($sim,$BDD){
            $req = bddQuery::getLastSimQuery($sim);
            return bdd::getData($req,$BDD);
        }

        public static function DeleteNode($id,$BDD){

            $req = bddQuery::DeleteChildQuery($id);
            bdd::setData($req,$BDD);

            $req = bddQuery::DeleteNodeQuery($id);
            return bdd::setData($req,$BDD);
        }

        public static function rmvType($sim,$id,$BDD){
            $req = bddQuery::rmvTypeQuery($sim,$id);
            return bdd::setData($req,$BDD);
        }

        public static function getWind($t){
            return exp(
                (-1/2)*
                (($t-6)/(2.5*sqrt(2)))*(($t-6)/(2.5*sqrt(2)))
            )+exp(
                (-1/2)*
                (($t-18)/(2.5*sqrt(2)))*(($t-18)/(2.5*sqrt(2)))
            );
        }

        public static function getSun($t){
            return exp(
                (-1/2)*
                (($t-12)/(5*sqrt(2)))*(($t-12)/(5*sqrt(2)))
            );
        }

        public static function getLastTime($sim,$BDD){
            $req = bddQuery::getLastTimeQuery($sim);
            $res = bdd::getData($req,$BDD)[0]['TIME'];

            echo $res;

            if($res != null){
                return $res;
            }else{
                return 0;
            }
        }

        public static function getSummary($sim,$BDD){
                //get the last time of the sim
            $lastTimeResult = self::getLastTime($sim,$BDD);

                //compute the hour
            $hour = $lastTimeResult % 24;

                //get wind and sun
            $wind = self::getWind($hour)*100;
            $sun = self::getSun($hour)*100;

            $res = [$lastTimeResult, $hour,$sun,$wind];

            return $res;
        }

        public static function getLog($sim,$BDD){
            $t = self::getLastTime($sim,$BDD);

            $req = bddQuery::getLogQuery($sim,$t);
            return bdd::getdata($req,$BDD);

        }

    }
?>