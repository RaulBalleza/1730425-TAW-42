<div class="container-fluid">
    <h2 class="mt-4">Productos</h2>
    <div class="row mt-4 mb-4">
        <div class="col-6">
            <div class="text-left">
                <a href="?controller=Producto&action=registrar" class="btn btn-sm btn-outline-primary"><i class="fa fa-fw fa-plus-circle"></i> Registrar un nuevo producto</a>
            </div>
        </div>
        <div class="col-6">
            <div class="text-right">
                <i class="fa fa-fw fa-globe"></i><strong> Buscar un producto</strong>
            </div>
        </div>
    </div>

    <div class="table table-bordered table-striped table-hover display nowrap">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Promedio</th>
                    <th scope="col">Edad</th>
                    <th scope="col">Carrera</th>
                    <th scope="col"></th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($estudiantes as $estudiante) { ?>

                    <tr>
                        <td><?php echo $estudiante->getMatricula(); ?></td>
                        <td><?php echo $estudiante->getNombre(); ?></td>
                        <td><?php echo $estudiante->getPromedio(); ?></td>
                        <td><?php echo $estudiante->getEdad(); ?></td>
                        <td><?php echo $estudiante->getCarrera(); ?></td>

                        <td class="actions">
                            <a href="?controller=Producto&&action=actualizarProducto&&id=<?php echo $producto->getId() ?>" class="edit">
                                <div class="text-center"><i class="fas fa-pen"></i> Editar</div>
                            </a>
                            <a href="#" class="trash" data-toggle='modal' data-target='#deleteModal'>
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
                <h4 class="modal-title">Eliminar producto</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="eliminar.php" id="eliminarMiembroModal" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="delete_id" id="delete_id">
                    <p>¿Seguro(a) que deseas eliminar este producto?</p>
                </div>

                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-secondary">Cancelar</button>
                    <a class="btn btn-danger" href="?controller=Producto&&action=eliminar&&id=<?php echo $producto->getId() ?>">Eliminar</a>
                </div>
            </form>
        </div>
    </div>
</div>