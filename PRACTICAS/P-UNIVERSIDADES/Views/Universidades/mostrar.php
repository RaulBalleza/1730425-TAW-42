<div class="container">
    <h2 class="mt-4">Universidades</h2>

    <div class="row mt-4 mb-4">
        <div class="col-6">
            <div class="text-left">
                <a href="?controller=Universidad&action=registrar" class="btn btn-sm btn-outline-primary"><i class="fa fa-fw fa-plus-circle"></i> Registrar una nueva universidad</a>
            </div>
        </div>
        <div class="col-6">
            <div class="text-right">
                <i class="fa fa-fw fa-globe"></i><strong> Buscar universidad</strong>
            </div>
        </div>
    </div>

    <div class="table table-bordered table-striped table-hover display nowrap">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Nombre</th>
                    <th scope="col"></th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($universidades as $universidad) { ?>


                    <tr>
                        <td><?php echo $universidad->getId(); ?></td>
                        <td><?php echo $universidad->getNombre(); ?></td>
                        <td class="actions">
                            <div class="text-left">
                                <a href="?controller=Universidad&action=actualizarUniversidad&id=<?php echo $universidad->getId(); ?>" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-pen"></i> Editar</a>
                            </div>
                            <a href="#" class="trash" data-toggle='modal' data-target='#deleteModal'>
                                <div class='text-center'><i class='fas fa-trash'></i> Eliminar</div>
                            </a>
                            <div class="text-left">
                                <a href="?controller=Carrera&action=mostrar&id=<?php echo $universidad->getId(); ?>" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-pen"></i> Editar</a>
                            </div>
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
                <h4 class="modal-title">Eliminar categoría</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="eliminar.php" id="eliminarMiembroModal" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="delete_id" id="delete_id">
                    <p>¿Seguro(a) que deseas eliminar esta categoría de producto?</p>
                </div>

                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-secondary">Cancelar</button>
                    <a class="btn btn-danger" href="?controller=Universidad&&action=eliminar&&id=<?php echo $universidad->getId() ?>">Eliminar</a>
                </div>
            </form>
        </div>
    </div>
</div>