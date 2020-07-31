<template>
  <div class="CategoriaSingle">
    <h1>Editar Categoria</h1>

    <form @submit.prevent="updateCategoria" v-if="loaded">
      <router-link :to="'/'+form.id_micrositio+'/categorias'">Regresar a categorias</router-link>

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

      <div class="form-group">
        <button
          class="btn btn-sm btn-danger"
          @click.prevent="deleteCategoria"
        >{{ (form.busy) ? 'Please wait...' : 'Delete'}}</button>
        <button
          class="btn btn-sm btn-success"
          type="submit"
          :disabled="form.busy"
          name="button"
        >{{ (form.busy) ? 'Please wait...' : 'Update'}}</button>
      </div>
    </form>

    <span v-else>Loading categoria...</span>
  </div>
</template>

<script>
import { Form, HasError, AlertError } from "vform";
export default {
  name: "Categoria",
  components: { HasError },
  data: function () {
    return {
      loaded: false,
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
    this.getCategoria();
  },
  methods: {
    getCategoria: function (Categoria) {
      var that = this;
      this.form
        .get("/api/categorias/" + this.$route.params.id)
        .then(function (response) {
          that.form.fill(response.data);
          that.loaded = true;
        })
        .catch(function (e) {
          if (e.response && e.response.status == 404) {
            that.$router.push("/404");
          }
        });
    },
    updateCategoria: function () {
      var that = this;
      this.form
        .put("/api/categorias/" + this.$route.params.id)
        .then(function (response) {
          that.form.fill(response.data);
        });
    },
    deleteCategoria: function () {
      var that = this;
      this.form
        .delete("/api/categorias/" + this.$route.params.id)
        .then(function (response) {
          that.form.fill(response.data);
          that.$router.push("/categorias");
        });
    },
  },
};
</script>

<style lang="less">
.CategoriaSingle {
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