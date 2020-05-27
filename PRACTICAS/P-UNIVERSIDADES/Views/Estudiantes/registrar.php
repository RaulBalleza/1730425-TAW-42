    <div class="container-fluid mt-4">
    	<div class="row">
    		<div class="container col-sm-12 col-md-10 col-lg-10 col-xl-7">

    			<div class="panel panel-default">
    				<div class="panel-body">

    					<form action="?controller=Estudiante&action=guardar" method="POST" data-parsley-validate>
    						<!-- Agregar id para notificación overhang -->

    						<div class="row">
    							<div class="col-12 col-sm-6 col-md-7">
    								<legend>Registrar estudiante</legend>
    							</div>
    							<!--div class="col-12 col-sm-6 col-md-5">
									<div class="text-right">
										<a href="?controller=Producto&action=mostrar"><label>Regresar a lista de productos</label></a>
									</div>
								</div-->
    						</div>

    						<div class="form-row">

    							<div class="form-group col-sm-4">
    								<label for="matricula">Matricula</label><label class="text-danger">*</label>
    								<input type="text" name="txtMatricula" class="form-control" id="nombre" placeholder="Numero de matricula" data-parsley-pattern="^[A-zÀ-ú ]+$" data-parsley-length="[2, 30]" data-parsley-trigger="keyup" required>
    							</div>
    							<div class="form-group col-sm-4">
    								<label for="nombre">Nombre</label><label class="text-danger">*</label>
    								<input type="text" name="txtNombre" class="form-control" id="nombre" placeholder="Nombre del producto" data-parsley-pattern="^[A-zÀ-ú ]+$" data-parsley-length="[2, 30]" data-parsley-trigger="keyup" required>
    							</div>

    							<div class="form-group col-sm-4">
    								<label for="descripcion">Promedio</label><label class="text-danger">*</label>
    								<input type="text" name="txtPromedio" class="form-control" id="descripcion" placeholder="Descripción del producto" data-parsley-pattern="^[A-zÀ-ú ]+$" data-parsley-length="[2, 120]" data-parsley-trigger="keyup" required>
    							</div>

    						</div>

    						<div class="form-row">
    							<div class="form-group col-sm-4">
    								<label for="color">Edad</label><label class="text-danger">*</label>
    								<input type="text" name="txtEdad" class="form-control" id="color" placeholder="Color del producto" data-parsley-pattern="^[A-zÀ-ú ]+$" data-parsley-length="[2, 14]" data-parsley-trigger="keyup" required>
								</div>
								<input type="text" name="txtCarrera" value="<?php echo $id; ?>" hidden>
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