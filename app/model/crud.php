<?php
require_once ($_SERVER['DOCUMENT_ROOT']. '/app/config/config.php');
require_once (URL_PROJECT. '/app/libs/console.php');
require_once (URL_PROJECT. '/app/model/connection.php');

/* -- */

class CRUD extends Connection{

    function __construct(){
        $this->connect();
        
        /* $this->select_code(); */
    }

    public function execute($query){

        try{
        $rpt = mysqli_query($this->conn, $query);
        if ($rpt) {
            console("New record created successfully");
            return $rpt;
        } else {
            console("ERROR in create new record");
            return 'error';
        }
        }catch (PDOException $e) {

        $this->error = $e->getMessage();
        echo $this->error;
        }
        
    }

    function obtain_id(){
        $id = mysqli_insert_id($this->conn);
        console("Inser ID: ".$id);
        $_SESSION['sess_id'] = $id;
    }

    public function insert_fo(){
        $image = (isset($_FILES['image'])) ? $_FILES['image']['tmp_name'] : 'null';
        $image_type = (isset($_FILES['image'])) ? $_FILES['image']['type'] : 'null';
        $img = ($image != '') ? $_FILES['image']['tmp_name'] : 'null';
        $name = (isset($_POST['namee']) && $_POST['namee'] != '') ? $_POST['namee'] : 'null';
        $description = (isset($_POST['description']) && $_POST['description'] != '') ? $_POST['description'] : 'null';
        $tag = (isset($_POST['tag']) && $_POST['tag'] != '') ? $_POST['tag'] : 'null';
        $url_w_a = (isset($_POST['UrlWebAlternative']) && $_POST['UrlWebAlternative'] != '') ? $_POST['UrlWebAlternative'] : 'null';
        $url_b_b_f = (isset($_POST['UrlFo']) && $_POST['UrlFo'] != '') ? $_POST['UrlFo'] : 'null';
        $url_m = (isset($_POST['UrlMusic']) && $_POST['UrlMusic'] != '') ? $_POST['UrlMusic'] : 'null';

        if($image != ''){
            require_once URL_PROJECT.'/app/libs/resize_img.php';
            $rs = new Resize();
            $rs -> resized_img_fo_big($img, $name, $image_type);
            $rs -> resized_img_fo_little($img, $name, $image_type);

            //obtengo las imagenes ya redimensionadas
            $img_big = URL_PROJECT."/app/tmp/size-$name-big.jpg";
            $image_big_bits = base64_encode(addslashes(fread(fopen($img_big, "r"), filesize($img_big))));
            $img_little = URL_PROJECT."/app/tmp/size-$name-little.jpg";
            $image_little_bits = base64_encode(addslashes(fread(fopen($img_little, "r"), filesize($img_little))));
        }else{
            //obtengo imagenes default
            $img_big = URL_PROJECT."/app/tmp/default/default_big.jpg";
            $image_big_bits = base64_encode(addslashes(fread(fopen($img_big, "r"), filesize($img_big))));
            $img_little = URL_PROJECT."/app/tmp/default/default_little.jpg";
            $image_little_bits = base64_encode(addslashes(fread(fopen($img_little, "r"), filesize($img_little))));
        }
        //$ex = obtain_id();
        //insert
        $sql = "INSERT INTO `f_o`(`fo_img_little`, `fo_img_big`, `fo_name`, `fo_description`, `fo_tag`, `fo_url_w_a`, `fo_url_b_b_f`, `fo_url_m`, `fo_photo_1`, `fo_photo_2`, `fo_photo_3`)
        VALUES ('".$image_little_bits."', '".$image_big_bits."','".$name."','".$description."','".$tag."','".$url_w_a."','".$url_b_b_f."','".$url_m."',null,null,null);";
        $this->execute($sql);
        $this->obtain_id();

    }

    function insert_rules(){

        $num_rules = $_POST['num_rule'];
        $num_prohibitions = $_POST['num_prohibition'];

        for($iv = 1; $iv <= $num_rules; $iv++){
            console($_POST['rule_'.$iv]);
            /* $sql = "insert rules_fo (fo_id, rf_rule) VALUES (".$_SESSION['sess_id'].", '".$_POST['rule_'.$iv]."');"; */
            $sql = "INSERT INTO `rules_fo`(`fo_id`, `rf_rule`) VALUES (".$_SESSION['sess_id'].", '".$_POST['rule_'.$iv]."');";
            $this->execute($sql);
        }
        for($iv = 1; $iv <= $num_prohibitions; $iv++){
            console($_POST['prohibition_'.$iv]);
            /* $sql= "insert prohibition_fo (fo_id, pf_prohibition) VALUES (".$_SESSION['sess_id'].", '".$_POST['prohibition_'.$iv]."');"; */
            $sql = "INSERT INTO `prohibition_fo`(`fo_id`, `pf_prohibition`) VALUES (".$_SESSION['sess_id'].", '".$_POST['prohibition_'.$iv]."');";
            $this->execute($sql);
        }
    }

    function select_code(){

        /* $sql_select_code = "select fo_code from f_o where fo_id = ".$_SESSION['sess_id'].";"; */
        $sql_select_code = "SELECT fo_code FROM `f_o` WHERE fo_id = ".$_SESSION['sess_id'].";";
        $rpt = mysqli_query($this->conn, $sql_select_code);
        if(!$rpt){
            console("error en obtencioon de codigo");
        }else{
            while($row = mysqli_fetch_assoc($rpt)){
                $_SESSION['sess_code'] = $row['fo_code']; 
            }
        }
    }

    public function select_datos_fo(){
        if(isset($_GET['C'])){
            $code = $_GET['C'];
            $sql5 = "SELECT * FROM f_o WHERE fo_code = '". $code ."';";
            $rpt = $this->execute($sql5);

            return $Row = sqlsrv_fetch_array($rpt);
            
        }
    }

}


/* $crud = new CRUD(); */
