<template>
  <div>
  <button type="button" class="btn btn-primary">
  Ver carrito <span class="badge badge-light">9</span>
  <span class="sr-only">unread messages</span>
</button>
  </div>
</template>

<script>
export default {
  data() {
    return {
        productos:false
    };
  },
  mounted() {
    console.log("CartComponent mounted.");
  },
  methods: {
  },
};
</script>