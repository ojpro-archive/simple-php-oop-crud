<?php
// Exit and back to home page if [id] query not exist or empty
if (empty($_GET['id'])) {
  header("Location:index.php");
  exit();
}
require_once "model.php";
require_once 'include/functions.php';
// Inhert Model Class
$model = new Model;
// Call update Method for auto execution if update axtion exist
if (isset($_GET['action']) && $_GET['action'] == "update") {
  $model->update($_GET['id']);
}
//  Fetch the record with the given id
$record = $model->fetch($_GET['id']);
//  Check if there is a result 
if (!empty($record)) {
  // Page Title
  $page_title = "Edit " . $record["name"] . "'s details.";
?>

  <?php require_once "include/header.php" ?>

  <div class="container">
    <div class="row">
      <div class="col-md-6 mx-auto mt-4">
        <form action="edit.php?id=<?php echo $_GET['id'] ?>&action=update" method="post">
          <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" value="<?php echo $record['name'] ?>" id="name" class="form-control" placeholder="Enter your name">
            <br>
            <label for="email">E-mail</label>
            <input type="email" name="email" value="<?php echo $record['email'] ?>" id="email" class="form-control" placeholder="example@domain.com">
            <br>
            <label for="number">Number</label>
            <input type="tel" name="number" value="<?php echo $record['number'] ?>" id="number" class="form-control" placeholder="+123 456 6789">
            <br>
            <div class="form-group">
              <label for="notes">Notes: </label>
              <textarea class="form-control" name="notes" id="notes" rows="5"><?php echo $record['notes'] ?></textarea>
            </div>
            <br>
            <button type="submit" name="save" class="btn btn-primary">Save</button>
            <button type="reset" class="btn btn-default">Reset</button>
          </div>
        </form>
      </div>
    </div>
  </div>
<?php
} else {
  redirectTo('There is not item with this id.');
}
require_once "include/footer.php";
?>