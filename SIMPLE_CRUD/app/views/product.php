<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>CRUD PRODUCTO</title>
</head>
<body>
<?php include 'template/navbar.php'; ?>

<div class="card">
  <div class="card-header">
  Create product
  </div>
  <div class="card-body">
    <form action="../controllers/product.php" method="POST">
  <div class="form-group">
    <label for="name">Product name</label>
    <input type="text" class="form-control" id="name" name="name" placeholder="XXL T-Shirt">
  </div>
  <div class="form-group">
    <label for="description">Description</label>
    <input type="text" class="form-control" id="description" name="description" placeholder="Very good quality">
  </div>
  <div class="form-group">
    <label for="sale_price">Sale price</label>
    <input type="number" class="form-control" id="sale_price" name="sale_price" placeholder="500">
  </div>
  <div class="form-group">
    <label for="purchase_price">Sale price</label>
    <input type="number" class="form-control" id="purchase_price" name="purchase_price" placeholder="500">
  </div>
  <div class="form-group">
    <label for="category">Category</label>
    <select class="form-control" id="category" name="category">
      <option>Clothes</option>
    </select>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
    </form>

  </div>
</div>


</body>

</html>