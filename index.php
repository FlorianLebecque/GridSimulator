<?php
    header('Content-Type: text/html; charset=utf-8');
    include_once("controller/controller.php");
    $crtl = new Controller();
    $crtl -> invoke();
?>