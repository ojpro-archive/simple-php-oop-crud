<?php
require_once "model.php";
// Inhert Model Class
$model = new Model;
// Call insert Method for auto execution
$model->insert();

// Page Title
$page_title = "Home";
?>

<?php require_once "include/header.php" ?>

<div class="container">
  <div class="row">
    <div class="col-md-12 mt4">
      <div class="text-center">
        <h1>Practice PHP OOP CRUD</h1>
      </div>
    </div>
  </div>
  <hr>
  <div class="row">
    <div class="col-md-6 mx-auto">
      <form action="" method="post">
        <div class="form-group">
          <label for="name">Name</label>
          <input type="text" name="name" id="name" class="form-control" placeholder="Enter your name">
          <br>
          <label for="email">E-mail</label>
          <input type="email" name="email" id="email" class="form-control" placeholder="example@domain.com">
          <br>
          <label for="number">Number</label>
          <input type="tel" name="number" id="number" class="form-control" placeholder="+123 456 6789">
          <br>
          <div class="form-group">
            <label for="notes">Notes: </label>
            <textarea class="form-control" name="notes" id="notes" rows="5"></textarea>
          </div>
          <br>
          <button type="submit" name="save" class="btn btn-primary">Save</button>
          <button type="reset" class="btn btn-default">Reset</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php require_once "include/footer.php" ?>