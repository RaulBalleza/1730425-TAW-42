<template>
  <div class="UserSingle">
    <h1>Update User</h1>

    <form @submit.prevent="updateUser" v-if="loaded">
      <router-link to="/users">Back to users</router-link>

      <div class="form-group">
        <input type="hidden" v-model="form.id" />
      </div>
      <div class="form-group">
        <label>name</label>
        <input type="text" v-model="form.name" maxlength="255" />
        <has-error :form="form" field="name"></has-error>
      </div>
      <div class="form-group">
        <label>email</label>
        <input type="text" v-model="form.email" maxlength="255" />
        <has-error :form="form" field="email"></has-error>
      </div>
      <div class="form-group">
        <input type="number" v-model="form.email_verified_at" hidden />
      </div>
      <div class="form-group">
        <label>password</label>
        <input type="text" v-model="form.password" maxlength="255" />
        <has-error :form="form" field="password"></has-error>
      </div>
      <div class="form-group">
        <input type="text" v-model="form.remember_token" maxlength="100" hidden />
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
        <button @click.prevent="deleteUser">{{ (form.busy) ? 'Please wait...' : 'Delete'}}</button>
      </div>
    </form>

    <span v-else>Loading user...</span>
  </div>
</template>

<script>
import { Form, HasError, AlertError } from "vform";
export default {
  name: "User",
  components: { HasError },
  data: function() {
    return {
      loaded: false,
      form: new Form({
        id: "",
        name: "",
        email: "",
        email_verified_at: "",
        password: "",
        remember_token: "",
        created_at: "",
        updated_at: ""
      })
    };
  },
  created: function() {
    this.getUser();
  },
  methods: {
    getUser: function(User) {
      var that = this;
      this.form
        .get("/api/users/" + this.$route.params.id)
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
    updateUser: function() {
      var that = this;
      this.form
        .put("/api/users/" + this.$route.params.id)
        .then(function(response) {
          that.form.fill(response.data);
        });
    },
    deleteUser: function() {
      var that = this;
      this.form
        .delete("/api/users/" + this.$route.params.id)
        .then(function(response) {
          that.form.fill(response.data);
          that.$router.push("/users");
        });
    }
  }
};
</script>

<style lang="less">
.UserSingle {
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