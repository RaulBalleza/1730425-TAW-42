<template>
    <div class="browser">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
            <div class="container">
                <a class="navbar-brand" href="#">Buscador</a>
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
                            <a v-else class="nav-link" href="/" @click="logout"
                                >Logout</a
                            >
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="left">
            <div style="width:100%">
                <h4>Buscador:</h4>
                <input
                    style="width:100%"
                    v-on:input="showResults($event)"
                    id="search"
                    type="text"
                    v-model="search"
                    placeholder="Busque Tienda, producto o servicio"
                />
            </div>
            <div v-if="resultsM.length > 0">
                <h5>Tiendas</h5>
                <ul
                    id="myUL"
                    v-for="(result, index) in resultsM"
                    :position="result.id"
                >
                    <li v-if="result.estado == 'Activo'">
                        <a
                            >{{ result.nombre }}
                            <button
                                @click="locate(result.latitud, result.longitud)"
                                class="btn btn-primary btn-sm"
                            >
                                Ver en mapa
                            </button>
                        </a>
                    </li>
                </ul>
            </div>

            <div v-if="resultsP.length > 0">
                <h5>Productos</h5>
                <ul
                    id="myUL"
                    v-for="(result, index) in resultsP"
                    :position="result.id"
                >
                    <li>
                        <a
                            >{{ result.nombre }}
                            <button
                                @click="locate(result.latitud, result.longitud)"
                                class="btn btn-primary btn-sm"
                            >
                                Ver tienda en mapa
                            </button>
                        </a>
                    </li>
                </ul>
            </div>

            <div v-if="resultsS.length > 0">
                <h5>Servicios</h5>
                <ul
                    id="myUL"
                    v-for="(result, index) in resultsS"
                    :position="result.id"
                >
                    <li>
                        <a
                            >{{ result.nombre }}
                            <button
                                @click="locate(result.latitud, result.longitud)"
                                class="btn btn-primary btn-sm"
                            >
                                Ver tienda en mapa
                            </button>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="right">
            <gmap-map
                :center="center"
                style="width:100%;  height: 100vh;"
                :zoom="5"
                ref="gmap"
            >
                <gmap-marker
                    :key="index"
                    v-for="(m, index) in markers"
                    :position="m.position"
                    @click="toggleInfoWindow(m, index)"
                ></gmap-marker>
                <gmap-info-window
                    :options="infoOptions"
                    :position="infoWindowPos"
                    :opened="infoWinOpen"
                    @closeclick="infoWinOpen = false"
                >
                    <div v-html="infoContent"></div>
                </gmap-info-window>
            </gmap-map>
        </div>
    </div>
</template>

