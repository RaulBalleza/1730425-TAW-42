<template>
  <div class="ServicioSingle">
    <h1>Editar Servicio</h1>

    <form @submit.prevent="updateServicio" v-if="loaded">
      <router-link :to="'/admin/'+form.id_micrositio+'/servicios/'">Regresar a servicios</router-link>

      <div class="form-group">
        <input type="hidden" v-model="form.id" />
      </div>
      <div class="form-group">
        <label hidden>id_micrositio</label>
        <input type="number" v-model="form.id_micrositio" hidden />
        <has-error :form="form" field="id_micrositio"></has-error>
      </div>
      <div class="form-group">
        <label>Categoria</label>
        <select v-model="form.id_categoria" class="form-control">
          <option v-for="(opt, index) in categorias" :key="index" :value="opt.id">{{ opt.nombre}}</option>
        </select>
        <has-error :form="form" field="id_categoria"></has-error>
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

      <div class="form-group">
        <button class="btn btn-sm btn-danger" @click.prevent="deleteServicio">{{ (form.busy) ? 'Please wait...' : 'Delete'}}</button>
        <button
          class="btn btn-sm btn-success"
          type="submit"
          :disabled="form.busy"
          name="button"
        >{{ (form.busy) ? 'Please wait...' : 'Update'}}</button>
      </div>
    </form>

    <span v-else>Loading servicio...</span>
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
      loaded: false,
      form: new Form({
        id: "",
        id_micrositio: "",
        id_categoria: "",
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
    this.getServicio();
  },
  methods: {
    getServicio: function (Servicio) {
      var that = this;
      this.form
        .get("/api/servicios/" + this.$route.params.id)
        .then(function (response) {
          that.form.fill(response.data);
          that.loaded = true;
          that.listCategorias();
        })
        .catch(function (e) {
          if (e.response && e.response.status == 404) {
            that.$router.push("/404");
          }
        });
    },
    listCategorias: function () {
      var that = this;
      var idm = that.form.id_micrositio;
      console.log(idm);
      this.form.get("/api/" + idm + "/categorias").then(function (response) {
        that.categorias = response.data;
      });
    },
    updateServicio: function () {
      var that = this;
      this.form
        .put("/api/servicios/" + this.$route.params.id)
        .then(function (response) {
          that.form.fill(response.data);
        });
    },
    deleteServicio: function () {
      var that = this;
      this.form
        .delete("/api/servicios/" + this.$route.params.id)
        .then(function (response) {
          that.form.fill(response.data);
          that.$router.push("/servicios");
        });
    },
  },
};
</script>

<style lang="less">
.ServicioSingle {
  margin: 0 auto;
  width: 700px;
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
      .invalid-feedback {
        color: red;
        &::first-letter {
          text-transform: capitalize;
        }
      }
    }
  }
}
</style>