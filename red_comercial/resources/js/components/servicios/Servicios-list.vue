<template>
  <div class="container">
    <div>
      <div>
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Servicios</h1>
        <p class="mb-4">Listado de los servicios del micrositio.</p>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h2 class="m-0 font-weight-bold text-primary">Tabla de servicios</h2>
            <button
              type="button"
              class="btn btn-primary btn-sm"
              data-toggle="modal"
              data-target="#exampleModal"
              @click="listCategorias()"
            >Nuevo servicio</button>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th>Precio</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th>Precio</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                  </tr>
                </tfoot>
                <tbody v-if="servicios.length > 0">
                  <tr v-for="(servicio,index) in servicios" :key="servicio.id">
                    <td>
                      <router-link :to="'/servicio/'+servicio.id">{{servicio.id}}</router-link>
                    </td>
                    <td>{{servicio.nombre}}</td>
                    <td>{{servicio.descripcion}}</td>
                    <td>$ {{servicio.precio}}</td>
                    <td>{{servicio.estado}}</td>

                    <td>
                      <div class="row">
                        <button
                          class="btn btn-danger btn-sm"
                          @click.prevent="deleteServicio(servicio,index)"
                          type="button"
                          :disabled="form.busy"
                          name="button"
                        >
                          <i class="fas fa-trash"></i>
                          {{ (form.busy) ? 'Please wait...' : 'Delete'}}
                        </button>
                        <router-link :to="'/servicio/'+servicio.id">
                          <button
                            class="btn btn-primary btn-sm"
                            type="button"
                            :disabled="form.busy"
                            name="button"
                          >
                            <i class="fas fa-edit"></i>
                            {{ (form.busy) ? 'Please wait...' : 'Edit'}}
                          </button>
                        </router-link>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- End first half -->

    <div class="servicios">
      <!-- Modal -->
      <div
        class="modal fade"
        id="exampleModal"
        tabindex="-1"
        role="dialog"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true"
      >
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form @submit.prevent="createServicio" id="form">
              <div class="modal-body">
                <div class="form-group">
                  <input type="hidden" v-model="form.id" />
                </div>
                <div class="form-group">
                  <label hidden>id_micrositio</label>
                  <input type="number" v-model="form.id_micrositio" hidden />
                  <has-error :form="form" field="id_micrositio"></has-error>
                </div>
                <div class="form-group" v-if="categorias.length > 0">
                  <label>Categoria</label>
                  <select v-model="form.id_categoria" class="form-control">
                    <option
                      v-for="(opt, index) in categorias"
                      :key="index"
                      :value="opt.id"
                    >{{ opt.nombre}}</option>
                  </select>
                  <has-error :form="form" field="id_categoria"></has-error>
                </div>
                <div class="text-danger" v-else>
                  Porfavor, registra una categoria antes de registrar un nuevo servicio.
                  <router-link
                    target="_blank"
                    :to="'/'+form.id_micrositio+'/categorias/'"
                  >Registrala aquí</router-link>
                </div>
                <div class="form-group">
                  <label>nombre</label>
                  <input type="text" v-model="form.nombre" maxlength="255" />
                  <has-error :form="form" field="nombre"></has-error>
                </div>
                <div class="form-group">
                  <label>descripcion</label>
                  <input type="text" v-model="form.descripcion" maxlength="255" />
                  <has-error :form="form" field="descripcion"></has-error>
                </div>
                <div class="form-group">
                  <label>precio</label>
                  <input type="number" v-model="form.precio" />
                  <has-error :form="form" field="precio"></has-error>
                </div>
                <div class="form-group">
                  <label>estado</label>
                  <select v-model="form.estado" class="form-control">
                    <option value="Activo" selected="selected">Activo</option>
                    <option value="Inactivo">Inactivo</option>
                  </select>
                  <has-error :form="form" field="estado"></has-error>
                </div>
                <div class="form-group">
                  <input type="hidden" v-model="form.created_at" />
                </div>
                <div class="form-group">
                  <input type="hidden" v-model="form.updated_at" />
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                <button v-if="categorias.length > 0"
                  class="btn btn-success btn-sm"
                  type="submit"
                  :disabled="form.busy"
                  name="button"
                >{{ (form.busy) ? 'Please wait...' : 'Submit'}}</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { Form, HasError, AlertError } from "vform";
export default {
  name: "Servicio",
  components: { HasError },
  data: function () {
    return {
      categorias: false,
      servicios: false,
      form: new Form({
        id: "",
        id_micrositio: "",
        nombre: "",
        descripcion: "",
        precio: "",
        estado: "",
        created_at: "",
        updated_at: "",
      }),
    };
  },
  created: function () {
    this.listServicios();
    this.listCategorias();
  },
  methods: {
    listServicios: function () {
      var that = this;
      var idm = this.$route.params.id;
      this.form.get("/api/" + idm + "/servicios").then(function (response) {
        that.servicios = response.data;
        that.form.id_micrositio = idm;
      });
    },

    listCategorias: function () {
      var that = this;
      var idm = this.$route.params.id;
      this.form.get("/api/" + idm + "/categorias").then(function (response) {
        that.categorias = response.data;
      });
    },
    createServicio: function () {
      var that = this;
      this.form.post("/api/servicios").then(function (response) {
        that.servicios.push(response.data);
      });
    },
    deleteServicio: function (servicio, index) {
      var that = this;
      this.form
        .delete("/api/servicios/" + servicio.id)
        .then(function (response) {
          that.servicios.splice(index, 1);
        });
    },
  },
};
</script>

<style lang="less">
.servicios {
  margin: 0 auto;
  width: 700px;
  display: flex;
  .half {
    flex: 1;
    &:first-of-type {
      margin-right: 20px;
    }
  }
  form {
    .form-group {
      margin-bottom: 20px;
      label {
        display: block;
        margin-bottom: 5px;
        text-transform: capitalize;
      }
      input[type="text"],
      input[type="number"],
      textarea {
        width: 100%;
        max-width: 100%;
        min-width: 100%;
        padding: 10px;
        border-radius: 3px;
        border: 1px solid silver;
        font-size: 1rem;
        &:focus {
          outline: 0;
          border-color: blue;
        }
      }
      .invalid-feedback {
        color: red;
        &::first-letter {
          text-transform: capitalize;
        }
      }
    }
    .button {
      appearance: none;
      background: #3bdfd9;
      font-size: 1rem;
      border: 0px;
      padding: 10px 20px;
      border-radius: 3px;
      font-weight: bold;
      &:hover {
        cursor: pointer;
        background: darken(#3bdfd9, 10);
      }
    }
  }
}
</style>