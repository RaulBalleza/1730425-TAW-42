<template>
      <div class="micrositios">
        
        <div class="half">
          
          <h1>Create micrositio</h1>
          
          <form @submit.prevent="createMicrositio">
            
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
   
                  <input type="hidden" v-model="form.created_at"></input>
            </div>
            <div class="form-group">
   
                  <input type="hidden" v-model="form.updated_at"></input>
            </div>
        
            <div class="form-group">
                <button class="button" type="submit" :disabled="form.busy" name="button">{{ (form.busy) ? 'Please wait...' : 'Submit'}}</button>
            </div>
          </form>
          
        </div><!-- End first half -->
        
        <div class="half">
          
          <h1>List micrositios</h1>
          
          <ul v-if="micrositios.length > 0">
            <li v-for="(micrositio,index) in micrositios" :key="micrositio.id">
              
            <router-link :to="'/micrositio/'+micrositio.id">
              
              micrositio {{ index }}

              <button @click.prevent="deleteMicrositio(micrositio,index)" type="button" :disabled="form.busy" name="button">{{ (form.busy) ? 'Please wait...' : 'Delete'}}</button>
              
            </router-link>
              
            </li>
          </ul>
          
          <span v-else-if="!micrositios">Loading...</span>
          <span v-else>No micrositios exist</span>
          
        </div><!-- End 2nd half -->
        
      </div>
</template>

<script>
import { Form, HasError, AlertError } from 'vform'
export default {
  name: 'Micrositio',
  components: {HasError},
  data: function(){
    return {
      micrositios : false,
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
    this.listMicrositios();
  },
  methods: {
    listMicrositios: function(){
      
      var that = this;
      this.form.get('/api/micrositios').then(function(response){
        that.micrositios = response.data;
      })
      
    },
    createMicrositio: function(){
      
      var that = this;
      this.form.post('/api/micrositios').then(function(response){
        that.micrositios.push(response.data);
      })
      
    },
    deleteMicrositio: function(micrositio, index){
      
      var that = this;
      this.form.delete('/api/micrositios/'+micrositio.id).then(function(response){
        that.micrositios.splice(index,1);
      })
      
    }
  }
}
</script>

<style lang="less">
.micrositios{
    margin:0 auto;
    width:700px;
    display:flex;
    .half{
      flex:1;
      &:first-of-type{
        margin-right:20px;
      }
    }
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
        .invalid-feedback{
          color:red;
          &::first-letter{
            text-transform:capitalize;
          }
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
    }
}
</style>