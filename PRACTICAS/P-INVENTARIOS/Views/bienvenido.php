
	<div class="container-fluid">
		<div class="jumbotron">
			<h1>Bienvenido</h1>
			<h2>Claves de Acceso:</h2>
			<p>Usuario: root</p>
			<p>Contraseña: root</p>

            <?php if ( isset($_SESSION["usuario"]) ) { ?>

			<a class="btn btn-primary" href="?controller=Usuario&action=logout">Cerrar sesión</a>
            <?php } else { ?>
            
                <a class="btn btn-primary" href="?controller=Usuario&action=login">Iniciar sesión</a>
            <?php } ?>
		</div>
	</div>