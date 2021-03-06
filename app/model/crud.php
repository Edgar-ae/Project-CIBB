<?php
require_once ($_SERVER['DOCUMENT_ROOT']. '/app/config/config.php');
require_once (URL_PROJECT. '/app/libs/console.php');
require_once (URL_PROJECT. '/app/model/connection.php');
/* -- */
class CRUD extends Connection{
    function __construct(){
        $this->connect();
    }
    function select_code(){
        $pr = $this->conn->prepare("SELECT fo_code FROM`f_o`WHERE fo_id=?");
        $pr->bind_param("i",$_SESSION['sess_id']);
        if($pr->execute()){
            $pr->store_result();
            $pr->bind_result($fo_code);
            //obtenemos el resultado
	        while($pr->fetch()){
                $_SESSION['sess_code']=$fo_code; 
                $this->rank_user_leader();
            }
            $pr->close();
        }else{
            exit('Error al realizar la consulta:'.$pr->close());
        }
    }
    function rank_user_leader(){
        $pr=$this->conn->prepare("UPDATE `the_user` SET `us_rank`=?, `fo_id`=? WHERE us_id=?");
        $rank='leader';
        $pr->bind_param("sii", $rank, $_SESSION['sess_id'], $_COOKIE['id_user']);
        if($pr->execute()){
            console('rank user finished');
        } else {
            exit('Error al realizar la consulta:'.$pr->close());
        }
    }
    function crud_obtain_code_fo(){
        $pr=$this->conn->prepare("SELECT fo_code FROM `f_o` WHERE fo_id=?;");
        $id=$_COOKIE['user_id_fo'];
        $pr->bind_param("s",$id);
        if($pr->execute()){
            $pr->store_result();
            $pr->bind_result($fo_code);
            //listamos todos los resultados
	        while($pr->fetch()){
              return $fo_code;
            }
            $pr->close();
        }else{
            exit('Error al realizar la consulta:'.$pr->close());
        }
    }
    public function select_datos_fo($code){
        if(isset($code)){
            $pr=$this->conn->prepare("SELECT fo_img_little, fo_img_big, fo_name, fo_description, 
            fo_tag, fo_url_w_a, fo_url_b_b_f, fo_url_m, fo_id, fo_label FROM f_o WHERE fo_code=?");
            $pr->bind_param("s",$code);
            if($pr->execute()){
                $pr->store_result();
                if($pr->num_rows==0){
                    $pr->close();
                    echo"<div style='color: white;font-family:Arial;text-align:center;width:100%'><br><br><br><br><br><br>";
                    exit('<h1>No existe ninguan fuerza operativa afianxada a la URL</h1>');
                    echo "</div>";
                }
                $pr->bind_result($fo_img_little,$fo_img_big,$fo_name,$fo_description,$fo_tag, $fo_url_w_a,$fo_url_b_b_f,$fo_url_m,$fo_id,$fo_label);
                //listamos todos los resultados
                while($pr->fetch()){
                    $Row=['name'=>$fo_name,'description'=>$fo_description,'fo_tag'=>$fo_tag,'fo_url_w_a'=>$fo_url_w_a,'fo_url_b_b_f'=>$fo_url_b_b_f,'fo_url_m'=>$fo_url_m,'fo_id'=>$fo_id,'fo_label'=>$fo_label];
                //Escribimos las imagenes de la BD
                //creamos un directorio
                $ruta=URL_PROJECT."/public/tmp/f_o/directori_".$fo_id;
                if(!file_exists($ruta)){
                    mkdir($ruta,0700);
                }
                //convert
                $img_big=stripslashes(base64_decode($fo_img_big));
                $img_little=stripslashes(base64_decode($fo_img_little));
                //imagen big
                $ruta=URL_PROJECT."/public/tmp/f_o/directori_".$Row['fo_id']."/fo_img_big.jpg";
                $this->base64_to_jpeg($img_big,$ruta);
                //imagen little
                $ruta=URL_PROJECT."/public/tmp/f_o/directori_".$Row['fo_id']."/fo_img_little.jpg";
                $this->base64_to_jpeg($img_little,$ruta);
                return $Row;
                }
                $pr->close();
            }else{
                exit('Error al realizar la consulta:'.$pr->close());
            }
        }
    }
    function select_datos_fo_photo($code){
        $pr=$this->conn->prepare("SELECT fo_id,fo_photo_1,fo_photo_2,fo_photo_3 FROM f_o WHERE fo_code=?");
        $pr->bind_param("s",$code);
        if($pr->execute()){
            $pr->store_result();
            $pr->bind_result($id_fo,$fo_photo_1,$fo_photo_2,$fo_photo_3);
            //listamos todos los resultados
            while($pr->fetch()){
            //convert
            $photo_01=stripslashes(base64_decode($fo_photo_1));
            $photo_02=stripslashes(base64_decode($fo_photo_2));
            $photo_03=stripslashes(base64_decode($fo_photo_3));

            $ruta1=URL_PROJECT."/public/tmp/f_o/directori_".$id_fo."/photo_01.jpg";
            $this->base64_to_jpeg($photo_01,$ruta1);
            $ruta2=URL_PROJECT."/public/tmp/f_o/directori_".$id_fo."/photo_02.jpg";
            $this->base64_to_jpeg($photo_02,$ruta2);
            $ruta3=URL_PROJECT."/public/tmp/f_o/directori_".$id_fo."/photo_03.jpg";
            $this->base64_to_jpeg($photo_03,$ruta3);
            return true;
            }
            $pr->close();
        }else{
            exit('Error al realizar la consulta:'.$pr->close());
        }
    }
    function base64_to_jpeg($base64_string,$output_file) {
        $ifp=fopen($output_file,"wb");
        fwrite($ifp,$base64_string);
        fclose($ifp);
    }
    function select_user_leader($id_fo){   
        $pr=$this->conn->prepare("SELECT us_id,us_user,us_img_little,us_premium FROM the_user WHERE fo_id = ? and us_rank = ?");
        $rank='Lider';
        $pr->bind_param("is",$id_fo,$rank);
        if($pr->execute()){
            $pr->store_result();
            $pr->bind_result($us_id,$leader_user,$img_user,$us_premium);
            if($pr->num_rows==0){		
                console('nonee');
            }
            //listamos todos los resultados
            while($pr->fetch()){
                //convert
                $img=stripslashes(base64_decode($img_user));
                //creamos la imagen
                $ruta=URL_PROJECT."/public/tmp/f_o/directori_".$id_fo."/leader_img.jpg";
                $this->base64_to_jpeg($img,$ruta);
                $Row=['us_id'=>$us_id,'user_leader'=>$leader_user,'us_premium'=>$us_premium];
                return $Row;
            }
            $pr->close();
        }else{
            exit('Error al realizar la consulta:'.$pr->close());
        }
    }
    function crud_obtain_id_fo(){
        $pr=$this->conn->prepare("SELECT fo_id FROM `f_o` WHERE fo_code=?;");
        $code=(isset($_GET['C']))?$_GET['C']:$_SESSION['code_f_o'];
        $pr->bind_param("s",$code);
        if($pr->execute()){
            $pr->store_result();
            $pr->bind_result($fo_id);
            //listamos todos los resultados
	        while($pr->fetch()){
              return $fo_id;
            }
            $pr->close();
        }else{
            exit('Error al realizar la consulta:'.$pr->close());
        }
    }
    function crud_obtain_color($fo_id){
            $pr=$this->conn->prepare("SELECT `spf_color_1`, `spf_color_2`, `spf_color_3`, `spf_color_4`, `spf_color_5`, `spf_color_6` FROM `styles_premium_fo` WHERE fo_id = ".$fo_id.";");
            if($pr->execute()){
                $pr->store_result();
                if($pr->num_rows!=0){
                    $pr->bind_result($c1,$c2,$c3,$c4,$c5,$c6);
                    while($pr->fetch()){$color_data=['c1'=>$c1,'c2'=>$c2,'c3'=>$c3,'c4'=>$c4,'c5'=>$c5,'c6'=>$c6];return $color_data;}
                }else{
                    $pr->close(); return false;
                }
                
            }else{
                exit('Error al realizar la consulta:'.$pr->close());
                
            }
}
function crud_obtain_code_my_fo(){
    $pr=$this->conn->prepare("SELECT fo_code FROM `f_o` WHERE fo_id=?;");
    $id_fo=(isset($_COOKIE['user_id_fo']))?$_COOKIE['user_id_fo']:0;
    $id_fo_=($id_fo=='none')?0:$_COOKIE['user_id_fo'];
    $pr->bind_param("i",$id_fo_);
    if($pr->execute()){
        $pr->store_result();
        $pr->bind_result($fo_code);
        //listamos todos los resultados
        while($pr->fetch()){
        return $fo_code;
        }
        $pr->close();
    }else{
        exit('Error al realizar la consulta:'.$pr->close());
    }
}
function crud_valid_premium_fo(){
    $pr=$this->conn->prepare("SELECT `fp_fo_code` FROM `fo_premium` WHERE fp_fo_code=?;");
    $code_fo=(isset($_GET['C']))?$_GET['C']:'';
    $pr->bind_param("s",$code_fo);
    if($pr->execute()){
        $pr->store_result();
        $pr->bind_result($fo_code);
        //listamos todos los resultados
        while($pr->fetch()){
        return $fo_code;
        }
        $pr->close();
    }else{
        exit('Error al realizar la consulta:'.$pr->close());
    }
}
}