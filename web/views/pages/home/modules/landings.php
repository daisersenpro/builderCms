<?php 

  $url = "http://api.builder.com/landings?select=title_landing,url_landing,cover_landing";
  $method = "GET";
  $fields = array();

  $landings = CurlController::request($url,$method,$fields);

  if($landings->status == 200){

    $landings = $landings->results;

  }else{

    $landings = array();
  }

 ?>

<div class="container-fluid">

<div class="row row-cols-1 row-cols-sm-2 row-cols-md-4">

  <?php if(!empty($landings)): ?>

    <?php foreach ($landings as $key => $value): ?>

      <div class="col my-3">
        
        <img src="<?php echo !empty($value->cover_landing) ? $value->cover_landing : '/views/assets/img/placeholder-square.svg' ?>" class="img-fluid rounded">

        <div class="text-center mt-3">
          
          <h6 class="font-weight-light">
            <a href="/code/<?php echo $value->url_landing ?>" class="text-decoration-none">
              <?php echo $value->title_landing ?> 
              <small><span data-feather="edit"></span></small>
            </a>
          </h6>
        </div>

      </div>

    <?php endforeach ?>

  <?php else: ?>

    <div class="col-12 text-center py-5">
      <i data-feather="inbox" class="mb-3 text-muted" style="width: 48px; height: 48px;"></i>
      <h5 class="text-muted">No hay páginas creadas</h5>
      <p class="text-muted">Crea tu primera landing page</p>
      <button class="btn btn-success btn-lg" data-bs-toggle="modal" data-bs-target="#myLanding">
        <i data-feather="plus"></i> Crear Primera Landing
      </button>
    </div>

  <?php endif ?>
  
</div>

</div>