<script>
export default {
    name: "GoogleMap",
    data() {
        return {
            // default to Montreal to keep it simple
            // change this to whatever makes sense
            infoContent: "",
            infoWindowPos: {
                lat: 0,
                lng: 0
            },
            infoWinOpen: false,
            infoOptions: {
                pixelOffset: {
                    width: 0,
                    height: -35
                }
            },
            map: null,
            currentMidx: null,
            search: "",
            resultsM: false,
            resultsP: false,
            resultsS: false,
            products: false,
            servicios: false,
            micrositios: false,
            loaded: false,
            center: { lat: 22.7317819, lng: -98.9766827 },
            markers: [],
            places: [],
            currentPlace: null,
            user_role: false
        };
    },

    mounted() {
        this.$refs.gmap.$mapPromise.then(map => {
            const bounds = new google.maps.LatLngBounds();
            for (let m of this.markers) {
                bounds.extend(m.position);
            }
            map.fitBounds(bounds);
        });
        this.listMicrositios();
        this.listProducts();
        this.listServicios();
        this.geolocate();
        this.showResults();
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
        showResults() {
            var that = this;
            //console.log(that.search);
            if (that.search === "") {
                //   that.micrositios.forEach(function(item){
                //     that.resultsM.push(item);
                // })
                that.resultsM = that.micrositios;

                that.resultsP = false;
                that.resultsS = false;
            } else {
                that.resultsM = [];
                that.resultsP = [];
                that.resultsS = [];
                that.micrositios.forEach(function(item) {
                    if (
                        item.nombre
                            .toUpperCase()
                            .includes(that.search.toUpperCase())
                    ) {
                        //console.log("LO CONTIENE" + item.nombre);
                        that.resultsM.push(item);
                    }
                });

                that.products.forEach(function(item) {
                    if (
                        item.nombre
                            .toUpperCase()
                            .includes(that.search.toUpperCase())
                    ) {
                        //console.log("LO CONTIENE" + item.nombre);
                        var ms = that.micrositios.find(
                            micrositio => micrositio.id == item.id_micrositio
                        );
                        item.latitud = ms.latitud;
                        item.longitud = ms.longitud;
                        that.resultsP.push(item);
                    }
                });

                that.servicios.forEach(function(item) {
                    if (
                        item.nombre
                            .toUpperCase()
                            .includes(that.search.toUpperCase())
                    ) {
                        //console.log("LO CONTIENE" + item.nombre);

                        var ms = that.micrositios.find(
                            micrositio => micrositio.id == item.id_micrositio
                        );
                        console.log(ms);
                        item.latitud = ms.latitud;
                        item.longitud = ms.longitud;
                        that.resultsS.push(item);
                    }
                });
            }

            console.log(that.resultsM);
        },
        listServicios() {
            var that = this;
            this.axios.get("/api/servicios").then(function(response) {
                that.servicios = response.data;
                //that.resultsS = that.servicios;
            });
        },
        listProducts() {
            var that = this;
            this.axios.get("/api/products").then(function(response) {
                that.products = response.data;
                //that.resultsP = that.products;
            });
        },
        toggleInfoWindow: function(marker, idx) {
            this.infoWindowPos = marker.position;
            this.infoContent = this.getInfoWindowContent(marker);

            //check if its the same marker that was selected if yes toggle
            if (this.currentMidx == idx) {
                this.infoWinOpen = !this.infoWinOpen;
            }
            //if different marker set infowindow to open and reset current marker index
            else {
                this.infoWinOpen = true;
                this.currentMidx = idx;
            }
        },

        getInfoWindowContent: function(marker) {
            var that = this;
            return `<div class="card">
  <div class="card-content">
    <div class="media">
      <div class="media-content">
        <h3>${marker.name}</h3>
      </div>
    </div>
    <div class="content">
    <h6>
      ${marker.description}</h6>
      <br>
      <a href="/micrositio/${marker.ms_url}/" class="btn btn-sm btn-primary ">Ver micrositio</a>

    </div>
  </div>
</div>`;
        },
        // receives a place object via the autocomplete component
        locate(latitud, longitud) {
            this.center = {
                lat: parseFloat(latitud),
                lng: parseFloat(longitud)
            };
        },
        initMarkers(ms) {
            const marker = {
                lat: parseFloat(ms.latitud),
                lng: parseFloat(ms.longitud)
            };

            this.markers.push({
                name: ms.nombre,
                description: ms.descripcion,
                ms_url: ms.url,
                position: marker
            });
        },
        listMicrositios() {
            var that = this;
            this.axios.get("/api/micrositios").then(function(response) {
                that.micrositios = response.data;
                that.micrositios.forEach(function(micrositio) {
                    //console.log(micrositio.latitud);
                    if (micrositio.estado == "Activo") {
                        that.initMarkers(micrositio);
                    }
                });
                that.loaded = true;
                that.resultsM = that.micrositios;
            });
        },
        setPlace(place) {
            this.currentPlace = place;
        },
        addMarker() {
            if (this.currentPlace) {
                const marker = {
                    lat: this.currentPlace.geometry.location.lat(),
                    lng: this.currentPlace.geometry.location.lng()
                };
                this.markers.push({ position: marker });
                this.places.push(this.currentPlace);
                this.center = marker;
                this.currentPlace = null;
            }
        },
        geolocate() {
            navigator.geolocation.getCurrentPosition(position => {
                this.center = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };
            });
        }
    }
};
</script>

<style>
.browser {
    margin-top: 30px;
    display: flex;
    width: 100%;
}

.left {
    width: 30%;
    height: 100%;
}

.right {
    width: 70%;
}

.vue-map-container {
    width: 100%;
    height: 100%;
}

* {
    box-sizing: border-box;
}

#myInput {
    /*background-image: url('/css/searchicon.png');*/
    background-position: 10px 12px;
    background-repeat: no-repeat;
    width: 100%;
    font-size: 16px;
    padding: 12px 20px 12px 40px;
    border: 1px solid #ddd;
    margin-bottom: 12px;
}

#myUL {
    list-style-type: none;
    padding: 0;
    margin: 0;
}

#myUL li a {
    border: 1px solid #ddd;
    margin-top: -1px; /* Prevent double borders */
    background-color: #f6f6f6;
    padding: 12px;
    text-decoration: none;
    font-size: 18px;
    color: black;
    display: block;
}

#myUL li a:hover:not(.header) {
    background-color: #eee;
}
</style>
