<template>
  <div class="clientes">
    <div class="half">
      <h1>Create cliente</h1>

      <form @submit.prevent="createCliente">
        <div class="form-group">
          <input type="hidden" v-model="form.id" />
        </div>
        <div class="form-group">
          <label>id_usuario</label>
          <input type="number" v-model="form.id_usuario" />
          <has-error :form="form" field="id_usuario"></has-error>
        </div>
        <div class="form-group">
          <label>nombre</label>
          <input type="text" v-model="form.nombre" maxlength="255" />
          <has-error :form="form" field="nombre"></has-error>
        </div>
        <div class="form-group">
          <label>telefono</label>
          <input type="text" v-model="form.telefono" maxlength="255" />
          <has-error :form="form" field="telefono"></has-error>
        </div>
        <div class="form-group">
          <label>Direccion</label>
          <input type="text" v-model="form.Direccion" maxlength="255" />
          <has-error :form="form" field="Direccion"></has-error>
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
      <h1>List clientes</h1>

      <ul v-if="clientes.length > 0">
        <li v-for="(cliente,index) in clientes" :key="cliente.id">
          <router-link :to="'/cliente/'+cliente.id">
            cliente {{ index }}
            <button
              @click.prevent="deleteCliente(cliente,index)"
              type="button"
              :disabled="form.busy"
              name="button"
            >{{ (form.busy) ? 'Please wait...' : 'Delete'}}</button>
          </router-link>
        </li>
      </ul>

      <span v-else-if="!clientes">Loading...</span>
      <span v-else>No clientes exist</span>
    </div>
    <!-- End 2nd half -->
  </div>
</template>

<script>
import { Form, HasError, AlertError } from "vform";
export default {
  name: "Cliente",
  components: { HasError },
  data: function() {
    return {
      clientes: false,
      form: new Form({
        id: "",
        id_usuario: "",
        nombre: "",
        telefono: "",
        Direccion: "",
        created_at: "",
        updated_at: ""
      })
    };
  },
  created: function() {
    this.listClientes();
  },
  methods: {
    listClientes: function() {
      var that = this;
      this.form.get("/api/clientes").then(function(response) {
        that.clientes = response.data;
      });
    },
    createCliente: function() {
      var that = this;
      this.form.post("/api/clientes").then(function(response) {
        that.clientes.push(response.data);
      });
    },
    deleteCliente: function(cliente, index) {
      var that = this;
      this.form.delete("/api/clientes/" + cliente.id).then(function(response) {
        that.clientes.splice(index, 1);
      });
    }
  }
};
</script>

<style lang="less">
.clientes {
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