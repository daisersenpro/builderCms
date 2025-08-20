<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-0 border-bottom">

	<div>

		<div class="btn-group me-2">
			<button type="button" class="btn btn-sm btn-outline-secondary mb-2 px-3 changeCode" mode="HTML">
				<i class="fab fa-html5"></i> HTML
			</button>
			<button type="button" class="btn btn-sm btn-outline-secondary mb-2 px-3 changeCode" mode="CSS">
				<i class="fab fa-css3-alt"></i> CSS
			</button>
			<button type="button" class="btn btn-sm btn-outline-secondary mb-2 px-3 changeCode" mode="JS">
				<i class="fab fa-js"></i> JAVASCRIPT
			</button>

		</div>

		<?php if (isset($_SESSION["admin"])): ?>	
		
			<button type="button" class="btn btn-sm btn-outline-secondary mb-2 border-0 saveLanding">
				<i class="fas fa-save"></i> Autoguardado <i class="fas fa-check"></i>
			</button>

		<?php endif ?>

	</div>
		
	<div class="btn-toolbar mb-2 mb-md-0">

		<a href="/" class="btn btn-sm btn-outline-secondary mb-2 me-2">
			<span data-feather="arrow-left"></span>
			Regresar
		</a>

		<div class="btn-group me-2">

			<?php if (isset($_SESSION["admin"])): ?>	

				<button type="button" class="btn btn-sm btn-outline-secondary mb-2" data-bs-toggle="modal" data-bs-target="#myLanding">
					<i class="fas fa-tools"></i>
					Configuración
				</button>

			<?php endif ?>

			<a href="/<?php echo $code->url_landing ?>" target="_blank" class="btn btn-sm btn-outline-secondary mb-2">
				<span data-feather="maximize"></span>
				Previsualizar
			</a>
		</div>

		<?php if (isset($_SESSION["admin"])): ?>

			<button type="button" class="btn btn-sm btn-outline-secondary mb-2 deleteLanding" idLanding="<?php echo $code->id_landing ?>">
				<i class="fas fa-trash-alt"></i>
				Eliminar
			</button>

		<?php endif ?>

	</div>

</div>
