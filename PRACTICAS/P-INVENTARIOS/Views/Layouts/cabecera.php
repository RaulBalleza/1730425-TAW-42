<nav class="navbar navbar-expand-sm navbar-expand-md navbar-expand-lg navbar-dark relative-top bg-dark">
  <div class="navbar-collapse collapse w-100 order-1 order-md-0">

    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Principal</a>
      </li>

      <?php if (isset($_SESSION["usuario"])) { ?>
        <li class="nav-item">
          <a class="nav-link" href='?controller=Producto&action=mostrar'>Productos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href='?controller=CategoriasProducto&action=mostrar'>Categorias</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href='?controller=Universidad&action=mostrar'>Universidades</a>
        </li>
      <?php } ?>
    </ul>
  </div>

  <div class="mx-auto order-0">
    <a class="navbar-brand mx-auto" href="index.php">CRUD de Inventarios</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse">
      <span class="navbar-toggler-icon"></span>
    </button>
  </div>

  <div class="navbar-collapse collapse w-100 order-3">
    <ul class="navbar-nav ml-auto">

      <?php if (isset($_SESSION["usuario"])) { ?>
        <li class="nav-item">
          <a class="btn btn-primary" href="?controller=Usuario&action=logout">Cerrar sesión</a>
        </li>


      <?php } else { ?>

        <li class="nav-item">
          <a class="nav-link" href="?controller=Usuario&action=login">Iniciar sesión</a>
        </li>
      <?php } ?>

    </ul>
  </div>
</nav>