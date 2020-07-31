<template>
      <div class="MicrositioSingle">
        <h1>Update Micrositio</h1>
        
        <form @submit.prevent="updateMicrositio" v-if="loaded">
          
          <router-link to="/micrositios">Back to micrositios</router-link>
          
            <div class="form-group">
   
                  <input type="hidden" v-model="form.id"></input>
            </div>
            <div class="form-group">
                  <label>nombre</label>
                  <input type="text" v-model="form.nombre"  maxlength="255" ></input>
                  <has-error :form="form" field="nombre"></has-error>
            </div>
            <div class="form-group">
                  <label>direccion</label>
                  <input type="text" v-model="form.direccion"  maxlength="255" ></input>
                  <has-error :form="form" field="direccion"></has-error>
            </div>
            <div class="form-group">
                  <label>descripcion</label>
                  <input type="text" v-model="form.descripcion"  maxlength="255" ></input>
                  <has-error :form="form" field="descripcion"></has-error>
            </div>
            <div class="form-group">
                  <label>url</label>
                  <input type="text" v-model="form.url"  maxlength="255" ></input>
                  <has-error :form="form" field="url"></has-error>
            </div>
            <div class="form-group">
                  <label>estado</label>
                  <input type="text" v-model="form.estado"  maxlength="255" ></input>
                  <has-error :form="form" field="estado"></has-error>
            </div>
            <div class="form-group">
   
                  <input type="hidden" v-model="form.created_at"></input>
            </div>
            <div class="form-group">
   
                  <input type="hidden" v-model="form.updated_at"></input>
            </div>
      
          <div class="form-group">
              <button class="button" type="submit" :disabled="form.busy" name="button">{{ (form.busy) ? 'Please wait...' : 'Update'}}</button>
              <button @click.prevent="deleteMicrositio">{{ (form.busy) ? 'Please wait...' : 'Delete'}}</button>
          </div>
        </form>
        
        <span v-else>Loading micrositio...</span>
      </div>
</template>

<script>
import { Form, HasError, AlertError } from 'vform'
export default {
  name: 'Micrositio',
  components: {HasError},
  data: function(){
    return {
      loaded: false,
      form: new Form({
          "id" : "",
          "nombre" : "",
          "direccion" : "",
          "descripcion" : "",
          "url" : "",
          "estado" : "",
          "created_at" : "",
          "updated_at" : "",
        
      })
    }
  },
  created: function(){
    this.getMicrositio();
  },
  methods: {
    getMicrositio: function(Micrositio){
      
      var that = this;
      this.form.get('/api/micrositios/'+this.$route.params.id).then(function(response){
        that.form.fill(response.data);
        that.loaded = true;
      }).catch(function(e){
          if (e.response && e.response.status == 404) {
              that.$router.push('/404');
          }
      });
      
    },
    updateMicrositio: function(){
      
      var that = this;
      this.form.put('/api/micrositios/'+this.$route.params.id).then(function(response){
        that.form.fill(response.data);
      })
      
    },
    deleteMicrositio: function(){
      
      var that = this;
      this.form.delete('/api/micrositios/'+this.$route.params.id).then(function(response){
        that.form.fill(response.data);
        that.$router.push('/micrositios');
      })
      
    }
  }
}
</script>

<style lang="less">
.MicrositioSingle{
  margin:0 auto;
  width:700px;
  form{
    .form-group{
      margin-bottom:20px;
      label{
        display:block;
        margin-bottom:5px;
        text-transform: capitalize;
      }
      input[type="text"],input[type="number"],textarea{
        width:100%;
        max-width:100%;
        min-width:100%;
        padding:10px;
        border-radius:3px;
        border:1px solid silver;
        font-size:1rem;
        &:focus{
          outline:0;
          border-color:blue;
        }
      }
      .button{
        appearance: none;
        background: #3bdfd9;
        font-size: 1rem;
        border: 0px;
        padding: 10px 20px;
        border-radius: 3px;
        font-weight: bold;
        &:hover{
          cursor:pointer;
          background: darken(#3bdfd9,10);
        }
      }
      .invalid-feedback{
        color:red;
        &::first-letter{
          text-transform:capitalize;
        }
      }
    }
  }
}
</style>