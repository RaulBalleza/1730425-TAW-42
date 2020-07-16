<template>
  <div class="products">
    <div class="half">
      <h1>Create product</h1>

      <form @submit.prevent="createProduct">
        <div class="form-group">
          <input type="hidden" v-model="form.id" />
        </div>
        <div class="form-group">
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
          <button
            class="button"
            type="submit"
            :disabled="form.busy"
            name="button"
          >{{ (form.busy) ? 'Please wait...' : 'Submit'}}</button>
        </div>
      </form>
    </div>
    <!-- End first half -->

    <div class="half">
      <h1>List products</h1>

      <ul v-if="products.length > 0">
        <li v-for="(product,index) in products" :key="product.id">
          <router-link :to="'/product/'+product.id">
            product {{ index }}
            <button
              @click.prevent="deleteProduct(product,index)"
              type="button"
              :disabled="form.busy"
              name="button"
            >{{ (form.busy) ? 'Please wait...' : 'Delete'}}</button>
          </router-link>
        </li>
      </ul>

      <span v-else-if="!products">Loading...</span>
      <span v-else>No products exist</span>
    </div>
    <!-- End 2nd half -->
  </div>
</template>

<script>
import { Form, HasError, AlertError } from "vform";
export default {
  name: "Product",
  components: { HasError },
  data: function() {
    return {
      products: false,
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
    this.listProducts();
  },
  methods: {
    listProducts: function() {
      var that = this;
      var idm = this.$route.params.id;
      this.form.get("/api/" + idm + "/products").then(function(response) {
        that.products = response.data;
        that.form.id_micrositio = idm;
      });
    },
    createProduct: function() {
      var that = this;
      this.form.post("/api/products").then(function(response) {
        that.listProducts();
      });
    },
    deleteProduct: function(product, index) {
      var that = this;
      this.form.delete("/api/products/" + product.id).then(function(response) {
        that.products.splice(index, 1);
      });
    }
  }
};
</script>

<style lang="less">
.products {
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