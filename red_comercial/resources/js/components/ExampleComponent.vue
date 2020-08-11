<template>
        <div>
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
                            <a class="nav-link" href="#"
                                >Home
                                <span class="sr-only">(current)</span>
                            </a>
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
                    <a class="btn btn-primary" href="#">Call to Action!</a>
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
            <div class="shop" v-if="products.length > 0">
                <div class="row">
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
                                    {{ product.descripcion }}
                                </p>
                            </div>
                            <div class="card-footer">
                                <small class="text-muted"
                                    >&#9733; &#9733; &#9733; &#9733;
                                    &#9734;</small
                                >
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->

        <!-- Footer -->
        <footer class="py-5 bg-dark fixed-bottom">
            <div class="container">
                <p class="m-0 text-center text-white">
                    Copyright &copy; Your Website 2020
                </p>
            </div>
            <!-- /.container -->
        </footer>
    </div>
</template>

<script>
export default {
    props: {
        id: Number
    },
    data() {
        return {};
    },
    mounted() {
        alert(this.id);
    },
    methods: {}
};
</script>
<script>
export default {
    props: {
        id: Number
    },
    data() {
        return {
            idm: false,
            loaded: false,
            micrositio: false,
            products: false
        };
    },

    mounted() {
        alert(this.id);
        this.getMicrositio();
        this.listProducts();
    },
    methods: {
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
