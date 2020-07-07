<!--FooterComponent 
Un simple footer que se puede insertar como etiqueta html
-->
<template>
    <footer class="app-footer">
        <span><a href="#">UPV</a> &copy; 2020</span>
        <span class="ml-auto">Desarrollado por <a href="">Raul Balleza</a></span>
    </footer>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
