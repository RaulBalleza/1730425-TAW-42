<!--ListaComponent
Aqui está la tabla donde se van a ver los productos, tambien el modal de agregar producto, se pusieron en el mismo
componente para que la tabla se pueda actualizar el insertar un nuevo registro sin tener que actualizar la pagina
-->
<template>
<div>
<div>
    <!-- Ejemplo de tabla Listado -->
        <div class="card">
            <div class="card-header">
                <i class="fa fa-align-justify"></i> Productos
                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modalNuevo">
                    <i class="icon-plus"></i>&nbsp;Nuevo
                </button>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-md-6">
                        <div class="input-group">
                            <select class="form-control col-md-3" id="opcion" name="opcion">
                                <option value="nombre">Nombre</option>
                                <option value="descripcion">Descripción</option>
                            </select>
                            <input type="text" id="texto" name="texto" class="form-control" placeholder="Texto a buscar">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                        </div>
                    </div>
                </div>
                <table class="table table-bordered table-striped table-sm">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Opciones</th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="producto in arrayProductos" :key="producto.id">
                            <!--v-for
                                Funciona como un ciclo foreach de toa la vida y el key es para saber en que producto vamos
                            -->
                            <td v-text="producto.nombre"></td>
                            <!--v-text 
                                se le asigna una variable de vue, en este caso la que usamos en v-for y se accede a sus atributos por medio el punto
                                aqui se pone el nombre del producto dentro de la etiqueda <td>
                            -->
                            <td v-text="producto.descripcion"></td>
                            <td>
                                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalNuevo">
                                    <i class="icon-pencil"></i>
                                </button> &nbsp;
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalEliminar">
                                    <i class="icon-trash"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <nav>
                    <ul class="pagination">
                        <li class="page-item">
                            <a class="page-link" href="#">Ant</a>
                        </li>
                        <li class="page-item active">
                            <a class="page-link" href="#">1</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">2</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">3</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">4</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">Sig</a>
                        </li>
                    </ul>
                </nav>
                    </div>
                    </div>

</div>
<div><!--Inicio del modal agregar/actualizar-->
<div class="modal fade" id="modalNuevo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-primary modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Agregar Producto</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                    <div class="form-group row">
                        <label class="col-md-3 form-control-label" for="text-input">Nombre</label>
                        <div class="col-md-9">
                            <input v-model="nombre" type="text" id="nombre" name="nombre" class="form-control" placeholder="Nombre de producto">
                            <span  class="help-block">(*) Ingrese el nombre del producto</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 form-control-label" for="email-input">Descripción</label>
                        <div class="col-md-9">
                            <input v-model="descripcion" type="email" id="descripcion" name="descripcion" class="form-control" placeholder="Ingresar descripcion">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" @click="saveProductos()" class="btn btn-primary">Guardar</button>
                <!--@click="funcion()"
                    Manda a llamar una funcion declarada en el <script>, este caso la de guardar el producto
                -->

            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div></div>
</div>

</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
            this.getProductos();
        },
        data(){
            return{
                nombre:"", //Esta variable, mediante v-model esta relacionada con el input del formulario
                descripcion:"", //Esta variable, mediante v-model esta relacionada con el input del formulario
                update:0, /*Esta variable contrarolará cuando es una nueva producto o una modificación, si es 0 significará que no hemos seleccionado
                          ninguna producto, pero si es diferente de 0 entonces tendrá el id de la producto y no mostrará el boton guardar sino el modificar*/
                arrayProductos:[], //Este array contendrá las productos de nuestra bd
            }
        },
        methods:{
            getProductos(){
                let me =this;
                let url = '/productos' //Ruta que hemos creado para que nos devuelva todos los productos
                axios.get(url).then(function (response) {
                    //creamos un array y guardamos el contenido que nos devuelve el response
                    me.arrayProductos = response.data;
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                });
            },saveProductos(){
                let me =this;
                let url = '/productos' //Ruta que hemos creado para enviar una producto y guardarla
                axios.post(url,{ //estas variables son las que enviaremos para que crear la producto
                    'nombre':this.nombre,
                    'descripcion':this.descripcion,
                }).then(function (response) {
                    me.getProductos();
                    me.clearFields();//Limpiamos los campos e inicializamos la variable update a 0
                })
                .catch(function (error) {
                    console.log(error);
                });   
                
            },
            clearFields(){/*Limpia los campos e inicializa la variable update a 0*/
                this.nombre = "";
                this.descripcion = "";
                this.update = 0;
            }
            }
    }
</script>