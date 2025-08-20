<?php 

/*=============================================
Iniciar variables de sesión
=============================================*/

ob_start();
session_start();

/*=============================================
Importar controladores
=============================================*/

require_once "controllers/curl.controller.php";

/*=============================================
Capturar las rutas de la URL
=============================================*/ 

$routesArray = explode("/",$_SERVER["REQUEST_URI"]);
array_shift($routesArray);

foreach ($routesArray as $key => $value) {	
	$routesArray[$key] = explode("?",$value)[0];
}


// Routing principal
if (isset($routesArray[0])) {
	// Si la ruta es /code/{url_landing}
	if ($routesArray[0] == "code" && isset($routesArray[1])) {
		$select = "*";
		$url = "http://api.builder.com/relations?rel=codes,landings&type=code,landing&linkTo=url_landing&equalTo=" . $routesArray[1] . "&select=" . $select;
		$method = "GET";
		$fields = array();
		$code = CurlController::request($url, $method, $fields);
		if ($code->status == 200) {
			$code = $code->results[0];
		} else {
			echo '<script>window.location = "/";</script>';
			return;
		}
	} else {
		// Si la ruta es /{url_landing} (página pública)
		$select = "*";
		$url = "http://api.builder.com/relations?rel=codes,landings&type=code,landing&linkTo=url_landing&equalTo=" . $routesArray[0] . "&select=" . $select;
		$method = "GET";
		$fields = array();
		$page = CurlController::request($url, $method, $fields);
		if ($page->status == 200) {
			$page = $page->results[0];
		} else {
			$page = null;
		}
	}
}

