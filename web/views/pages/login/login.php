<link rel="stylesheet" href="/views/assets/css/login/login.css">

<section id="form-login">

	<main class="form-signin">
	  
	  <form method="post">
	     
	     <h1 class="h3 mb-3 fw-normal text-center">
	     	<span class="h1" data-feather="code"></span> Landing Page Builder
	     </h1>

	    <div class="form-floating">
	      <input type="email" class="form-control" id="floatingInput" name="email_admin" placeholder="name@example.com">
	      <label for="floatingInput">Email address</label>
	    </div>
	    <div class="form-floating">
	      <input type="password" class="form-control" id="floatingPassword" name="password_admin" placeholder="Password">
	      <label for="floatingPassword">Password</label>
	    </div>

	    <button type="submit" class="w-100 btn btn-lg btn-dark mt-3" type="submit">Ingresar</button>

	    <?php 

	    require_once "controllers/admins.controller.php";
	    $login = new AdminsController();
	    $login -> login();

	    ?>

	    
	  </form>

	</main>

</section>