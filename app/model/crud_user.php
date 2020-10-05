<?php
require_once ($_SERVER['DOCUMENT_ROOT']. '/app/config/config.php');
require_once (URL_PROJECT. '/app/libs/console.php');
require_once (URL_PROJECT. '/app/model/connection.php');

/* -- */

class CRUD extends Connection{

    private $gmail;
    private $user;
    private $password;

    function __construct(){
        $this->connect();
        
        /* $this->select_code(); */
    }

    function obtain_id(){
        $id = mysqli_insert_id($this->conn);
        console("Inser ID: ".$id);
        $_SESSION['us_id'] = $id;

        //crear un directorio
        mkdir(URL_PROJECT. "/public/tmp/users/directori_".$id , 0700);
    }

    function register_user(){
        if(isset($_POST['gmail'])) $this->gmail =  $_POST['gmail'];
        if(isset($_POST['user'])) $this->user = $_POST['user'];
        if(isset($_POST['password'])) $this->password = $_POST['password'];

        //obtener la imagen
        $img_big = URL_PROJECT."/public/tmp/default/default_user_img_big.jpg";
        $image_big_bits = base64_encode(addslashes(fread(fopen($img_big, "r"), filesize($img_big))));

        $img_little = URL_PROJECT."/public/tmp/default/default_user_img_little.jpg";
        $image_little_bits = base64_encode(addslashes(fread(fopen($img_little, "r"), filesize($img_little))));

        //insert
        $pr = $this->conn->prepare("INSERT INTO `the_user`(`us_gmail`, `us_user`, `US_password`, `us_img_big`, `us_img_little`, `us_date_register`, `us_state`, `us_rank`, `us_point`, `us_participation`, `us_position`, `fo_id`) 
        VALUES (?,?,?,'". $image_big_bits ."','". $image_little_bits ."', now(),null,null,0,0,00,null);");

        $pr->bind_param("sss", $this->gmail, $this->user, $this->password);
    
        if($pr->execute()){
            $this->obtain_id();
        }
        
    }

    function validate_gmail(){
        if(isset($_POST['gmail'])){
            $pr = $this->conn->prepare("SELECT us_gmail FROM the_user WHERE us_gmail = ?;");
            $this->gmail =  $_POST['gmail'];

            $pr->bind_param("s", $this->gmail);

            if($pr->execute()){
                //Alamacenaos los datos de la consulta
                $pr->store_result();
    
                if($pr->num_rows == 0)return 'true';
                else return 'error';
              
            }
        }
    }

    function login_user(){
        if(isset($_POST['user'])) $this->user = $_POST['user'];
        if(isset($_POST['password'])) $this->password = $_POST['password'];

        $pr = $this->conn->prepare("SELECT us_id FROM the_user WHERE us_user = ? AND US_password = ?");
        $pr->bind_param("ss", $this->user, $this->password);

        if($pr->execute()){
            $pr->store_result();
            if($pr->num_rows == 0){		
                echo "La contraseña o el usuario es incorrecto";
            }
            $pr->bind_result($us_id);

            //listamos todos los resultados
	        while($pr->fetch()){

                //crear un directorio
                mkdir(URL_PROJECT. "/public/tmp/users/directori_".$us_id , 0700);

                //creamos la cookie
                setcookie('id_user', $us_id, strtotime( '+360 days' ), '/');
                header('Location: '.'/');
            }
            $pr->close();
        }else{
            exit('Error al realizar la consulta: '.$pr->close());
        }
    }
    function select_data_user(){
        $pr = $this->conn->prepare("SELECT us_img_big FROM the_user WHERE us_id = ?");
        $pr->bind_param("i", $_COOKIE['id_user']);


        if($pr->execute()){
            $pr->store_result();
            $pr->bind_result($img_big);
            //listamos todos los resultados
	        while($pr->fetch()){
               
               $imagen = stripslashes(base64_decode($img_big));
               //echo($imagen);  
               $ruta = URL_PROJECT."/public/tmp/users/directori_".$_COOKIE['id_user']."/img_perfil.jpg";
               $this->base64_to_jpeg($imagen, $ruta);
            }
            $pr->close();
        }else{
            exit('Error al realizar la consulta: '.$pr->close());
        }
    }
    function base64_to_jpeg($base64_string, $output_file) {
        $ifp = fopen( $output_file, "wb" );
        fwrite( $ifp, $base64_string );
        fclose( $ifp ); 
    }
}
