<?php

    class simdataHandler{

        static public function getNodeType($sim){           //
            $req = bddQuery::getNodeTypeQuery($sim);        //  get the node type for the simulation
            return bdd::getData($req);                      //
        }

        static public function getNodeTypeField(){          //
            $req = bddQuery::getNodeTypeFieldQuery();       //  get the type_meta_field
            return bdd::getData($req);                      //
        }

        static public function getNodeType_by_simpleType($sim,$stype){      //
            $req = bddQuery::getNodeTypeQuery_by_simpleType($sim,$stype);   //  get the node type for the simulation but sort on the simple type
            return bdd::getData($req);                                      //
        }

        static public function getNodeTypeField_by_type($type){     //
            $req = bddQuery::getNodeTypeFieldQuery_by_type($type);  //  get the type meta field with a condition on the type
            return bdd::getData($req);                              //
        }

        static public function getNode_by_type($sim,$type){         //function to get the node by type (P,C,N)
            $req = bddQuery::getNopeQuery_by_type($sim,$type);      //get the mysql query require to get the data
            return bdd::getData($req);                              //get the all the node
        }

        static public function getNodeLabel($id){           //
            $req = bddQuery::getNodeLabelQuery($id);        //  get node label
            return bdd::getData($req);                      //
        }
        
        public static function getNode($sim){
            $req = bddQuery::getNodeQuery($sim);
            return bdd::getData($req);
        }

        static public function getALLPrdPWR(){
            return [1,2,3,4,5,6,7,8,9,10];
        }

        static public function getALLPrdCO2(){
            return [10,9,8,7,6,5,4,3,2,1];
        }

        static public function getALLCnsPWR(){
            return [1,2,3,4,5,5,4,3,2,1];
        }

        static public function addNewNodeType($label,$sim,$stype,$type,$meta){          //
            $req = bddQuery::getAddNewNodeTypeQuery($label,$sim,$stype,$type,$meta);    //  Add a new node type in pe_node_type
            return bdd::setData($req);                                                  //
        }

        public static function getNodeChild($sim){
            $req = bddQuery::getNodeChildQuery($sim);
            return bdd::getData($req);
        }

        public static function getFirstNode($sim){
            $req = bddQuery::getFirstNodeQuery($sim);
            return bdd::getData($req);
        }

        public static function InsertNode($sim,$parent_id,$type_id,$node_label,$max_power){
            $req = bddQuery::InsertNodeQuery($sim,$type_id,$node_label);
            bdd::setData($req);

            $node_id = self::getLastNode($sim)[0]["id"];

            $req = bddQuery::InsertChildQuery($parent_id,$node_id,$max_power);
            return bdd::setData($req);
            
        }

        public static function getLastNode($sim){
            $req = bddQuery::getLastNodeQuery($sim);
            return bdd::getData($req);
        }

        public static function getLastSim($sim){
            $req = bddQuery::getLastSimQuery($sim);
            return bdd::getData($req);
        }

        public static function DeleteNode($id){

            $req = bddQuery::DeleteChildQuery($id);
            bdd::setData($req);

            $req = bddQuery::DeleteNodeQuery($id);
            return bdd::setData($req);
        }

        public static function rmvType($sim,$id){
            $req = bddQuery::rmvTypeQuery($sim,$id);
            return bdd::setData($req);
        }

    }
?>