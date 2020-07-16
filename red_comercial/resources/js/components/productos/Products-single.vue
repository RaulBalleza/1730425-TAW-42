<template>
  <div class="ProductSingle">
    <h1>Update Product</h1>

    <form @submit.prevent="updateProduct" v-if="loaded">
      <router-link :to="'/'+form.id_micrositio+'/products/'">Back to products</router-link>

      <div class="form-group">
        <input type="hidden" v-model="form.id" />
      </div>
      <div class="form-group">
        <label>id_micrositio</label>
        <input type="number" v-model="form.id_micrositio" hidden />
        <has-error :form="form" field="id_micrositio"></has-error>
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
        <label>stock</label>
        <input type="number" v-model="form.stock" />
        <has-error :form="form" field="stock"></has-error>
      </div>
      <div class="form-group">
        <label>costo</label>
        <input type="number" v-model="form.costo" />
        <has-error :form="form" field="costo"></has-error>
      </div>
      <div class="form-group">
        <label>precio</label>
        <input type="number" v-model="form.precio" />
        <has-error :form="form" field="precio"></has-error>
      </div>
      <div class="form-group">
        <label>estado</label>
        <select v-model="form.estado" class="form-group">
          <option value="Activo">Activo</option>
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
        <button
          class="button"
          type="submit"
          :disabled="form.busy"
          name="button"
        >{{ (form.busy) ? 'Please wait...' : 'Update'}}</button>
        <button @click.prevent="deleteProduct">{{ (form.busy) ? 'Please wait...' : 'Delete'}}</button>
      </div>
    </form>

    <span v-else>Loading product...</span>
  </div>
</template>

<script>
import { Form, HasError, AlertError } from "vform";
export default {
  name: "Product",
  components: { HasError },
  data: function() {
    return {
      loaded: false,
      form: new Form({
        id: "",
        id_micrositio: "",
        nombre: "",
        descripcion: "",
        stock: "",
        costo: "",
        precio: "",
        estado: "",
        created_at: "",
        updated_at: ""
      })
    };
  },
  created: function() {
    this.getProduct();
  },
  methods: {
    getProduct: function(Product) {
      var that = this;
      this.form
        .get("/api/products/" + this.$route.params.id)
        .then(function(response) {
          that.form.fill(response.data);
          that.loaded = true;
        })
        .catch(function(e) {
          if (e.response && e.response.status == 404) {
            that.$router.push("/404");
          }
        });
    },
    updateProduct: function() {
      var that = this;
      this.form
        .put("/api/products/" + this.$route.params.id)
        .then(function(response) {
          that.form.fill(response.data);
        });
    },
    deleteProduct: function() {
      var that = this;
      this.form
        .delete("/api/products/" + this.$route.params.id)
        .then(function(response) {
          that.form.fill(response.data);
          that.$router.push("/products");
        });
    }
  }
};
</script>

<style lang="less">
.ProductSingle {
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