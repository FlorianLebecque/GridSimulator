<?php
    class simdataHandler{

        static public function getPrdType(){

        }

        static public function getCnsType(){

        }

        static public function getNodeType($sim){
            $req = bddQuery::getNodeTypeQuery($sim);
            return bdd::getData($req);
        }


        static public function getNode_by_type($sim,$type){         //function to get the node by type (P,C,N)
            $req = bddQuery::getNopeQuery_by_type($sim,$type);    //get the mysql query require to get the data
            return bdd::getData($req);                              //get the all the node
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

    }
?>