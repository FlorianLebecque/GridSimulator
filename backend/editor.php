<?php
    class editorData{

        public static function getTypeOption($sim){
            $data = simdataHandler::getNodeType($sim);

            for($i = 0; $i < count($data);$i++){
                echo "<option>".$data[$i]["label"]."</option>";
            }

        }

    }

?>