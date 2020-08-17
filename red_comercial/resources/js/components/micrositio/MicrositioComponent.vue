<template>
    <div class="micrositio">
        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
            <div class="container">
                <a class="navbar-brand" href="#">{{ micrositio.nombre }}</a>
                <button
                    class="navbar-toggler"
                    type="button"
                    data-toggle="collapse"
                    data-target="#navbarResponsive"
                    aria-controls="navbarResponsive"
                    aria-expanded="false"
                    aria-label="Toggle navigation"
                >
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a
                                v-if="user_role == 'guest'"
                                class="nav-link"
                                href="/login"
                                >Login
                            </a>
                            <a v-else class="nav-link" href="#" @click="logout"
                                >Logout</a
                            >
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <div class="container">
            <!-- Heading Row -->
            <div class="row align-items-center my-5">
                <div class="col-lg-7">
                    <img
                        class="img-fluid rounded mb-4 mb-lg-0"
                        src="http://placehold.it/900x400"
                        alt=""
                    />
                </div>
                <!-- /.col-lg-8 -->
                <div class="col-lg-5">
                    <h1 class="font-weight-light">{{ micrositio.nombre }}</h1>
                    <p>
                        {{ micrositio.descripcion }}
                    </p>
                    <a class="btn btn-primary" href="#productos"
                        >Ver Productos</a
                    >
                </div>
                <!-- /.col-md-4 -->
            </div>
            <!-- /.row -->

            <div hidden>
                <div
                    id="carouselExampleIndicators"
                    class="carousel slide my-4"
                    data-ride="carousel"
                >
                    <ol class="carousel-indicators">
                        <li
                            data-target="#carouselExampleIndicators"
                            data-slide-to="0"
                            class="active"
                        ></li>
                        <li
                            data-target="#carouselExampleIndicators"
                            data-slide-to="1"
                        ></li>
                        <li
                            data-target="#carouselExampleIndicators"
                            data-slide-to="2"
                        ></li>
                    </ol>
                    <div class="carousel-inner" role="listbox">
                        <div class="carousel-item active">
                            <img
                                class="d-block img-fluid"
                                src="http://placehold.it/900x350"
                                alt="First slide"
                            />
                        </div>
                        <div class="carousel-item">
                            <img
                                class="d-block img-fluid"
                                src="http://placehold.it/900x350"
                                alt="Second slide"
                            />
                        </div>
                        <div class="carousel-item">
                            <img
                                class="d-block img-fluid"
                                src="http://placehold.it/900x350"
                                alt="Third slide"
                            />
                        </div>
                    </div>
                    <a
                        class="carousel-control-prev"
                        href="#carouselExampleIndicators"
                        role="button"
                        data-slide="prev"
                    >
                        <span
                            class="carousel-control-prev-icon"
                            aria-hidden="true"
                        ></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a
                        class="carousel-control-next"
                        href="#carouselExampleIndicators"
                        role="button"
                        data-slide="next"
                    >
                        <span
                            class="carousel-control-next-icon"
                            aria-hidden="true"
                        ></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>

            <!-- Content Row -->
            <div class="row">
                <div id="productos" class="col-8">
                    <div class="row" v-if="products.length > 0">
                        <div
                            class="col-lg-4 col-md-6 mb-4"
                            v-for="(product, index) in products"
                            :position="product.id"
                        >
                            <div class="card h-100">
                                <a href="#"
                                    ><img
                                        class="card-img-top"
                                        src="http://placehold.it/700x400"
                                        alt=""
                                /></a>
                                <div class="card-body">
                                    <h4 class="card-title">
                                        <a href="#">{{ product.nombre }}</a>
                                    </h4>
                                    <h5>${{ product.precio }}</h5>
                                    <p class="card-text">
                                        Stock: {{ product.stock }}
                                    </p>
                                    <p class="card-text">
                                        Descripcion: {{ product.descripcion }}
                                    </p>
                                </div>
                                <div class="card-footer">
                                    <div class="row">
                                        <a
                                            class="btn btn-sm btn-primary float-right"
                                            @click="addToCart(product)"
                                            ><i class="fas fa-cart-plus"></i>
                                            Añadir al carrito.</a
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div id="productos" class="col-8">
                        <div class="row" v-if="servicios.length > 0">
                            <div
                                class="col-lg-4 col-md-6 mb-4"
                                v-for="(product, index) in servicios"
                                :position="product.id"
                            >
                                <div class="card h-100">
                                    <a href="#"
                                        ><img
                                            class="card-img-top"
                                            src="http://placehold.it/700x400"
                                            alt=""
                                    /></a>
                                    <div class="card-body">
                                        <h4 class="card-title">
                                            <a href="#">{{ product.nombre }}</a>
                                        </h4>
                                        <h5>${{ product.precio }}</h5>
                                        <p class="card-text">
                                            Stock: {{ product.stock }}
                                        </p>
                                        <p class="card-text">
                                            Descripcion:
                                            {{ product.descripcion }}
                                        </p>
                                    </div>
                                    <div class="card-footer">
                                        <div class="row">
                                            <a
                                                class="btn btn-sm btn-primary float-right"
                                                @click="addToCart(product)"
                                                ><i
                                                    class="fas fa-cart-plus"
                                                ></i>
                                                Añadir al carrito.</a
                                            >
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

                <div class="col-4">
                    <checkout-component :carrito="carrito"></checkout-component>
                </div>
            </div>
        </div>
        <!-- /.container -->

        <!-- Footer -->
        <footer class="py-5 bg-dark">
            <div class="container">
                <p class="m-0 text-center text-white">
                    Copyright &copy; raulballeza.tech 2020
                </p>
            </div>
            <!-- /.container -->
        </footer>
    </div>
