<!DOCTYPE html>
<html>
    <?php
        include_once("public/html/head.html");
    ?>

    <body>
        
        <div class="containerLogin">
            <div class="center">
            <?php
                if(isset($_GET["e"])){
                    $err = htmlspecialchars($_GET["e"]);
                    switch($err){
                        case 1:  echo "<div class='nav main'><p class='err'>Fill all the case</p></div>\n";
                            break;
                        case 2:  echo "<div class='main'><p class='err'>The username or password is invalid</p></div>\n";
                            break;
                        case 3:  echo "<div class='main'><p class='err'>Password doen't match</p></div>\n";
                            break;
                        case 4:  echo "<div class='main'><p class='err'>Password must contain : 3 letters , 1 number, 1 maj</p></div>\n";
                            break;  
                        case 5:  echo "<div class='main'><p class='err'>Simulation name already taken</p></div>\n";
                            break; 
                        case 10:  echo "<div class='main'><p class='good'>Simulation added</p></div>\n";
                            break; 
                    } 
                }
            
            ?>
            <div class="row main logInWidth">
                <div class="col">
                    <button class="collapsible">Login</button>
                    <div class="collasibleContent "><hr>

                        <form method="post" action="login.php">
                            <input name="sim" class="inpt fullW margB" type="text" placeholder="Simulation name"><br>
                            <input name="pass" class="inpt fullW margB" type="password" placeholder="password"><br>
                            <input class="btn margB" type="submit" value="SIGN IN"><br>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row main logInWidth">
                <div class="col">
                    <button class="collapsible">New simulation</button>
                    <div class="collasibleContent "><hr>
                        <form method="post" action="signin.php">
                            <input name="sim" class="inpt fullW margB" type="text" placeholder="Simulation name"><br>
                            <input name="pass1" class="inpt fullW margB" type="password" placeholder="password"><br>
                            <input name="pass2"class="inpt fullW margB" type="password" placeholder="retype password"><br>
                            <input class="btn margB" type="submit" value="CREATE"><br>
                        </form>
                    </div>
                </div>
            </div>
</div>
       </div>

        <?php
            include_once("frontend/footer.php");
        ?>
        
    </body>
</html>