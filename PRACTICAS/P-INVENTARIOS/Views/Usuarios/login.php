
	<div class="container">
		<div class="mt-4">
			<div class="row">
				<div class="container col-sm-6 col-md-6 col-lg-6 col-xl-6">
					<div class="panel panel-default"> 
						<div class="panel-body">

							<form action="?controller=Usuario&action=iniciar" method="POST" id="login" data-parsley-validate>
								<legend>Iniciar sesión</legend>

								<div class="form-group">
									<label for="usuario">Usuario</label>
									<input type="text" name="txtUsuario" class="form-control" id="usuario" autofocus placeholder="Ingrese su nombre de usuario" data-parsley-pattern="^[a-zA-Z0-9_. ]+$" data-parsley-length="[2, 30]" data-parsley-trigger="keyup" required>
								</div>
								<div class="form-group">
									<label for="password">Contraseña</label>
									<a href="#"><label class="float-right">Olvidé mi contraseña</label></a>
									<input type="password" name="txtPassword" class="form-control" id="password" placeholder="Ingrese su contraseña" data-parsley-length="[1, 20]" data-parsley-trigger="keyup" required>
								</div>
								<div class="text-center">
									<a href="index.php" class="btn btn-secondary">Cancelar</a>
									<button type="submit" class="btn btn-primary">Ingresar</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>