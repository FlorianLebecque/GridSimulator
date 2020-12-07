<?php
    class simdataHandler{

        static public function getPrdType(){

        }

        static public function getCnsType(){

        }

        static public function getNodeType(){

        }


        static public function getNode($sim,$type){
            $req = bddQuerry::getNopeQuerry_by_type($sim,$type);
            return bdd::getData($req);
        }

    }
?>