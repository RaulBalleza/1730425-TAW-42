<template lang="html">
      <div class="ventahasproducts">
        
        <div class="half">
          
          <h1>Create ventahasproduct</h1>
          
          <form @submit.prevent="createVentahasproduct">
            
            <div class="form-group">
   
                  <input type="hidden" v-model="form.id"></input>
            </div>
            <div class="form-group">
                  <label>id_venta</label>
                  <input type="number" v-model="form.id_venta"></input>
                  <has-error :form="form" field="id_venta"></has-error>
            </div>
            <div class="form-group">
                  <label>id_product</label>
                  <input type="number" v-model="form.id_product"></input>
                  <has-error :form="form" field="id_product"></has-error>
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
          
          <h1>List ventahasproducts</h1>
          
          <ul v-if="ventahasproducts.length > 0">
            <li v-for="(ventahasproduct,index) in ventahasproducts" :key="ventahasproduct.id">
              
            <router-link :to="'/ventahasproduct/'+ventahasproduct.id">
              
              ventahasproduct {{ index }}

              <button @click.prevent="deleteVentahasproduct(ventahasproduct,index)" type="button" :disabled="form.busy" name="button">{{ (form.busy) ? 'Please wait...' : 'Delete'}}</button>
              
            </router-link>
              
            </li>
          </ul>
          
          <span v-else-if="!ventahasproducts">Loading...</span>
          <span v-else>No ventahasproducts exist</span>
          
        </div><!-- End 2nd half -->
        
      </div>
</template>

<script>
import { Form, HasError, AlertError } from 'vform'
export default {
  name: 'Ventahasproduct',
  components: {HasError},
  data: function(){
    return {
      ventahasproducts : false,
      form: new Form({
          "id" : "",
          "id_venta" : "",
          "id_product" : "",
          "created_at" : "",
          "updated_at" : "",
      })
    }
  },
  created: function(){
    this.listVentahasproducts();
  },
  methods: {
    listVentahasproducts: function(){
      
      var that = this;
      this.form.get('/api/ventahasproducts').then(function(response){
        that.ventahasproducts = response.data;
      })
      
    },
    createVentahasproduct: function(){
      
      var that = this;
      this.form.post('/api/ventahasproducts').then(function(response){
        that.ventahasproducts.push(response.data);
      })
      
    },
    deleteVentahasproduct: function(ventahasproduct, index){
      
      var that = this;
      this.form.delete('/api/ventahasproducts/'+ventahasproduct.id).then(function(response){
        that.ventahasproducts.splice(index,1);
      })
      
    }
  }
}
</script>

<style lang="less">
.ventahasproducts{
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