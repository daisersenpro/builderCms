<?php 

require_once "../controllers/curl.controller.php";

class CodeController{

	public $idCode;
    public $codeEditor;
    public $column;
    public $img;
    public $token;

    public function ajaxCode(){

     	/*=============================================
		Directorio para guardar la imagen
		=============================================*/
		$directory = "../views/assets/img/landings/".$this->idCode;

		/*=============================================
		Preguntamos primero si no existe el directorio, para crearlo
		=============================================*/

		if(!file_exists($directory)){

			mkdir($directory, 0755);
		
		}

		$nameImg = "image.jpg";
		$folderPath = $directory."/".$nameImg;

		/*=============================================
		Convertimos el archivo base64 en imagen JPG
		=============================================*/

		if(file_put_contents($folderPath, file_get_contents($this->img))){

			$url = "http://api.builder.com/landings?id=".$this->idCode."&nameId=id_landing&token=".$this->token."&table=admins&suffix=admin";
			$method = "PUT";
			$fields = "img_landing=".$nameImg;

			$landing = CurlController::request($url, $method, $fields);

			if($landing->status == 200){

				$url = "http://api.builder.com/codes?id=".$this->idCode."&nameId=id_landing_code&token=".$this->token."&table=admins&suffix=admin";
		     	$method = "PUT";
		     	$fields = $this->column."=".urlencode($this->codeEditor);

		     	$data =  CurlController::request($url, $method, $fields);
		     	echo $data->status;

			}

		}  	

    }

    public $idDelete;

    public function deleteLanding(){

    	/*=============================================
        Eliminar códigos de la Landing de BD
        =============================================*/

    	$url = "http://api.builder.com/codes?id=".$this->idDelete."&nameId=id_landing_code&token=".$this->token."&table=admins&suffix=admin";
    	$method = "DELETE";
    	$fields =  array();

    	$deleteCode = CurlController::request($url, $method, $fields);

    	if($deleteCode->status == 200){

    		/*=============================================
            Borrar Imagen de la landing
            =============================================*/

            if(file_exists("../views/assets/img/landings/".$this->idDelete."/image.jpg")){
                unlink("../views/assets/img/landings/".$this->idDelete."/image.jpg");
            }

            /*=============================================
            Borrar Directorio de la landing
            =============================================*/

            if(is_dir("../views/assets/img/landings/".$this->idDelete)){
                rmdir("../views/assets/img/landings/".$this->idDelete);
            }

            /*=============================================
            Eliminar la landing de BD
            =============================================*/

            $url = "http://api.builder.com/landings?id=".$this->idDelete."&nameId=id_landing&token=".$this->token."&table=admins&suffix=admin";
	    	$method = "DELETE";
	    	$fields =  array();

	    	$deleteLanding = CurlController::request($url, $method, $fields);

	    	if($deleteLanding->status == 200){

	    		echo $deleteLanding->status;

	    	}

    	}

    }

}

if(isset($_POST["column"])){

	$ajax = new CodeController();
	$ajax -> idCode = $_POST["idCode"];
	$ajax -> codeEditor = $_POST["codeEditor"];
	$ajax -> column = $_POST["column"];
	$ajax -> img = $_POST["img"];
	$ajax -> token = $_POST["token"];
	$ajax -> ajaxCode();

}

if(isset($_POST["idDelete"])){

	$ajax = new CodeController();
	$ajax -> idDelete = $_POST["idDelete"];
	$ajax -> token = $_POST["token"];
	$ajax -> deleteLanding();

}

?>
