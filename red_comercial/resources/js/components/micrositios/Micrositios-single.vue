<template>
    <div class="MicrositioSingle">
        <h1>Update Micrositio</h1>
        <div v-if="loaded">
            <form @submit.prevent="updateMicrositio">
                <router-link to="/admin/micrositios"
                    >< Back to micrositios</router-link
                >

                <div class="form-group">
                    <input type="hidden" v-model="form.id" />
                </div>
                <div class="form-group">
                    <label>nombre</label>
                    <input type="text" v-model="form.nombre" maxlength="255" />
                    <has-error :form="form" field="nombre"></has-error>
                </div>
                <div class="form-group">
                    <label>direccion</label>
                    <input
                        type="text"
                        v-model="form.direccion"
                        maxlength="255"
                        disabled
                    />
                    <has-error :form="form" field="direccion"></has-error>
                </div>
                <div class="form-group">
                    <label>descripcion</label>
                    <input
                        type="text"
                        v-model="form.descripcion"
                        maxlength="255"
                    />
                    <has-error :form="form" field="descripcion"></has-error>
                </div>
                <div class="form-group">
                    <label>url</label>
                    <input type="text" v-model="form.url" maxlength="255" :disabled="user_role!='Admin'"/>
                    <has-error :form="form" field="url"></has-error>
                </div>
                <div class="form-group">
                    <label>estado</label>
                    <select v-model="form.estado" class="form-control" :disabled="user_role!='Admin'">
                        <option value="Activo" selected="selected"
                            >Activo</option
                        >
                        <option value="Inactivo">Inactivo</option>
                    </select>
                    <has-error :form="form" field="estado"></has-error>
                </div>
                <div class="form-group" hidden>
                    <label>logo</label>
                    <input type="number" v-model="form.logo" />
                    <has-error :form="form" field="logo"></has-error>
                </div>
                <div class="form-group" hidden>
                    <label>latitud</label>
                    <input type="text" v-model="form.latitud" maxlength="255" />
                    <has-error :form="form" field="latitud"></has-error>
                </div>
                <div class="form-group" hidden>
                    <label>longitud</label>
                    <input
                        type="text"
                        v-model="form.longitud"
                        maxlength="255"
                    />
                    <has-error :form="form" field="longitud"></has-error>
                </div>
                <div class="form-group">
                    <input type="hidden" v-model="form.created_at" />
                </div>
                <div class="form-group">
                    <input type="hidden" v-model="form.updated_at" />
                </div>

                <div class="form-group">
                    <button
                        class="btn btn-sm btn-danger"
                        @click.prevent="deleteMicrositio"
                    >
                        {{ form.busy ? "Please wait..." : "Delete" }}
                    </button>
                    <button
                        class="btn btn-sm btn-primary"
                        type="submit"
                        :disabled="form.busy"
                        name="button"
                    >
                        {{ form.busy ? "Please wait..." : "Update" }}
                    </button>
                </div>
            </form>

            <div class="google-map" ref="googleMap">
                <maps-component
                    :coords="coords"
                    v-on:childToParent="onChildClick"
                />
            </div>
        </div>

        <span v-else>Loading micrositio...</span>
    </div>
</template>

<script>
import BrowserComponent from "../BrowserComponent.vue";

import { Form, HasError, AlertError } from "vform";
export default {
    name: "Micrositio",
    components: { HasError, BrowserComponent },
    data: function() {
        return {
            loaded: false,
            user_role: false,
            coords: { lat: 0, lng: 0 },
            form: new Form({
                id: "",
                nombre: "",
                direccion: "",
                descripcion: "",
                url: "",
                estado: "",
                logo: "",
                latitud: "",
                longitud: "",
                created_at: "",
                updated_at: ""
            })
        };
    },
    created: function() {
        this.getMicrositio();

        this.user_id = document
            .querySelector('meta[name="user-id"]')
            .getAttribute("content");
        this.getuser_role(this.user_id);
    },
    methods: {
        onChildClick(value) {
            this.form.direccion = value.formatted_address;
            this.form.latitud = value.geometry.location.lat();
            this.form.longitud = value.geometry.location.lng();
            console.log(
                "DIRECCION: " +
                    this.form.address +
                    "\n" +
                    "LATITUD: " +
                    this.form.latitude +
                    "\n" +
                    "LONGITUD: " +
                    this.form.longitude +
                    "\n"
            );
            this.updateMicrositio();
        },
        getuser_role: function(id) {
            var that = this;
            this.axios.get("/api/roles/user/" + id).then(function(response) {
                that.user_role = response.data;
            });
        },
        getMicrositio: function(Micrositio) {
            var that = this;
            this.form
                .get("/api/micrositios/" + this.$route.params.id)
                .then(function(response) {
                    that.form.fill(response.data);
                    that.loaded = true;
                    that.coords = {
                        lat: that.form.latitud,
                        lng: that.form.longitud
                    };
                })
                .catch(function(e) {
                    if (e.response && e.response.status == 404) {
                        that.$router.push("/404");
                    }
                });
        },
        updateMicrositio: function() {
            var that = this;
            this.form
                .put("/api/micrositios/" + this.$route.params.id)
                .then(function(response) {
                    that.form.fill(response.data);
                });
        },
        deleteMicrositio: function() {
            var that = this;
            this.form
                .delete("/api/micrositios/" + this.$route.params.id)
                .then(function(response) {
                    that.form.fill(response.data);
                    that.$router.push("/micrositios");
                });
        }
    }
};
</script>

<style lang="less">
.MicrositioSingle {
    margin: 0 auto;
    width: 700px;
    form {
        .form-group {
            margin-bottom: 20px;
            label {
                display: block;
                margin-bottom: 5px;
                text-transform: capitalize;
            }
            input[type="text"],
            input[type="number"],
            textarea {
                width: 100%;
                max-width: 100%;
                min-width: 100%;
                padding: 10px;
                border-radius: 3px;
                border: 1px solid silver;
                font-size: 1rem;
                &:focus {
                    outline: 0;
                    border-color: blue;
                }
            }
            .button {
                appearance: none;
                background: #3bdfd9;
                font-size: 1rem;
                border: 0px;
                padding: 10px 20px;
                border-radius: 3px;
                font-weight: bold;
                &:hover {
                    cursor: pointer;
                    background: darken(#3bdfd9, 10);
                }
            }
            .invalid-feedback {
                color: red;
                &::first-letter {
                    text-transform: capitalize;
                }
            }
        }
    }
}
</style>
