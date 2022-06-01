<?php

require_once './header.php';
require_once './sidemenu.php';
require_once './src/database.php';

/* Delete paper */
if (isset($_GET['delete'])) {
    $id = $db->real_escape_string($_GET['delete']);
    $sql = "DELETE FROM employee WHERE id = '$id'";
    $db->query($sql);
}

$sql = "SELECT * FROM employee";
$res = $db->query($sql);
$employees = [];
while ($row = $res->fetch_object()) {
    $employees[] = $row;
}


?>

<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
    <a href="#"><strong><span class="fa fa-dashboard"></span> Employee</strong></a>
    <hr>
    <a href="./add-employee.php"><button class="btn btn-primary" type="button">Add New Employee</button></a>
    <br>
    <br>

    <table class="table table-bordered">
        <thead>
            <th>Sl No</th>
            <th>Name</th>
            <th>Father Name</th>
            <th>Mother Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Dob</th>
            <th>Created-at</th>

            <th>Action</th>
        </thead>
        <tbody>
            <?php $i = 0;
            foreach ($employees as $e) : ?>
                <tr>
                    <td><?php echo $i + 1 ?></td>
                    <td><?php echo $e->name ?></td>
                    <td><?php echo $e->father_name ?></td>
                    <td><?php echo $e->mother_name ?></td>
                    <td><?php echo $e->email ?></td>
                     <td><?php echo $e->phone ?></td>
                      <td><?php echo $e->dob ?></td>
                    <td><?php echo $e->created_at ?></td>

                    <td>

                        <a href="./edit-employee.php?edit=  <?php echo $e->id ?>" class="btn btn-info">Edit</a>
                        <a onclick='return confirm("Are you sure?")' href="<?php echo $_SERVER['PHP_SELF'] ?>?delete=<?php echo $e->id ?>" class="btn btn-danger">Delete</a>


                    </td>
                </tr>
            <?php $i++;endforeach ?>
        </tbody>
    </table>
</div>

<?php require_once './footer.php'; ?>