<?php
    class simdataHandler{

        static public function getPrdType(){

        }

        static public function getCnsType(){

        }

        static public function getNodeType($sim){
            $req = bddQuerry::getNodeTypeQuery($sim);
            return bdd::getData($req);
        }


        static public function getNode_by_type($sim,$type){         //function to get the node by type (P,C,N)
            $req = bddQuerry::getNopeQuery_by_type($sim,$type);    //get the mysql querry require to get the data
            return bdd::getData($req);                              //get the all the node
        }

    }
?>