<?php 
    // Exit and back to home page if [id] query not exist or empty
 if(empty($_GET['id'])){
     header("Location:index.php");
     exit();
 }

 require_once "model.php";
 $model = new Model;
 $record = $model->fetch($_GET['id']);
    //  Check if there is a result 
 if($record){
?>
<?php require_once "include/header.php" ?>
<div class="container">
    <div class="col-md-8 mx-auto mt-4">
        <div class="card text-white bg-dark">
            <div class="card-body">
                <h4 class="card-title"><?php echo $record["name"] ?></h4>
                <span><?php echo $record["email"] ?></span>
                <br>
                <span><?php echo $record["number"] ?></span>
                <p class="card-text"><?php echo $record["notes"] ?></p>
            </div>
        </div>
    </div>
</div>
<?php 
}else{
    redirectTo('There is not item with this id.','view.php');
}
 ?>
<?php require_once "include/footer.php" ?>