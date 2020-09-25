<?php

session_start(); 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="/css/styles-general_.css">
    <link rel="stylesheet" href="/css/responsive/rsp_style-general__.css">
    
    <title>@nameUser</title>
</head>
<body>
    <div class="container_body">
        <!-- toolbar -->
        <style>
            .no{
                display: none;
            }
        </style>
        <div id="toolbar_right" class="minn_screen">
        <div class="toolbar_in_fullscreen">
            <?php include "pages-template/toolbar-right.php"; ?>
        </div>
        </div>
        <div id="espace" class="container_body-espace min_screen">
            
            <div id="toolbar_top" class="container_body-espace-toolbar_top min_screen">
                <!--------------------radio--------------------->
                <input type="radio" id="show1" name="group" value="option1" />
                <input type="radio" id="show2" name="group" value="option2" />
                <!--------------------radio--------------------->
                <label class="bar" for="show2">
                <img src="/svg/bars-solid.svg" alt="" onclick="abrir_toolbar();">
                </label>

                <label class="x"for="show1" >
                    <!-- <button onclick = "action();">0</button> -->
                    <img src="/svg/x-solid.svg" alt="" onclick="cerrar_toolbar();"  >
                </label>
                <script>
                    /* "/controllers/template.controller.php" */
                 function cerrar_toolbar(){
                     $.ajax({
                         url:'/controllers/template.controller.php',
                         type: "post",
                         data: {valor: false},
                         success: function(respuesta){
                            $("#espace").removeClass("min_screen");
                            $("#toolbar_top").removeClass("min_screen");
                            /* $("#toolbar_right").text(respuesta); */
                            $("#toolbar_right").addClass("no");
                            /* console.log(respuesta); */
                            $("#espace").addClass("extend_full");
                            $("#toolbar_top").addClass("extend_full");
                         }
                     });
                      }
                function abrir_toolbar(){
                     $.ajax({
                         url:'/controllers/template.controller.php',
                         type: "post",
                         data: {valor: true},
                         success: function(respuesta){
                            $("#espace").removeClass("min_screen");
                            $("#toolbar_top").removeClass("min_screen");
                            /* $("#toolbar_right").html(respuesta); */
                            $("#toolbar_right").removeClass("no");
                            $("#toolbar_right").removeClass("minn_screen");
                            /* console.log(respuesta); */
                            $("#espace").removeClass("extend_full");
                            $("#toolbar_top").removeClass("extend_full")
                         }
                     });
                      }
                    </script>
                    
                <img src="/svg/search-solid.svg" alt="">
            </div>
            
            <div class="container_body-espace-container">
                <!-- my-body-container -->
                <!-- <php include "pages-template/user-start.php"; ?>  -->
                <?php 
                
                if(isset($_GET['pagina'])){
                    include "pages-template/f_o.php";
                }else if(isset($_GET['new_fo'])){
                    include "pages-template/create-fo.php"; 
                }else if(isset($_GET['address'])){
                    include "pages-template/f_o.php";
                }else{
                    include "pages-template/user-start.php"; 
                }

                ?>
            </div>

        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</body>
</html>
