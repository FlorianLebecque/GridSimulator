<?php

    include_once("backend\inc\database.php");

    $err=0;
    if(
        (isset($_POST["sim"]))&&
        (isset($_POST["pass1"]))&&
        (isset($_POST["pass2"]))
    ){
        if(
            ($_POST["sim"]!="")&&
            ($_POST["pass1"]!="")&&
            ($_POST["pass2"]!="")
        ){
            if($_POST["pass1"]==$_POST["pass2"]){

                $reg1 = "#[a-z]{3,}#";  //au moin trois lettre minuscule
                $reg2 = "#[A-Z]+#";     //au moin une majuscule
                $reg3 = "#[0-9]+#";     //au moin 1 chiffre

                $test1 = preg_match($reg1,$_POST["pass1"]);
                $test2 = preg_match($reg2,$_POST["pass1"]);
                $test3 = preg_match($reg3,$_POST["pass1"]);

                if(($test1)&&($test2)&&($test3)){

                    $name = htmlspecialchars($_POST["sim"]);

                    $req = bddQuery::getCountSimQuery($name);
                    $count = mysqli_fetch_array(bdd::sendQuery($req),MYSQLI_ASSOC);


                    if($count["count"]==0){
                        $_POST["sim"] = htmlspecialchars($_POST["sim"]);
                        $_POST["pass1"] = md5(htmlspecialchars($_POST["pass1"]));

                            //create new sim
                        $req = bddQuery::getAddSimQuery($_POST["sim"],$_POST["pass1"]);
                        $res = bdd::sendQuery($req);

                            //get sim id
                        $req = bddQuery::getLastSimQuery($name);
                        $LastSimId = bdd::getData($req)[0]["id"];

                            //insert node N1
                        $req = bddQuery::InsertNodeQuery($LastSimId,0,"N1");
                        bdd::setData($req);

                        $err=10;
                    }else{
                        $err=5;
                    }
                    
                }else{
                    $err=4;
                }
            }else{
                $err=3;
            }
        }else{
            $err=0;
        }
    }

    header('Location: index.php?e='.$err);

?>