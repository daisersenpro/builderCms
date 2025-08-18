<?php 

  $url = "http://api.builder.com/landings?select=title_landing,url_landing";
  $method = "GET";
  $fields = array();

  $landings = CurlController::request($url,$method,$fields);

  if($landings->status == 200){

    $landings = $landings->results;

  }else{

    $landings = array();
  }

 ?>


<!-- Offcanvas Sidebar -->
<div class="offcanvas offcanvas-start" id="sidebar-left">
  <div class="offcanvas-header">
    <h1 class="offcanvas-title">Builder CMS</h1>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" data-bs-toggle="offcanvas" data-bs-target="#sidebar-left"></button>
  </div>

  <div class="offcanvas-body">

    <!-- Botón crear nueva landing -->
    <div class="mb-3">
      <button class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#myLanding">
        <i data-feather="plus"></i> Nueva Landing
      </button>
    </div>

    <!-- Lista de landings -->
    <ul class="list-group list-group-flush">

      <?php if(!empty($landings)): ?>
        
        <?php foreach ($landings as $key => $value): ?>

          <li class="list-group-item list-group-item-action border-bottom py-3">
              
              <div class="d-flex w-100 align-items-center justify-content-between">
                
                <strong class="mb-1"><?php echo $value->title_landing ?></strong>
                 <small>
                  <a href="/code/<?php echo $value->url_landing ?>" class="text-primary">
                    <span data-feather="edit"></span>
                  </a>
                </small>

              </div>

              <div class="col-10 mb-1 small">
                
                <a href="/<?php echo $value->url_landing ?>" target="_blank" class="text-decoration-none">
                  <?php echo $value->url_landing ?>
                </a>
              
              </div>

          </li>
          
        <?php endforeach ?>

      <?php else: ?>

        <li class="list-group-item text-center text-muted py-4">
          <i data-feather="inbox"></i><br>
          No hay páginas creadas
        </li>

      <?php endif ?>
    
    </ul>

  </div>
</div>