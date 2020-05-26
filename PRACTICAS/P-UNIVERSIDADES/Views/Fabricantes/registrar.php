    
	<div class="container-fluid mt-4">
		<div class="row">
			<div class="container col-sm-12 col-md-10 col-lg-10 col-xl-7">

				<div class="panel panel-default">
					<div class="panel-body">

						<form action="?controller=Fabricante&action=guardar" method="POST" data-parsley-validate> <!-- Agregar id para notificación overhang -->

							<div class="row">
								<div class="col-12 col-sm-6 col-md-7">
									<legend>Registrar</legend>
								</div>
								<div class="col-12 col-sm-6 col-md-5">
									<div class="text-right">
										<a href="?controller=Fabricante&action=mostrar"><label>Regresar a lista de fabricantes</label></a>
									</div>
								</div>
							</div>
							
							<div class="form-row">
								<div class="form-group col-sm-5">
									<label for="nombre">Nombre</label><label class="text-danger">*</label>
									<input type="text" name="txtNombre" class="form-control" id="nombre" placeholder="Nombre del fabricante" data-parsley-pattern="^[A-zÀ-ú ]+$" data-parsley-length="[2, 30]" data-parsley-trigger="keyup" required>
								</div>

								<div class="form-group col-sm-7">
									<label for="direccion">Direccion</label><label class="text-danger">*</label>
									<input type="text" name="txtDireccion" class="form-control" id="direccion" placeholder="Dirección del fabricante" data-parsley-pattern="^[a-zA-Z0-9_. ]+$" data-parsley-length="[2, 60]" data-parsley-trigger="keyup" required>
								</div>
							</div>
							
							<div class="form-row">
                                
                                <div class="form-group col-sm-4">
									<label for="email">Email</label><label class="text-danger">*</label>
									<div class="input-group">
										<div class="input-group-prepend"><span class="input-group-text">@</span></div>
										<input type="text" name="txtEmail" class="form-control" id="email" autofocus placeholder="Ingrese Email" data-parsley-type="email" data-parsley-length="[4, 40]" data-parsley-errors-container="#help-block" data-parsley-trigger="keyup" required>
									</div>
									<span id="help-block"></span>
									<span id="username-available"></span>
								</div>

                                <div class="form-group col-md-4 col-sm-4">
									<label for="telefono">Teléfono</label><label class="text-danger">*</label>
									<input type="tel" name="txtTelefono" class="form-control" id="telefono" placeholder="Ingrese número telefónico" data-parsley-type="number" data-parsley-length="[8, 10]" data-parsley-trigger="keyup" required>
								</div>

								<div class="form-group col-sm-4">
									<label for="categoria">Categoria</label><label class="text-danger">*</label>
									<select  name="txtCategoria" class="form-control" id="categoria" required>
										<option value="">Seleccione una categoría</option>
										<option value="1">Cat 01</option>
										<option value="2">Cat 02</option>
										<option value="3">Cat 03</option>
										<option value="4">Cat 04</option>
								    </select>
								</div>
							</div>

							<div class="col-md-12 text-right">
								<button type="reset" class="btn btn-secondary">Limpiar</button>
								<button type="submit" class="btn btn-primary">Registrar</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>