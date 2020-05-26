
	<div class="container-fluid">
		<div class="jumbotron">
			<h1>Bienvenido</h1>
			<p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Earum nobis eaque vero aperiam sed libero consequuntur, minus tenetur eveniet, possimus, error facilis laudantium quis delectus corrupti mollitia exercitationem autem assumenda.</p>

            <?php if ( isset($_SESSION["usuario"]) ) { ?>

			<a class="btn btn-primary" href="?controller=Usuario&action=logout">Cerrar sesión</a>
            <?php } else { ?>
            
                <a class="btn btn-primary" href="?controller=Usuario&action=login">Iniciar sesión</a>
            <?php } ?>
		</div>
	</div>