<?php

require_once './header.php';
require_once './sidemenu.php';
require_once './src/database.php';

/* Delete paper */
if (isset($_GET['delete'])) {
    $id = $db->real_escape_string($_GET['delete']);
    $sql = "DELETE FROM hra WHERE id = '$id'";
    $db->query($sql);
}

$sql = "SELECT * FROM hra";
$res = $db->query($sql);
$hra = [];
while ($row = $res->fetch_object()) {
    $hra[] = $row;
}


?>

<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
    <a href="#"><strong><span class="fa fa-dashboard"></span>HRA</strong></a>
    <hr>
    <a href="./add-hra.php"><button class="btn btn-primary" type="button">Add New HRA</button></a>
    <br>
    <br>

    <table class="table table-bordered">
        <thead>
            <th>Sl No</th>
            <th>HRA Percentage</th>
            <th>Action</th>
        </thead>
        <tbody>
            <?php $i = 0;
            foreach ($hra as $h) : ?>
                <tr>
                    <td><?php echo $i + 1 ?></td>
                    <td><?php echo $h->hra_perc ?></td>
                   
                    <td>

                        <a href="./edit-hra.php?edit=<?php echo $h->id ?>" class="btn btn-info">Edit</a>
                        <a onclick='return confirm("Are you sure?")' href="<?php echo $_SERVER['PHP_SELF'] ?>?delete=<?php echo $h->id ?>" class="btn btn-danger">Delete</a>


                    </td>
                </tr>
            <?php $i++;endforeach ?>
        </tbody>
    </table>
</div>

<?php require_once './footer.php'; ?>