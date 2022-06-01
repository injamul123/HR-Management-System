<?php

require_once './header.php';
require_once './sidemenu.php';
require_once './src/database.php';

/* Delete paper */
if (isset($_GET['delete'])) {
    $id = $db->real_escape_string($_GET['delete']);
    $sql = "DELETE FROM department WHERE id = '$id'";
    $db->query($sql);
}

$sql = "SELECT * FROM department";
$res = $db->query($sql);
$papers = [];
while ($row = $res->fetch_object()) {
    $departments[] = $row;
}


?>

<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
    <a href="#"><strong><span class="fa fa-dashboard"></span> Department</strong></a>
    <hr>
    <a href="./add-department.php"><button class="btn btn-primary" type="button">Add New Department</button></a>
    <br>
    <br>

    <table class="table table-bordered">
        <thead>
            <th>Sl No</th>
            <th>Name</th>
            <th>Created-at</th>

            <th>Action</th>
        </thead>
        <tbody>
            <?php $i = 0;
            foreach ($departments as $department) : ?>
                <tr>
                    <td><?php echo $i + 1 ?></td>
                    <td><?php echo $department->name ?></td>
                    <td><?php echo $department->created_at ?></td>

                    <td>

                        <a href="./edit-department.php?edit=<?php echo $department->id ?>" class="btn btn-info">Edit</a>
                        <a onclick='return confirm("Are you sure?")' href="<?php echo $_SERVER['PHP_SELF'] ?>?delete=<?php echo $department->id ?>" class="btn btn-danger">Delete</a>


                    </td>
                </tr>
            <?php $i++;endforeach ?>
        </tbody>
    </table>
</div>

<?php require_once './footer.php'; ?>