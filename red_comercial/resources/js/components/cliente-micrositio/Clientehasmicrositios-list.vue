<template>
  <div class="clientehasmicrositios">
    <div class="half">
      <h1>Create clientehasmicrositio</h1>

      <form @submit.prevent="createClientehasmicrositio">
        <div class="form-group">
          <input type="hidden" v-model="form.id" />
        </div>
        <div class="form-group">
          <label>id_user</label>
          <input type="number" v-model="form.id_user" />
          <has-error :form="form" field="id_user"></has-error>
        </div>
        <div class="form-group">
          <label>id_micrositio</label>
          <input type="number" v-model="form.id_micrositio" />
          <has-error :form="form" field="id_micrositio"></has-error>
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
      <h1>List clientehasmicrositios</h1>

      <ul v-if="clientehasmicrositios.length > 0">
        <li
          v-for="(clientehasmicrositio,index) in clientehasmicrositios"
          :key="clientehasmicrositio.id"
        >
          <router-link :to="'/admin/cliente-micrositio/'+clientehasmicrositio.id">
            clientehasmicrositio {{ index }}
            <button
              @click.prevent="deleteClientehasmicrositio(clientehasmicrositio,index)"
              type="button"
              :disabled="form.busy"
              name="button"
            >{{ (form.busy) ? 'Please wait...' : 'Delete'}}</button>
          </router-link>
        </li>
      </ul>

      <span v-else-if="!clientehasmicrositios">Loading...</span>
      <span v-else>No clientehasmicrositios exist</span>
    </div>
    <!-- End 2nd half -->
  </div>
</template>

<script>
import { Form, HasError, AlertError } from "vform";
export default {
  name: "Clientehasmicrositio",
  components: { HasError },
  data: function () {
    return {
      clientehasmicrositios: false,
      form: new Form({
        id: "",
        id_user: "",
        id_micrositio: "",
        created_at: "",
        updated_at: "",
      }),
    };
  },
  created: function () {
    this.listClientehasmicrositios();
  },
  methods: {
    listClientehasmicrositios: function () {
      var that = this;
      this.form.get("/api/clientehasmicrositios").then(function (response) {
        that.clientehasmicrositios = response.data;
      });
    },
    createClientehasmicrositio: function () {
      var that = this;
      this.form.post("/api/clientehasmicrositios").then(function (response) {
        that.clientehasmicrositios.push(response.data);
      });
    },
    deleteClientehasmicrositio: function (clientehasmicrositio, index) {
      var that = this;
      this.form
        .delete("/api/clientehasmicrositios/" + clientehasmicrositio.id)
        .then(function (response) {
          that.clientehasmicrositios.splice(index, 1);
        });
    },
  },
};
</script>

<style lang="less">
.clientehasmicrositios {
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