<template>
  <div class="container">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Tables</h1>
    <p class="mb-4">
      DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the
      <a
        target="_blank"
        href="https://datatables.net"
      >official DataTables documentation</a>.
    </p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead v-for="producto in arrayProductos[0]" :key="producto.id">
              <tr>
                <div>
                  <th v-for="(value, name) in producto" :key="name">
                    <p v-text="name"></p>
                  </th>
                </div>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Office</th>
                <th>Age</th>
                <th>Start date</th>
                <th>Salary</th>
              </tr>
            </tfoot>
            <tbody>
              <tr v-for="producto in arrayProductos" :key="producto.id">
                <td v-text="producto.nombre"></td>
                <td>System Architect</td>
                <td>Edinburgh</td>
                <td>61</td>
                <td>2011/04/25</td>
                <td>$320,800</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Example Component</div>

          <div class="card-body">
            <div v-for="producto in arrayProductos" :key="producto.id">
              <p v-text="producto.nombre"></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  mounted() {
    console.log("ExampleComponent mounted.");
    this.getProductos();
  },
  data() {
    return {
      nombre: "", //Esta variable, mediante v-model esta relacionada con el input del formulario
      descripcion: "", //Esta variable, mediante v-model esta relacionada con el input del formulario
      update: 0 /*Esta variable contrarolará cuando es una nueva producto o una modificación, si es 0 significará que no hemos seleccionado
                          ninguna producto, pero si es diferente de 0 entonces tendrá el id de la producto y no mostrará el boton guardar sino el modificar*/,
      arrayProductos: [] //Este array contendrá las productos de nuestra bd
    };
  },
  methods: {
    getProductos() {
      let me = this;
      let url = "/api/products"; //Ruta que hemos creado para que nos devuelva todos los productos
      me.axios
        .get(url)
        .then(function(response) {
          //creamos un array y guardamos el contenido que nos devuelve el response
          me.arrayProductos = response.data;
          console.log(response.data);
        })
        .catch(function(error) {
          // handle error
          console.log(error);
        });
    },
    saveProductos() {
      let me = this;
      let url = "/api/products"; //Ruta que hemos creado para enviar una producto y guardarla
      me.axios
        .post(url, {
          //estas variables son las que enviaremos para que crear la producto
          nombre: this.nombre,
          descripcion: this.descripcion
        })
        .then(function(response) {
          me.getProductos();
          me.clearFields(); //Limpiamos los campos e inicializamos la variable update a 0
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    clearFields() {
      /*Limpia los campos e inicializa la variable update a 0*/
      this.nombre = "";
      this.descripcion = "";
      this.update = 0;
    }
  }
};
</script>