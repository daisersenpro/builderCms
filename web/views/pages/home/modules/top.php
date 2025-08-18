<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
	
	<?php if (!isset($_SESSION["admin"])): ?>

		<a href="/login" class="btn btn-sm btn-outline-secondary mb-2">Crear Página</a>

	<?php else: ?>

		<button type="button" class="btn btn-sm btn-outline-secondary mb-2" data-bs-toggle="modal" data-bs-target="#myLanding">Crear Página</button>
		
	<?php endif ?>
	
	<!-- <div class="btn-toolbar mb-2 mb-md-0">
		<div class="btn-group me-2">
			<button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
			<button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
		</div>
		<button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
			<span data-feather="calendar"></span>
			This week
		</button>
	</div> -->

</div>