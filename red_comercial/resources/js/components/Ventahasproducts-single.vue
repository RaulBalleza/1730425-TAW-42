<template lang="html">
      <div class="VentahasproductSingle">
        <h1>Update Ventahasproduct</h1>
        
        <form @submit.prevent="updateVentahasproduct" v-if="loaded">
          
          <router-link to="/ventahasproducts">< Back to ventahasproducts</router-link>
          
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
              <button class="button" type="submit" :disabled="form.busy" name="button">{{ (form.busy) ? 'Please wait...' : 'Update'}}</button>
              <button @click.prevent="deleteVentahasproduct">{{ (form.busy) ? 'Please wait...' : 'Delete'}}</button>
          </div>
        </form>
        
        <span v-else>Loading ventahasproduct...</span>
      </div>
</template>

<script>
import { Form, HasError, AlertError } from 'vform'
export default {
  name: 'Ventahasproduct',
  components: {HasError},
  data: function(){
    return {
      loaded: false,
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
    this.getVentahasproduct();
  },
  methods: {
    getVentahasproduct: function(Ventahasproduct){
      
      var that = this;
      this.form.get('/api/ventahasproducts/'+this.$route.params.id).then(function(response){
        that.form.fill(response.data);
        that.loaded = true;
      }).catch(function(e){
          if (e.response && e.response.status == 404) {
              that.$router.push('/404');
          }
      });
      
    },
    updateVentahasproduct: function(){
      
      var that = this;
      this.form.put('/api/ventahasproducts/'+this.$route.params.id).then(function(response){
        that.form.fill(response.data);
      })
      
    },
    deleteVentahasproduct: function(){
      
      var that = this;
      this.form.delete('/api/ventahasproducts/'+this.$route.params.id).then(function(response){
        that.form.fill(response.data);
        that.$router.push('/ventahasproducts');
      })
      
    }
  }
}
</script>

<style lang="less">
.VentahasproductSingle{
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