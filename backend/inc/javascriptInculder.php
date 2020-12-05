<?php
    function include_js($path){
        if(file_exists($path)){
            echo "<script src='".$path."'></script>";
        }
    }
?>