<?php 

/*=============================================
Traer Categorias
=============================================*/

$url = "categories?select=id_category,name_category";
$method = "GET";
$fields = array();

$categories = CurlController::request($url,$method,$fields);

if($categories->status == 200){

	$categories = $categories->results;

}else{

	$categories = array();
}

/*=============================================
Traer Módulos
=============================================*/
$select = "*";
$url = "relations?rel=modules,categories&type=module,category&select=".$select."&orderBy=order_module&orderMode=ASC";
$modules = CurlController::request($url,$method,$fields);


if($modules->status == 200){

	$modules = $modules->results;

}else{

	$modules = array();
}




 ?>

<div class="bg-dark p-1 sticky-top" style="top:112px">

	<div id="accordion">

		<?php foreach ($categories as $key => $value): ?>

		<div class="card mb-1 border-0">
			<div class="card-header text-white bg-dark text-center text-uppercase border-0 small py-0 border-bottom">
				<a class="btn" data-bs-toggle="collapse" href="#collapse<?php echo $key ?>">
					<?php echo $value->name_category ?>
				</a>
			</div>
			<div id="collapse<?php echo $key ?>" class="collapse <?php if ($key == 0): ?> show <?php endif ?>" data-bs-parent="#accordion">
				<div class="card-body p-2">
					
					<ul class="list-group">

						<?php foreach ($modules as $index => $item): ?>

							<?php if ($item->id_category == $value->id_category): ?>
								
		
								<li 
								class="list-group-item align-items-center px-2 moveModule" 
								idModule="<?php echo $item->id_module ?>"
								idCategory="<?php echo $item->id_category ?>"
								nameModule="<?php echo $item->name_module ?>"
								style="cursor:move">

									<!--===================================
									Categoría 2: Columnas
									====================================-->

									<?php if ($item->id_category == 2): ?>

										<?php 

										$separateNumbers = explode(" ", $item->name_module);

										?>

										<?php foreach ($separateNumbers as $num => $elem): ?>

											<input 
											type="text"
											class="text-center mb-1 changeNumber group<?php echo $index ?>"
											group="<?php echo $index ?>"
											value="<?php echo $elem ?>"
											style="width:25px;border-radius:5px;border:1px solid #aaa"
											>
											
										<?php endforeach ?>

										<span class="float-end move<?php echo $index ?>" data-feather="move" style="cursor:move"></span>

									<?php endif ?>

									<!--===================================
									Categoría 3: Flex
									====================================-->

									<?php if ($item->id_category == 3): ?>

										<?php 
											$typeFlex = ["Content","Align"];
										?>

										<?php foreach ($typeFlex as $num => $elem): ?>

											<select class="mb-1 changeFlex"
											style="width:85px;border-radius:5px;border:1px solid #aaa">
												
												<?php if ($elem == "Content"): ?>

													<option value=""><?php echo $elem ?></option>
													<option value="justify-content-start">Start</option>
													<option value="justify-content-end">End</option>
													<option value="justify-content-center">Center</option>
													<option value="justify-content-between">Between</option>
													<option value="justify-content-around">Around</option>
													
												<?php endif ?>

												<?php if ($elem == "Align"): ?>

													<option value=""><?php echo $elem ?></option>
													<option value="align-content-start">Start</option>
													<option value="align-content-end">End</option>
													<option value="align-content-center">Center</option>
													<option value="align-content-around">Around</option>
													<option value="align-content-stretch">Stretch</option>
													
												<?php endif ?>

											</select>
											
										<?php endforeach ?>

										<span class="float-end" data-feather="move" style="cursor:move"></span>
									
									<?php endif ?>

									<!--===================================
									Categoría 4: Elementos
									====================================-->

									<?php if ($item->id_category == 4): ?>

										<?php echo $item->name_module ?>

										<span class="float-end" data-feather="move" style="cursor:move"></span>

										<select 
										class="mb-1 float-end changeElement"
										style="width:85px;border-radius:5px;border:1px solid #aaa; margin-right:5px"
										>
										
											<option value="text-start">Start</option>
											<option value="text-center">Center</option>	
											<option value="text-end">End</option>	

										</select>

									<?php endif ?>

									<!--===================================
									Categoría 5: Navegación
									====================================-->

									<?php if ($item->id_category == 5): ?>

										<?php echo $item->name_module ?>

										<span class="float-end" data-feather="move" style="cursor:move"></span>

										<select 
										class="mb-1 float-end changeNav"
										style="width:85px;border-radius:5px;border:1px solid #aaa; margin-right:5px"
										>

											<?php if ($item->name_module == "H Nav"): ?>

												<option value="me-auto">Start</option>
												<option value="mx-auto">Center</option>	
												<option value="ms-auto">End</option>	
												
											<?php endif ?>

											<?php if ($item->name_module == "V Nav"): ?>

												<option value="text-start">Start</option>
												<option value="text-center">Center</option>	
												<option value="text-end">End</option>	
												
											<?php endif ?>		

										</select>

									<?php endif ?>

									<!--===================================
									Resto de categorías
									====================================-->

									<?php if ($item->id_category != 2 && 
											  $item->id_category != 3 &&
											  $item->id_category != 4 &&
											  $item->id_category != 5): ?>

										<?php echo $item->name_module ?>

										<span class="float-end" data-feather="move" style="cursor:move"></span>
										
									<?php endif ?>		
									
								</li>

							<?php endif ?>

						<?php endforeach ?>		

					</ul>

				</div>
			</div>
		</div>
			
		<?php endforeach ?>

		
	</div>
</div>