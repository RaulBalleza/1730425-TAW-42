    <div class="container-fluid mt-4">
    	<div class="row">
    		<div class="container col-sm-12 col-md-10 col-lg-10 col-xl-7">

    			<div class="panel panel-default">
    				<div class="panel-body">

    					<form action="?controller=Carrera&action=guardar" method="POST" data-parsley-validate>
    						<!-- Agregar id para notificación overhang -->

    						<div class="row">
    							<div class="col-12 col-sm-6 col-md-7">
    								<legend>Registrar carrera</legend>
    							</div>
    						</div>

    						<div class="form-row">
    							<div class="form-group col-md-12">
    								<label for="nombre">Nombre de la carrera</label><label class="text-danger">*</label>
    								<input type="text" name="txtNombre" class="form-control" id="nombre" placeholder="Ingrese el nombre de la categoría" data-parsley-pattern="^[A-zÀ-ú ]+$" data-parsley-length="[2, 30]" data-parsley-trigger="keyup" required>
    							</div>
    						</div>
    						<input type="text" name="txtUni" value="<?php echo $id; ?>" hidden>

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