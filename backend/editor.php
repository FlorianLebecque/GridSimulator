<?php
    class editorData{

        public static function getTypeOption($sim,$BDD){
            $data = simdataHandler::getNodeType($sim,$BDD);
            echo "<option value='0'>Node</option>";
            for($i = 0; $i < count($data);$i++){
                echo "<option value='".$data[$i]["id"]."'>".$data[$i]["label"]."</option>";
            }
        }

        public static function getTypeField($BDD){
            return simdataHandler::getNodeTypeField($BDD);
        }

        public static function get_TypeTable($sim,$stype,$BDD){
            $data = simdataHandler::getNodeType_by_simpleType($sim,$stype,$BDD);

            for($i = 0; $i < count($data);$i++){
                echo "<tr>";
                echo "<td>".$data[$i]["label"]."</td>";
                echo "<td>".$data[$i]["meta"]."</td>";
                echo "<td><button onclick='rmvType(".$sim.",".$data[$i]["id"].")' class='btn float-right' id='prd_".$data[$i]["id"]."'> x </button></td>";
                echo "</tr>";
            }
        }

        public static function getNodeTree($sim,$BDD){
            return nodeHandler::getNodes($sim,$BDD);
        }
    }
?>