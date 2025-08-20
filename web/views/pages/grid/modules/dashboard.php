<?php 

if(isset($_GET["name"])){


	$url = "grids?linkTo=name_grid&equalTo=".$_GET["name"];
	$method = "GET";
	$fields = array();

	$grid = CurlController::request($url,$method,$fields);

	if($grid->status == 200){

		$grid = $grid->results[0];
	
	}else{

		$grid = null;

	}
}

 ?>


<!--======================================
Visor de Plantilla
=========================================-->

<div class="container-fluid my-3 custom-scroll" id="builderContent">

	<?php if (!empty($grid)): ?>

		<?php echo $grid->code_grid ?>

	<?php else: ?>

	<div class="newContent">
		
		<h4 class="lead text-center my-3 rounded  dropContent"><span data-feather="code"></span></h4>
	
	</div>

		
	<?php endif ?>	

</div>

<!--======================================
Visor de Código
=========================================-->

<div id="visorContent" style="display:none"></div>

<div class="codeView" style="display: none; position: relative">

	<?php if (isset($_SESSION["admin"])): ?>	
	<div class="copy-code-wrap copy-bs">
		<div class="copy-code-bs text-white text-center pt-1"><i class="fas fa-clipboard"></i></div>
	</div>
	<?php endif ?>
	
	<h4 class="small text-light">Bootstrap 5</h4>
	<textarea class="codemirror-bootstrap" id="codemirror"></textarea>

</div>

