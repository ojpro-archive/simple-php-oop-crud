<?php
require_once "model.php";
$model = new Model;
// check if delete_item not empty to prevent error ^_^
if (!empty($_GET["delete_item"])) {
    // then delete it.
    $model->delete($_GET["delete_item"]);
}
?>

<?php require_once "include/header.php" ?>

<div class="container">

    <table class="table table-striped table-hover table-responsive">
        <thead class="thead-inverse">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Number</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($model->fetch()) {
                $records = $model->fetch();
                foreach ($records as $record) {
            ?>
                    <tr>
                        <td scope="row">
                            <?php echo $record["id"] ?>
                        </td>
                        <td><?php echo $record["name"] ?></td>
                        <td><?php echo $record["email"] ?></td>
                        <td><?php echo $record["number"] ?></td>
                        <td>
                            <a href="item.php?id=<?php echo $record['id'] ?>">View</a>
                            <a class="btn btn-primary" href="edit.php?id=<?php echo $record['id'] ?>">Edit</a>
                            <a href="view.php?delete_item=<?php echo $record['id'] ?>" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
            <?php }
            } ?>
        </tbody>
    </table>
</div>
<?php require_once "include/footer.php" ?>