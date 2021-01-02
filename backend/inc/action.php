<?php

    class ActionHandler{

        public static function LogOff(){
            session_destroy();
            header('Location: index.php');
        }   

        public static function addNodeType(){


                //check that we are indeed connected
            if(isset($_SESSION["simulation"])){

                if(isset($_POST["nodeType"])){

                    $label = $_POST["nodeLabel"];
                    $BDD = bdd::getBDD();
                    $type_template = simdataHandler::getNodeTypeField_by_type($_POST["nodeType"],$BDD);                    
                    $meta_field = json_decode($type_template[0]["field"]);

                    $meta = [];

                    for($i = 0; $i < count($meta_field);$i++){

                        $str_fieldName = $meta_field[$i][0];
                        $int_fieldValue = $meta_field[$i][1];

                        if(isset($_POST[$str_fieldName])){
                            if($_POST[$str_fieldName] == ""){
                                $meta[$str_fieldName] = $int_fieldValue;
                            }else{
                                $meta[$str_fieldName] = $_POST[$str_fieldName];
                            }
                        }
                    }

                    simdataHandler::addNewNodeType($label,$_SESSION["simulation"],$_POST["nodeType"][0],$_POST["nodeType"],json_encode($meta),$BDD);
                }

            }
            header('Location: index.php?p=editor');
        }
    }

?>