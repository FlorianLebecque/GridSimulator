<?php
    //tsety
    //$crtl->status = true;
    if($_REQUEST["q"]=="1"){
        echo file_get_contents("public/img/svgPauseIcon.html");
    }else{
        echo $_REQUEST["q"]+rand(-3,3);
    }
?>