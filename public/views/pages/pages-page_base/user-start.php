<?php $ex = VALIDATIONS_U::val_select_data_user();?>
<link rel="stylesheet" href="/css/style-user-start_____.css">
<link rel="stylesheet" href="/css/Responsive/rsp_style-user-start_.css">
<div class="container">
    <div class="container-perfil font_containers">
        <img src="<?php echo "/public/tmp/users/directori_". $_COOKIE['id_user'] ."/img_perfil_big.jpg" ?>" alt="">
        <div class="container-perfil-data">
            <h3>NOMBRE DE USUARIO</h3>
            <p><?php echo $ex['name_user'];?></p>
            <br>
            <h3>ESTADO</h3>
            <p class="state"><?php echo $ex['state'];?></p>
        </div>
    </div>
    <div class="container-date font_containers">
        <div class="area">
            <p>Rango:</p>
            <p class="p_dinamic"><?php echo $ex['rank'];?></p>
        </div>
        <div class="area">
            <p>Puntos:</p>
            <p class="p_dinamic"><?php echo $ex['point'];?></p>
        </div>
        <div class="area">
            <p>Participaciones:</p>
            <p class="p_dinamic"><?php echo $ex['participation'];?></p>
        </div>
        <div class="area">
            <p>Puesto:</p>
            <p class="p_dinamic"><?php echo $ex['position'];?></p>
        </div>
    </div>
    <div class="container-subcontainer">
        <!-- box -->
        <?php
        
        if(isset($_COOKIE['user_id_fo']) and $_COOKIE['user_id_fo'] != "none"){
            include "user-start/event.php";
            include "user-start/ranking.php";
            include "user-start/settings.php";
            include "user-start/fo.php";
        }else{
            include "user-start/fo.php";
        }?>
    </div>
</div>