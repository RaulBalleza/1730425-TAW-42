<template>
    <div v-if="user_role == 'user'" class="card">
        <div class="card-header">
            <h5 class="card-title">
                <i class="fas fa-shopping-cart"></i> Carrito de compra
            </h5>
        </div>
        <div class="card-body" v-if="carrito.length > 0">
            <div v-for="(producto, index) in carrito" :key="index">
                <div class="media mb-3">
                    <div class="mr-2">
                        <div class="rounded vue-logo"></div>
                    </div>
                    <div class="media-body">
                        <strong class="d-block">{{ producto.nombre }}</strong
                        ><span
                            >Quantity: {{ producto.qty }} - ${{
                                producto.qty * producto.precio
                            }}</span
                        >
                    </div>
                    <div class="media-right align-middle">
                        <button
                            type="button"
                            aria-label="Remove"
                            class="close"
                            @click="deleteCart(producto)"
                        >
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                </div>
            </div>

            <ul class="list-group">
                <li class="list-group-item">
                    Subtotal ({{ carrito.length }} items): ${{ subtotal }}
                    <!---->
                </li>
                <li class="list-group-item">
                    Shipping:
                    <span> ${{ envio }}</span
                    ><!---->
                </li>
                <li class="list-group-item">
                    <strong>Total:</strong><strong> ${{ total }}</strong
                    ><!---->
                </li>
            </ul>
        </div>

        <div class="card-body">
            <p>Tu carrito está vacio, agrega productos.</p>
        </div>

        <div class="card-footer">
            <a href="#" class="btn btn-success"
                ><i class="fas fa-money-bill-alt"></i> Proceder al pago.</a
            >
        </div>
    </div>
</template>

<script>
export default {
    props: {
        carrito: Array
    },
    data() {
        return {
            envio: 60.0,
            user_role: false
        };
    },
    computed: {
        deleteCart() {},
        subtotal() {
            var subtotal = 0.0;
            if (this.carrito.length > 0) {
                this.carrito.forEach(item => {
                    console.log();
                    subtotal = subtotal + parseFloat(item.precio) * item.qty;
                });
            }
            return subtotal;
        },
        total() {
            var total = this.subtotal;
            total = total + this.envio;
            return total;
        }
    },

    mounted() {
        this.user_role = document
            .querySelector('meta[name="user-role"]')
            .getAttribute("content");
    },
    methods: {}
};
</script>
