<template>
  <div>
    <!-- Page Wrapper -->
    <div id="wrapper">
        <sidebar-component></sidebar-component>

      <!-- Content Wrapper -->
      <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->
        <div id="content">
            <topbar-component></topbar-component>

          <!-- Begin Page Content -->
          <transition name>
            <router-view></router-view>
          </transition>

          <!-- /.container-fluid -->
        </div>
        <!-- End of Main Content -->
          <footer-component ></footer-component>
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
export default {
  data() {
    return {
    };
  },
  mounted() {
  },
};
</script>