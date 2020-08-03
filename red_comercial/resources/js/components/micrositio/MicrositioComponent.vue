<template>
  <div v-if="loaded">
    <h1>{{micrositio.nombre}}</h1>
    <h2>{{micrositio.descripcion}}</h2>
  </div>
</template>

<script>
export default {
  data() {
    return {
      loaded: false,
      micrositio: false,
    };
  },
  mounted() {
    this.getMicrositio();
  },
  methods: {
    getMicrositio() {
      var that = this;
      this.axios
        .get("/api/micrositios/" + this.$route.params.id)
        .then(function (response) {
          that.micrositio = response.data;
          that.loaded = true;
        })
        .catch(function (e) {
          if (e.response && e.response.status == 404) {
            0;
            that.$router.push("/404");
          }
        });
    },
  },
};
</script>