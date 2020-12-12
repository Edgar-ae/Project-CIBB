<?php
$data=CTR_FO_ACCESS::ctr_select_users();
/* echo'hola<pre>';
print_r($data);
echo'</pre>'; */
/* echo substr($data['lider'][2], 0, 4);//Recortar una cadena de caracteres */
?>
<div class="container_members">
    <div class="container_categori">
        <span>✨:LIDER</span>
        <div class="container_users">
            <!--  -->
            <a class="aa" onclick="box_user(<?php echo$data['lider'][0];?>);">
            <div class="user">
                <div class="line B_leader"></div>
                <img src="/public/tmp/all_img_users/user_<?php echo$data['lider'][0];?>_img.jpg" alt="">
                <div class="data">
                <div class="space_name">
                    <h2 class="name C_leader"><?php echo$data['lider'][1]?></h2><img class="img_pink" src="/public/img/img04.png">
                    <div class="points"><img class="img_blue" src="/public/img/img05.png"><p><?php echo$data['lider'][4]?></p></div>
                </div>
                    <samp class="estado"><?php echo substr($data['lider'][2],0,38);?></samp>
                </div>
            </div>
            </a>
           <!--  -->
           <script src="/js/perfil_user__.js"></script>
           <script>
                function box_user(id_user){
                    $.ajax({
                    url: '/public/ajax/ajax_perfil_users.php',
                    type: 'POST',
                    data: 'id_user='+id_user,
                    dataType: "json",
                    success:function(rpt){
                        user_box(rpt);
                    }
                });
                }
           </script>
           
        </div>
    </div>
    <!--  -->
    <br>
    <!--  -->
<?php if($data['num_legends']!=0):?>
    <div class="container_categori">
        <span>🔥:LEYENDAS</span>
        <div class="container_users">
            <!--  -->
            <?php for($i=0;$i<$data['num_legends'];$i++):?>
            <a class="aa" onclick="box_user(<?php echo$data['legends'][$i][0];?>);">
            <div class="user">
                <div class="line B_legend"></div>
                <img src="/public/tmp/all_img_users/user_<?php echo$data['legends'][$i][0];?>_img.jpg" alt="">
                <div class="data">
                <div class="space_name">
                    <h2 class="name C_legend"><?php echo$data['legends'][$i][1];?></h2><img class="img_pink" src="/public/img/img04.png">
                    <div class="points"><img class="img_blue" src="/public/img/img05.png"><p><?php echo$data['legends'][$i][4];?></p></div>
                </div>
                    <samp class="estado"><?php echo substr($data['legends'][$i][2],0,38);?></samp>
                </div>
            </div>
            </a>
            <?php endfor;?>
    </div>
<?php endif;?>

        <!--  -->
        <br>
        <!--  -->
<?php if($data['num_officers']!=0):?>
    <div class="container_categori">
        <span>👻:INTEGRANTES OFICIALES</span>
        <div class="container_users">
        <?php for($i=0;$i<$data['num_officers'];$i++):?>
            <!--  -->
            <a  class="aa" onclick="box_user(<?php echo$data['officers'][$i][0];?>);">
            <div class="user">
                <div class="line B_i_oficer"></div>
                <img src="/public/tmp/all_img_users/user_<?php echo$data['officers'][$i][0];?>_img.jpg" alt="">
                <div class="data">
                <div class="space_name">
                    <h2 class="name C_i_oficer"><?php echo$data['officers'][$i][1];?></h2>
                    <div class="points"><img class="img_blue" src="/public/img/img05.png"><p><?php echo$data['officers'][$i][4];?></p></div>
                </div>
                    <samp class="estado"><?php echo substr($data['officers'][$i][2],0,38);?></samp>
                </div>
            </div>
            </a>
            <!--  -->
        <?php endfor;?>
    </div>
<?php endif;?>
    <br>
    <a href="/h?C=<?php echo $_GET['C'];?>&access=get&start=get">
    <button id="id_return">Regresar</button>
    </a>
</div>
<!-- //PAINT -->
<?php
$color_data = VALIDATIONS::ctr_obtaiin_color();
if($color_data != false){
echo"
<script>
    $('#id_body').css('background','".$color_data['c1']."');
    
    $('#id_btn_login').css('background','".$color_data['c2']."');
    $('#id_btn_register').css('background','".$color_data['c2']."');
    $('#id_p_u_cerrar_btn').css('background','".$color_data['c2']."');

    $('#id_return').css('background','".$color_data['c2']."');
    
    $('.container_body-espace-container').css('background','linear-gradient(to right,#ffffff00, ".$color_data['c3']."35, #ffffff00)');
    
    $('.header_cibb').css('background','".$color_data['c4']."98');
    $('.user').css('background','".$color_data['c6']."');
    $('.container').css('background','".$color_data['c4']."30');
    
    $('.toolbar_right-menu').html('<img src=/public/svg/menu-icon_width.svg>');
    $('#toolbar_top').css('background','".$color_data['c4']."');
    $('#id_toolbar_right').css('background','".$color_data['c4']."b4');
    $('.toolbar_right-menu').css('background','".$color_data['c4']."b4');

</script>
";
}
?>