import Home from "./components/HomeComponent.vue";
import ExampleComponent from "./components/ExampleComponent.vue";
import BrowserComponent from "./components/BrowserComponent.vue";
//Vistas de clientes
import ClientesList from "./components/clientes/Clientes-list.vue";
import ClientesEditar from "./components/clientes/Clientes-single.vue";
//Vistas de micrositios
import MicrositiosList from "./components/micrositios/Micrositios-list.vue";
import MicrositiosEditar from "./components/micrositios/Micrositios-single.vue";
//Vistas de productos
import ProductosList from "./components/productos/Products-list.vue";
import ProductosEditar from "./components/productos/Products-single.vue";
//Vistas de servicios
import ServiciosList from "./components/servicios/Servicios-list.vue";
import ServiciosEditar from "./components/servicios/Servicios-single.vue";
//Vistas de usuarios
import UsersList from "./components/users/Users-list.vue";
import UsersEditar from "./components/users/Users-single.vue";
//Vistas de categorias
import CategoriasList from "./components/categorias/Categorias-list.vue";
import CategoriasEditar from "./components/categorias/Categorias-single.vue";
//Vistas de cliente-micrositio
import ClienteMicrositioList from "./components/cliente-micrositio/Clientehasmicrositios-list.vue";
import ClienteMicrositioEditar from "./components/cliente-micrositio/Clientehasmicrositios-single.vue";
//Vistas de la pagina del micrositio
import MicrositioComponent from "./components/micrositio/MicrositioComponent.vue";

export const routes = [
    {
        name: "example",
        path: "/example",
        component: ExampleComponent
    },
    {
        name: "browser",
        path: "/",
        component: BrowserComponent
    },
    {
        path: "/logout",
        name: "logout",
        route: "logout"
    }
    /*{
        name: "micrositio-page",
        path: "/micrositio/:id/",
        component: MicrositioComponent
    }*/
];

export const routesAdmin = [
    {
        path: "/logout",
        name: "logout",
        route: "logout"
    },
    {
        name: "home",
        path: "/admin/home",
        component: Home
    },
    {
        name: "admin",
        path: "/admin/",
        component: Home
    },
    {
        name: "clientes",
        path: "/admin/clientes/",
        props: true,
        component: ClientesList
    },
    {
        name: "clientesEditar",
        path: "/admin/cliente/:id",
        props: true,
        component: ClientesEditar
    },
    {
        name: "micrositios",
        path: "/admin/micrositios/",
        props: true,
        component: MicrositiosList
    },
    {
        name: "micrositiosEditar",
        path: "/admin/micrositio/:id",
        props: true,
        component: MicrositiosEditar
    },
    {
        name: "productos",
        path: "/admin/:id/products/",
        props: true,
        component: ProductosList
    },
    {
        name: "productosEditar",
        path: "/admin/product/:id",
        props: true,
        component: ProductosEditar
    },
    {
        name: "servicios",
        path: "/admin/:id/servicios/",
        props: true,
        component: ServiciosList
    },
    {
        name: "serviciosEditar",
        path: "/admin/servicio/:id",
        props: true,
        component: ServiciosEditar
    },
    {
        name: "users",
        path: "/admin/users/",
        props: true,
        component: UsersList
    },
    {
        name: "usersEditar",
        path: "/admin/user/:id",
        props: true,
        component: UsersEditar
    },
    {
        name: "categorias",
        path: "/admin/:id/categorias/",
        props: true,
        component: CategoriasList
    },
    {
        name: "categoriasEditar",
        path: "/admin/categoria/:id",
        props: true,
        component: CategoriasEditar
    },
    {
        name: "cliente-micrositio",
        path: "/admin/cliente-micrositio",
        props: true,
        component: ClienteMicrositioList
    },
    {
        name: "cliente-micrositioEditar",
        path: "/admin/cliente-micrositio/:id",
        props: true,
        component: ClienteMicrositioEditar
    }
];

export default { routesAdmin, routes };
