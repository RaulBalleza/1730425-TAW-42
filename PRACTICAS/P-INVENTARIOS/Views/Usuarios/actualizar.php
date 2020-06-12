<div class="container-fluid mt-4">
    	<div class="row">
    		<div class="container col-sm-12 col-md-10 col-lg-10 col-xl-7">

    			<div class="panel panel-default">
    				<div class="panel-body">

    					<form action="?controller=Usuario&action=guardar" method="POST" data-parsley-validate>
    						<!-- Agregar id para notificación overhang -->

    						<div class="row">
    							<div class="col-12 col-sm-6 col-md-7">
    								<legend>Registrar</legend>
    							</div>
    							<div class="col-12 col-sm-6 col-md-5">
    								<div class="text-right">
    									<a href="?controller=Usuario&action=mostrar"><label>Regresar a lista de productos</label></a>
    								</div>
    							</div>
    						</div>

    						<div class="form-row">

    							
    							<div class="form-group col-sm-4">
    								<label for="nombre">Usuario</label><label class="text-danger">*</label>
    								<input value="<?php echo $usuario->getUsuario() ?>" type="text" name="txtUsuario" class="form-control" id="nombre" placeholder="Nombre de usuario" data-parsley-pattern="^[A-zÀ-ú ]+$" data-parsley-length="[2, 30]" data-parsley-trigger="keyup" required>
    							</div>

    							<div class="form-group col-sm-4">
    								<label for="descripcion">E-mail</label><label class="text-danger">*</label>
    								<input value="<?php echo $usuario->getEmail() ?>"  type="text" name="txtEmail" class="form-control" id="descripcion" placeholder="example@gmail.com" data-parsley-pattern="^[A-zÀ-ú ]+$" data-parsley-length="[2, 120]" data-parsley-trigger="keyup" required>
								</div>
								
								<div class="form-group col-sm-4">
    								<label for="nombre">Contraseña</label><label class="text-danger">*</label>
    								<input value="<?php echo $usuario->getPassword() ?>"  type="text" name="txtContrasena" class="form-control" id="nombre" placeholder="Contraseña" data-parsley-pattern="^[A-zÀ-ú ]+$" data-parsley-length="[2, 30]" data-parsley-trigger="keyup" required>
    							</div>
    						</div>

    						<div class="col-md-12 text-right">
    							<button type="submit" class="btn btn-primary">Registrar</button>
    						</div>
    					</form>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>