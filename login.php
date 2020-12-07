<?php
    include("backend\inc\database.php");

    $err = 0;
    if((isset($_POST["sim"]))&&(isset($_POST["pass"]))){
        if($_POST["sim"]!=""){
            if($_POST["pass"]!=""){

                $name = htmlspecialchars($_POST["sim"]);
                $testPass = htmlspecialchars($_POST["pass"]);
                
                $req = bddQuerry::qetTestSimNameQuery($name);
                $BDD = bdd::getBDD();
                $data = bdd::sendQuery($req);
                $pass = mysqli_fetch_array($data,MYSQLI_ASSOC);

                if(md5($testPass)==$pass["psw"]){
                    session_start();
                    $_SESSION["simulation"] = $pass["id"];
                    $_SESSION["sim_name"] = $name;
                    header('Location: index.php');
                }else{
                    $err=2;
                }

            }else{
                $err = 1;
            }
        }else{
            $err=1;
        }
        
    }
    header('Location: index.php?e='.$err);
?>