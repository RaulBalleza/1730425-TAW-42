
    <div class="container-fluid">
        <h2 class="mt-4">Fabricantes</h2>

        <div class="row mt-4 mb-4">
			<div class="col-6">
				<div class="text-left">
					<a href="?controller=Fabricante&action=registrar" class="btn btn-sm btn-outline-primary"><i class="fa fa-fw fa-plus-circle"></i> Registrar un nuevo fabricante</a>
				</div>
			</div>
            <div class="col-6">
				<div class="text-right">
					<i class="fa fa-fw fa-globe"></i><strong> Buscar un fabricante</strong>
				</div>
			</div>
		</div>

        <div class="table table-bordered table-striped table-hover display nowrap">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Dirección</th>
                        <th scope="col">Email</th>
                        <th scope="col">Teléfono</th>
                        <th scope="col">Categoría</th>
                        <th scope="col"></th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($fabricantes as $fabricante) {?>

                    
                    <tr>
                        <td><?php echo $fabricante->getId(); ?></td>
                        <td><?php echo $fabricante->getNombre(); ?></td>
                        <td><?php echo $fabricante->getDireccion(); ?></td>
                        <td><?php echo $fabricante->getEmail(); ?></td>
                        <td><?php echo $fabricante->getTelefono(); ?></td>
                        <td><?php echo $fabricante->getIdCategoria(); ?></td>
                        <td class="actions">
                            <a href="?controller=Fabricante&&action=actualizarFabricante&&id=<?php echo $fabricante->getId()?>" class="edit">
                                <div class="text-center"><i class="fas fa-pen"></i> Editar</div>
							</a>
                            
                            <a class="trash" href="#" data-toggle='modal' data-target='#deleteModal'>
                                <div class='text-center'><i class='fas fa-trash'></i> Eliminar</div>
                            </a>
                        </td>
                    </tr>

                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">

				<div class="modal-header">
					<h4 class="modal-title">Eliminar fabricante</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>

				<form action="eliminar.php" id="eliminarMiembroModal" method="POST">
					<div class="modal-body">
						<input type="hidden" name="delete_id" id="delete_id">
						<p>¿Seguro(a) que deseas eliminar este fabricante?</p>
					</div>

					<div class="modal-footer">
						<button type="button" data-dismiss="modal" class="btn btn-secondary">Cancelar</button>
                        <a class="btn btn-danger" href="?controller=Fabricante&&action=eliminar&&id=<?php echo $fabricante->getId() ?>">Eliminar</a>
					</div>
				</form>
			</div>
		</div>
	</div>