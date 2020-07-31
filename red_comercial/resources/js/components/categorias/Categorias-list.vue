<template>
  <div class="container">
    <div>
      <div>
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Categorias</h1>
        <p class="mb-4">Listado de los categorias.</p>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h2 class="m-0 font-weight-bold text-primary">Tabla de categorias</h2>
            <button
              type="button"
              class="btn btn-primary btn-sm"
              data-toggle="modal"
              data-target="#exampleModal"
            >Nuevo categoria</button>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Acciones</th>
                  </tr>
                </tfoot>
                <tbody v-if="categorias.length > 0">
                  <tr v-for="(categoria,index) in categorias" :key="categoria.id">
                    <td>
                      <router-link :to="'/categoria/'+categoria.id">{{categoria.id}}</router-link>
                    </td>
                    <td>{{categoria.nombre}}</td>
                    <td>
                      <div class="row">
                        <button
                          @click.prevent="deleteCategoria(categoria,index)"
                          type="button"
                          class="btn btn-danger btn-sm"
                          :disabled="form.busy"
                          name="button"
                        >
                          <i class="fas fa-trash"></i>
                          {{ (form.busy) ? 'Please wait...' : 'Delete'}}
                        </button>
                        <router-link :to="'/categoria/'+categoria.id">
                          <button
                            class="btn btn-primary btn-sm"
                            type="button"
                            :disabled="form.busy"
                            name="button"
                          >
                            <i class="fas fa-edit"></i>
                            {{ (form.busy) ? 'Please wait...' : 'Editar'}}
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

    <div class="categorias">
      <!-- Modal -->
      <div class="products">
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
              <form @submit.prevent="createCategoria" id="form">
                <div class="modal-body">
                  <div class="form-group">
                    <input type="hidden" v-model="form.id" />
                  </div>
                  <div class="form-group">
                    <label hidden>id_micrositio</label>
                    <input type="number" v-model="form.id_micrositio" hidden />
                    <has-error :form="form" field="id_micrositio"></has-error>
                  </div>
                  <div class="form-group">
                    <label>nombre</label>
                    <input type="text" v-model="form.nombre" maxlength="255" />
                    <has-error :form="form" field="nombre"></has-error>
                  </div>
                  <div class="form-group">
                    <input type="hidden" v-model="form.created_at" />
                  </div>
                  <div class="form-group">
                    <input type="hidden" v-model="form.updated_at" />
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>
                  <button
                    class="btn btn-sm btn-success"
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
  </div>
</template>

<script>
import { Form, HasError, AlertError } from "vform";
export default {
  name: "Categoria",
  components: { HasError },
  data: function () {
    return {
      categorias: false,
      form: new Form({
        id: "",
        id_micrositio: "",
        nombre: "",
        created_at: "",
        updated_at: "",
      }),
    };
  },
  created: function () {
    this.listCategorias();
  },
  methods: {
    listCategorias: function () {
      var that = this;
      var idm = this.$route.params.id;
      this.form.get("/api/" + idm + "/categorias").then(function (response) {
        that.categorias = response.data;
        that.form.id_micrositio = idm;
      });
    },
    createCategoria: function () {
      var that = this;
      this.form.post("/api/categorias").then(function (response) {
        that.categorias.push(response.data);
      });
    },
    deleteCategoria: function (categoria, index) {
      var that = this;
      this.form
        .delete("/api/categorias/" + categoria.id)
        .then(function (response) {
          that.categorias.splice(index, 1);
        });
    },
  },
};
</script>

<style lang="less">
.categorias {
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