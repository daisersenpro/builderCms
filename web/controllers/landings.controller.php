<?php 

class LandingsController{

	/*=============================================
	Gestión de Landings
	=============================================*/

	public function landingsManage(){

		if(isset($_POST["title_landing"])){

			echo '<script>
				fncMatPreloader("on");
				fncSweetAlert("loading", "Gestionando registro...", "");
			</script>';

			/*=============================================
			Agrupar varios Items para BD
			=============================================*/
			
			$pluginsList = json_decode($_POST["pluginsList"]);
			$plugins_landing = array();

			foreach ($pluginsList as $key => $value) {

				if(!empty($_POST["plugins_landing".$value])){
				
					$plugins_landing[$key] = urlencode($_POST["plugins_landing".$value]);

				}
				
			}

			/*=============================================
			Solicitud a la API para guardar registros
			=============================================*/
			
			$url = "http://api.builder.com/landings?token=".$_SESSION["admin"]->token_admin."&table=admins&suffix=admin";
			$method = "POST";
			$fields = array(
			
				"title_landing" => trim($_POST["title_landing"]),
				"url_landing" => $_POST["url_landing"],
				"plugins_landing" => json_encode($plugins_landing),
				"icon_landing" => trim($_POST["icon_landing"]),
				"cover_landing" => trim($_POST["cover_landing"]),
				"description_landing" => trim($_POST["description_landing"]),
				"date_created_landing" => date("Y-m-d")
			);

			$save = CurlController::request($url,$method,$fields);

			if($save->status == 200){

				echo '<script>
				
				fncMatPreloader("off");
				fncFormatInputs();
				fncSweetAlert("success", "Registro guardado con éxito", "/");

				</script>';

			}else{

				echo '<script>

				fncMatPreloader("off");
				fncFormatInputs();
				fncSweetAlert("error", "Error al guardar el registro", "/");

				</script>';
			}

		}

	}

}