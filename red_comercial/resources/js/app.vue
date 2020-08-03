<template>
  <div>
    <!-- Page Wrapper -->
    <div id="wrapper">
      <div v-for="(ruta) in routes" :key="ruta.id">
        <sidebar-component v-if="$route.name === ruta.name"></sidebar-component>
      </div>

      <!-- Content Wrapper -->
      <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->
        <div id="content">
          <div v-for="(ruta) in routes" :key="ruta.id">
            <topbar-component v-if="$route.name === ruta.name"></topbar-component>
          </div>

          <!-- Begin Page Content -->
          <transition name>
            <router-view></router-view>
          </transition>

          <!-- /.container-fluid -->
        </div>
        <!-- End of Main Content -->
        <div v-for="(ruta) in routes" :key="ruta.id">
          <footer-component v-if="$route.name === ruta.name"></footer-component>
        </div>
      </div>
      <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>
  </div>
</template>


<script>
import { routesAdmin } from "./routes";

export default {
  data() {
    return {
      routes: false,
    };
  },
  mounted() {
    this.routes = routesAdmin;
  },
};
</script>