$path = $_SERVER["REQUEST_SCHEME"]."://".$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<?php if (!empty($page)): ?>

		<title><?php echo $page->title_landing ?></title>
		<link rel="icon" href="<?php echo $page->icon_landing ?>">
		<meta name="description" content="<?php echo $page->description_landing ?>">

		<!--=====================================
		Marcado OPEN GRAPH FACEBOOK
		======================================-->

		<meta property="og:site_name" content="<?php echo $page->title_landing ?>">
		<meta property="og:title" content="<?php echo $page->title_landing ?>">
		<meta property="og:description" content="<?php echo $page->description_landing ?>">
		<meta property="og:type" content="Type">
		<meta property="og:image" content="<?php echo $page->cover_landing ?>">
		<meta property="og:url" content="<?php echo $path ?>">

		<!--=====================================
		Marcado TWITTER
		======================================-->

		<meta name="twitter:card" content="summary_large_image">
		<meta name="twitter:title" content="<?php echo $page->title_landing ?>">
		<meta name="twitter:description" content="<?php echo $page->description_landing ?>">
		<meta name="twitter:image" content="<?php echo $page->cover_landing ?>">
		<meta name="twitter:image:width" content="960">
		<meta name="twitter:image:height" content="540">
		<meta name="twitter:image:alt" content="<?php echo $page->description_landing ?>">

		<!--=====================================
		Marcado GOOGLE
		======================================-->

		<meta itemprop="name" content="<?php echo $page->title_landing ?>">
		<meta itemprop="url" content="<?php echo $path ?>">
		<meta itemprop="description" content="<?php echo $page->description_landing ?>">
		<meta itemprop="image" content="<?php echo $page->cover_landing ?>">

	<?php else: ?>

		<title>Landing Page Builder | Juan Fernando Urrego</title>

	<?php endif ?>
	

	<link href="/views/assets/plugins/bootstrap5/bootstrap.min.css" rel="stylesheet" >
	<!-- https://fontawesome.com/v5/search -->
	<link rel="stylesheet" href="/views/assets/plugins/fontawesome-free/css/all.min.css"> 

	<?php if (empty($page)): ?>
		<link rel="stylesheet" href="/views/assets/plugins/toastr/toastr.min.css">
		<link rel="stylesheet" href="/views/assets/plugins/material-preloader/material-preloader.css">
		<link rel="stylesheet" href="/views/assets/css/dashboard/dashboard.css">
		<link rel="stylesheet" href="/views/assets/plugins/jquery-ui/jquery-ui.css">
		<link rel="stylesheet" href="/views/assets/plugins/codemirror/codemirror.min.css"/>
		<link rel="stylesheet" href="/views/assets/plugins/codemirror/custom-codemirror.css"/>
	<?php endif ?>

	<link rel="stylesheet" href="/views/assets/css/template/template.css">

	<!-- jQuery library -->
	<script src="/views/assets/plugins/jquery/jquery.min.js"></script>

	<!-- https://www.w3schools.com/bootstrap5 -->
	<script src="/views/assets/plugins/bootstrap5/bootstrap.bundle.min.js"></script>
	
	<!-- https://feathericons.com/ -->
	<script src="/views/assets/plugins/feathericons/feather.min.js"></script>

	<?php if (empty($page)): ?>
		<script src="/views/assets/js/alerts/alerts.js"></script>

		<!-- https://jqueryui.com/ -->
		<script src="/views/assets/plugins/jquery-ui/jquery-ui.js"></script>

		<!-- https://sweetalert2.github.io/ -->
		<script src="/views/assets/plugins/sweetalert/sweetalert.min.js"></script>

		<!-- https://codeseven.github.io/toastr/demo.html -->
		<script src="/views/assets/plugins/toastr/toastr.min.js"></script>

		<!-- https://materializecss.com/preloader.html -->
		<script src="/views/assets/plugins/material-preloader/material-preloader.js"></script>

		<!-- https://codemirror.net/ -->
		<script src="/views/assets/plugins/codemirror/codemirror.min.js"></script>
		<script src="/views/assets/plugins/codemirror/javascript.min.js"></script>
		<script src="/views/assets/plugins/codemirror/css.min.js"></script>
		<script src="/views/assets/plugins/codemirror/xml.min.js"></script>
		<script src="/views/assets/plugins/codemirror/active-line.js"></script>
		<script src="/views/assets/plugins/codemirror/matchbrackets.min.js"></script>
		<script src="/views/assets/plugins/codemirror/autorefresh.js"></script>

		<!-- https://html2canvas.hertzen.com/ -->
		<script src="/views/assets/plugins/html2canvas/html2canvas.min.js"></script>

	<?php else: ?>

		<?php foreach (json_decode($page->plugins_landing) as $key => $value): ?>

			<?php echo urldecode($value) ?>
			
		<?php endforeach ?>

	<?php endif ?>

</head>
<body <?php if (isset($_GET["scroll"]) && $_GET["scroll"] == "custom"): ?> class="custom-scroll" <?php endif ?> >

	<?php if (!empty($page)): ?>

		<style> <?php echo $page->css_code ?> </style>
		<div> <?php echo $page->html_code ?> </div>
		<script><?php echo $page->javascript_code ?></script>

	<?php else: ?>

		<?php include "modules/header.php"; ?>
		<?php include "modules/sidebar-left.php"; ?>

		<div class="container-fluid">
			
			<div class="row">
				
				<main class="col-12 px-md-4">

					<?php 

					if (!empty($routesArray[0])){
						if($routesArray[0] == "login" || $routesArray[0] == "logout"){
							include "pages/".$routesArray[0]."/".$routesArray[0].".php";
						} elseif($routesArray[0] == "code" && isset($code)) {
							include "pages/code/code.php";
						} else {
							include "pages/home/home.php";
						}
					}else{
						include "pages/home/home.php";
					}
					?>

				</main>

			</div>

		</div>

		<?php include "modules/modal-landing.php" ?>

		<script src="/views/assets/js/dashboard/dashboard.js"></script>
		<script src="/views/assets/js/forms/forms.js"></script>

	<?php endif ?>

</body>
</html>