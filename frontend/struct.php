<!DOCTYPE html>
<html>
    <?php
        include_once("public/html/head.html");
    ?>
    <script>
        let simId = <?php echo $_SESSION["simulation"] ."\n" ?>
        let status = <?php echo $_SESSION["status"] ?>;

        let timerFunction = [];
        
        let wb = new webSocketHandler() 
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
                    include_js("frontend/JS/".$str_page.".js");
                }else{
                    include_once("public/html/404.html");
                }

            }else{
                include_once("frontend/page/dashboard.php");
                include_js("frontend/JS/dashboard.js");
            }
        ?>

        <?php
            include_once("frontend/footer.php");
        ?>
        
    </body>
</html>