</template>

<style lang="less">
.shop {
    display: flex;
    width: 100%;
}
.productos {
    width: 70%;
    height: 100%;
}

.carrito {
    width: 30%;
    height: 100vh;
}
</style>
<script>
export default {
    props: {
        id: Number
    },
    data() {
        return {
            user_role: false,
            idm: false,
            loaded: false,
            micrositio: false,
            servicios: false,
            products: false,
            carrito: []
        };
    },

    mounted() {
        //alert(this.id);
        this.getMicrositio();
        this.listProducts();
        this.listServicios();
        this.user_role = document
            .querySelector('meta[name="user-role"]')
            .getAttribute("content");
    },
    methods: {
        logout() {
            this.axios
                .post("/logout")
                .then(response => {
                    if (response.status === 302 || 401) {
                        //console.log("logout");
                        window.location = "/";
                    } else {
                        // throw error and go to catch block
                    }
                })
                .catch(error => {});
        },
        addToCart(product) {
            if (this.user_role == "guest") {
                alert("¡Logueate para poder comprar!. :)");
            } else {
                var index = this.carrito.indexOf(product);
                if (index >= 0) {
                    product.qty = this.carrito[index].qty + 1;
                    this.carrito.push(product);
                    this.carrito.splice(index, 1);
                } else {
                    product.qty = 1;
                    this.carrito.push(product);
                }
            }
            //this.carrito.push(product);
        },
        wow() {
            let vm = this;
            alert(vm.id);
        },
        listProducts() {
            var that = this;
            var idm = this.id;
            this.axios
                .get("/api/" + idm + "/products")
                .then(function(response) {
                    that.products = response.data;
                });
        },

        listServicios() {
            var that = this;
            var idm = this.id;
            this.axios
                .get("/api/" + idm + "/servicios")
                .then(function(response) {
                    that.servicios = response.data;
                });
        },

        getMicrositio() {
            var that = this;
            var idm = this.id;
            this.axios
                .get("/api/micrositios/" + idm)
                .then(function(response) {
                    that.micrositio = response.data;
                    that.loaded = true;
                })
                .catch(function(e) {
                    if (e.response && e.response.status == 404) {
                        0;
                        that.$router.push("/404");
                    }
                });
        }
    }
};
</script>
