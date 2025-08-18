<?php

require_once "../controllers/curl.controller.php";

class FormsAjax {

    /*=============================================
    Validar datos repetidos
    =============================================*/
    
    public $table;
    public $equalTo;
    public $linkTo;

    public function validateDataRepeat(){

        $url = "http://api.builder.com/".$this->table."?equalTo=".$this->equalTo."&linkTo=".$this->linkTo;
        $method = "GET";
        $fields = array();

        $response = CurlController::request($url, $method, $fields);

        if($response->status == 200 && !empty($response->results) && is_array($response->results)){

            echo "EXISTS"; // Existe, es repetido

        }else{

            echo "OK"; // No existe, está bien

        }

    }

}

/*=============================================
Validar datos repetidos
=============================================*/

if(isset($_POST["table"]) && isset($_POST["equalTo"]) && isset($_POST["linkTo"])){

    $validate = new FormsAjax();
    $validate->table = $_POST["table"];
    $validate->equalTo = $_POST["equalTo"];
    $validate->linkTo = $_POST["linkTo"];
    $validate->validateDataRepeat();

}

?>
