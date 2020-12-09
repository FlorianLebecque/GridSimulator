<?php
    class editorData{

        public static function getTypeOption($sim){
            $data = simdataHandler::getNodeType($sim);

            for($i = 0; $i < count($data);$i++){
                echo "<option>".$data[$i]["label"]."</option>";
            }

        }

        public static function getTypeField(){
            return simdataHandler::getNodeTypeField();
        }

        public static function get_TypeTable($sim,$stype){
            $data = simdataHandler::getNodeType_by_simpleType($sim,$stype);

            for($i = 0; $i < count($data);$i++){
                echo "<tr>";
                echo "<td>".$data[$i]["label"]."</td>";
                echo "<td>".$data[$i]["meta"]."</td>";
                echo "<td><button class='btn float-right' id='prd_".$data[$i]["id"]."'> x </button></td>";
                echo "</tr>";
            }
        }

    }

?>