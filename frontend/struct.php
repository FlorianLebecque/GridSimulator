<!DOCTYPE html>
<html>
    <?php
        include_once("public/html/head.html");
    ?>
    <script>
        let status = 0;
        let timerFunction = [];
        let timerHDL = new timerHandler();
    </script>
    <body>

        <?php
            include_once("frontend/header.php");
        ?>

        <?php
            if(isset($_GET["p"])){

                $str_page = htmlspecialchars($_GET["p"]);
                if(file_exists("frontend/page/".$str_page.".php")){
                    include_once("frontend/page/".$str_page.".php");
                }else{
                    include_once("public/html/404.html");
                }

            }else{
                include_once("frontend/page/dashboard.php");
            }
        ?>

        <?php
            include_once("frontend/footer.php");
        ?>
        
    </body>
</html>