<template>
    <div class="container">
        <div>
            <div>
                <!-- Page Heading -->
                <h1 class="h3 mb-2 text-gray-800">Micrositios</h1>
                <p class="mb-4">Listado de los Micrositios.</p>
                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h2 class="m-0 font-weight-bold text-primary">
                            Tabla de Micrositios
                        </h2>
                        <button
                            v-if="user_role == 'Admin'"
                            type="button"
                            class="btn btn-primary btn-sm"
                            data-toggle="modal"
                            data-target="#exampleModal"
                        >
                            Nuevo Micrositio
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table
                                class="table table-bordered"
                                id="dataTable"
                                width="100%"
                                cellspacing="0"
                            >
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Descripcion</th>
                                        <th>URL</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Descripcion</th>
                                        <th>URL</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </tfoot>
                                <tbody v-if="micrositios.length > 0">
                                    <tr
                                        v-for="(micrositio,
                                        index) in micrositios"
                                        :key="micrositio.id"
                                    >
                                        <td>
                                            <router-link
                                                :to="
                                                    '/admin/micrositio/' +
                                                        micrositio.id
                                                "
                                                >{{
                                                    micrositio.id
                                                }}</router-link
                                            >
                                        </td>
                                        <td>{{ micrositio.nombre }}</td>
                                        <td>{{ micrositio.descripcion }}</td>
                                        <td>{{ micrositio.url }}</td>
                                        <td>{{ micrositio.estado }}</td>
                                        <td>
                                            <div class="row">
                                                <router-link
                                                    :to="
                                                        '/micrositio/' +
                                                            micrositio.id
                                                    "
                                                >
                                                    <button
                                                        class="btn btn-primary btn-sm"
                                                        type="button"
                                                        :disabled="form.busy"
                                                        name="button"
                                                    >
                                                        <i
                                                            class="fas fa-edit"
                                                        ></i>
                                                        {{
                                                            form.busy
                                                                ? "Please wait..."
                                                                : "Ver Sitio"
                                                        }}
                                                    </button>
                                                </router-link>
                                                <router-link
                                                    :to="
                                                        '/admin/' +
                                                            micrositio.id +
                                                            '/servicios'
                                                    "
                                                >
                                                    <button
                                                        class="btn btn-warning btn-sm"
                                                        type="button"
                                                        :disabled="form.busy"
                                                        name="button"
                                                    >
                                                        <i
                                                            class="fas fa-edit"
                                                        ></i>
                                                        {{
                                                            form.busy
                                                                ? "Please wait..."
                                                                : "Ver Servicios"
                                                        }}
                                                    </button>
                                                </router-link>
                                                <router-link
                                                    :to="
                                                        '/admin/' +
                                                            micrositio.id +
                                                            '/products'
                                                    "
                                                >
                                                    <button
                                                        class="btn btn-success btn-sm"
                                                        type="button"
                                                        :disabled="form.busy"
                                                        name="button"
                                                    >
                                                        <i
                                                            class="fas fa-edit"
                                                        ></i>
                                                        {{
                                                            form.busy
                                                                ? "Please wait..."
                                                                : "Ver Productos"
                                                        }}
                                                    </button>
                                                </router-link>
                                                <router-link
                                                    :to="
                                                        '/admin/' +
                                                            micrositio.id +
                                                            '/categorias'
                                                    "
                                                >
                                                    <button
                                                        class="btn btn-info btn-sm"
                                                        type="button"
                                                        :disabled="form.busy"
                                                        name="button"
                                                    >
                                                        <i
                                                            class="fas fa-edit"
                                                        ></i>
                                                        {{
                                                            form.busy
                                                                ? "Please wait..."
                                                                : "Ver Categorias"
                                                        }}
                                                    </button>
                                                </router-link>
                                            </div>
                                            <div class="row">
                                                <button
                                                    @click.prevent="
                                                        deleteMicrositio(
                                                            micrositio,
                                                            index
                                                        )
                                                    "
                                                    type="button"
                                                    class="btn btn-danger btn-sm"
                                                    :disabled="form.busy"
                                                    name="button"
                                                >
                                                    <i class="fas fa-trash"></i>
                                                    {{
                                                        form.busy
                                                            ? "Please wait..."
                                                            : "Eliminar"
                                                    }}
                                                </button>
                                                <router-link
                                                    :to="
                                                        '/admin/micrositio/' +
                                                            micrositio.id
                                                    "
                                                >
                                                    <button
                                                        class="btn btn-primary btn-sm"
                                                        type="button"
                                                        :disabled="form.busy"
                                                        name="button"
                                                    >
                                                        <i
                                                            class="fas fa-edit"
                                                        ></i>
                                                        {{
                                                            form.busy
                                                                ? "Please wait..."
                                                                : "Editar"
                                                        }}
                                                    </button>
                                                </router-link>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End first half -->

        <div hidden class="half">
            <h1>List micrositios</h1>

            <ul v-if="micrositios.length > 0">
                <li
                    v-for="(micrositio, index) in micrositios"
                    :key="micrositio.id"
                >
                    <router-link :to="'/admin/micrositio/' + micrositio.id">
                        micrositio {{ index }}
                        <button
                            @click.prevent="deleteMicrositio(micrositio, index)"
                            type="button"
                            :disabled="form.busy"
                            name="button"
                        >
                            {{ form.busy ? "Please wait..." : "Delete" }}
                        </button>
                    </router-link>
                    <router-link :to="'/' + micrositio.id + '/micrositios/'">
                        <button>
                            {{
                                form.busy ? "Please wait..." : "Ver Micrositios"
                            }}
                        </button>
                    </router-link>
                    <router-link :to="'/' + micrositio.id + '/servicios/'">
                        <button>
                            {{ form.busy ? "Please wait..." : "Ver servicios" }}
                        </button>
                    </router-link>
                </li>
            </ul>

            <span v-else-if="!micrositios">Loading...</span>
            <span v-else>No micrositios exist</span>
        </div>
        <!-- End 2nd half -->

        <div class="micrositios">
            <!-- Modal -->
            <div
                class="modal fade"
                id="exampleModal"
                tabindex="-1"
                role="dialog"
                aria-labelledby="exampleModalLabel"
                aria-hidden="true"
            >
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">
                                Modal title
                            </h5>
                            <button
                                type="button"
                                class="close"
                                data-dismiss="modal"
                                aria-label="Close"
                            >
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form @submit.prevent="createMicrositio" id="form">
                            <div class="modal-body">
                                <div class="form-group">
                                    <input type="hidden" v-model="form.id" />
                                </div>
                                <div class="form-group">
                                    <label>nombre</label>
                                    <input
                                        type="text"
                                        v-model="form.nombre"
                                        maxlength="255"
                                    />
                                    <has-error
                                        :form="form"
                                        field="nombre"
                                    ></has-error>
                                </div>

                                <div class="form-group">
                                    <label>descripcion</label>
                                    <input
                                        type="text"
                                        v-model="form.descripcion"
                                        maxlength="255"
                                    />
                                    <has-error
                                        :form="form"
                                        field="descripcion"
                                    ></has-error>
                                </div>
                                <div class="form-group">
                                    <label>url</label>
                                    <input
                                        type="text"
                                        v-model="form.url"
                                        maxlength="255"
                                    />
                                    <has-error
                                        :form="form"
                                        field="url"
                                    ></has-error>
                                </div>
                                <div class="form-group" hidden>
                                    <label>logo</label>
                                    <input type="number" v-model="form.logo" />
                                    <has-error
                                        :form="form"
                                        field="logo"
                                    ></has-error>
                                </div>
                                <div class="form-group" hidden>
                                    <label>latitud</label>
                                    <input
                                        type="text"
                                        v-model="form.latitud"
                                        maxlength="255"
                                    />
                                    <has-error
                                        :form="form"
                                        field="latitud"
                                    ></has-error>
                                </div>
                                <div class="form-group" hidden>
                                    <label>longitud</label>
                                    <input
                                        type="text"
                                        v-model="form.longitud"
                                        maxlength="255"
                                    />
                                    <has-error
                                        :form="form"
                                        field="longitud"
                                    ></has-error>
                                </div>
                                <div
                                    class="form-group"
                                    v-if="user_role == 'Admin'"
                                >
                                    <label>estado</label>
                                    <select
                                        v-model="form.estado"
                                        class="form-control"
                                    >
                                        <option
                                            value="Activo"
                                            selected="selected"
                                            >Activo</option
                                        >
                                        <option value="Inactivo"
                                            >Inactivo</option
                                        >
                                    </select>
                                    <has-error
                                        :form="form"
                                        field="estado"
                                    ></has-error>
                                </div>
                                <div class="form-group">
                                    <input
                                        type="hidden"
                                        v-model="form.created_at"
                                    />
                                </div>
                                <div class="form-group">
                                    <input
                                        type="hidden"
                                        v-model="form.updated_at"
                                    />
                                </div>
                                <div class="form-group">
                                    <label>direccion</label>
                                    <input
                                        disabled
                                        type="text"
                                        v-model="form.direccion"
                                        maxlength="255"
                                    />
                                    <has-error
                                        :form="form"
                                        field="direccion"
                                    ></has-error>
                                </div>
                            </div>

                            <div class="google-map" ref="googleMap">
                                <maps-component
                                    v-on:childToParent="onChildClick"
                                />
                            </div>
                            <div class="modal-footer">
                                <button
                                    type="btn btn-sm btn-danger"
                                    class="btn btn-secondary"
                                    data-dismiss="modal"
                                    id="closeM"
                                >
                                    Close
                                </button>
                                <button
                                    hidden
                                    class="btn btn-sm btn-primary"
                                    type="submit"
                                    :disabled="form.busy"
                                    name="button"
                                >
                                    {{
                                        form.busy
                                            ? "Please wait..."
                                            : "Registrar"
                                    }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import BrowserComponent from "../BrowserComponent.vue";

import { Form, HasError, AlertError } from "vform";
export default {
    name: "Micrositio",
    components: { HasError, BrowserComponent },
    data() {
        return {
            messaged: "0",
            user_id: false,
            user_role: false,
            micrositios: false,
            loaded: false,
            form: new Form({
                id: "",
                nombre: "",
                direccion: "",
                descripcion: "",
                url: "",
                estado: "Inactivo",
                logo: "1",
                latitud: "",
                longitud: "",
                created_at: "",
                updated_at: ""
            })
        };
    },
    created() {
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
            /*console.log(
                "DIRECCION: " +
                    this.form.address +
                    "\n" +
                    "LATITUD: " +
                    this.form.latitude +
                    "\n" +
                    "LONGITUD: " +
                    this.form.longitude +
                    "\n"
            );*/
            this.createMicrositio();
        },
        getuser_role: function(id) {
            var that = this;
            this.axios.get("/api/roles/user/" + id).then(function(response) {
                that.user_role = response.data;
                that.listMicrositios();
            });
        },
        listMicrositios() {
            var that = this;
            if (that.user_role == "Admin") {
                this.form.get("/api/micrositios").then(function(response) {
                    that.micrositios = response.data;
                    //console.log(that.user_role);
                    that.loaded = true;
                });
            } else {
                this.form
                    .get("/api/micrositios/user/" + that.user_id)
                    .then(function(response) {
                        that.micrositios = response.data;
                        //console.log(that.user_role);
                        that.loaded = true;
                    });
            }
        },
        createMicrositio() {
            var that = this;
            this.form
                .post("/api/micrositios")
                .then(function(response) {
                    that.micrositios.push(response.data);
                    that.getLastMicrositioID();
                })
                .then(() => {
                    document.getElementById("closeM").click();
                    document.getElementById("form").reset();
                });
        },
        getLastMicrositioID() {
            var that = this;
            this.axios
                .get("/api/micrositios/url/" + that.form.url)
                .then(function(response) {
                    console.log("RESPUESTA: " + response.data);
                    that.createClientehasmicrositio(response.data);
                });
        },
        createClientehasmicrositio: function(micrositio_id) {
            var that = this;
            console.log("MICROSITIO: " + micrositio_id);
            this.axios
                .post("/api/clientehasmicrositios", {
                    id_user: that.user_id,
                    id_micrositio: micrositio_id
                })
                .then(function(response) {
                    console.log(response);
                });
        },
        deleteMicrositio: function(micrositio, index) {
            var that = this;
            this.form
                .delete("/api/micrositios/" + micrositio.id)
                .then(function(response) {
                    that.micrositios.splice(index, 1);
                });
        }
    }
};
</script>

<style lang="less">
.micrositios {
    margin: 0 auto;
    width: 700px;
    display: flex;
    .half {
        flex: 1;
        &:first-of-type {
            margin-right: 20px;
        }
    }
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
            .invalid-feedback {
                color: red;
                &::first-letter {
                    text-transform: capitalize;
                }
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
    }
}
</style>
