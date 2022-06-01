<?php

require_once './header.php';
require_once './sidemenu.php';
require_once './src/database.php';

/* Delete paper */
if (isset($_GET['delete'])) {
    $id = $db->real_escape_string($_GET['delete']);
    $sql = "DELETE FROM da WHERE id = '$id'";
    $db->query($sql);
}

$sql = "SELECT * FROM da";
$res = $db->query($sql);
$das = [];
while ($row = $res->fetch_object()) {
    $das[] = $row;
}


?>

<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
    <a href="#"><strong><span class="fa fa-dashboard"></span> Dearness Allowance(DA)</strong></a>
    <hr>
    <a href="./add-da.php"><button class="btn btn-primary" type="button">Add DA</button></a>
    <br>
    <br>

    <table class="table table-bordered">
        <thead>
            <th>Sl No</th>
            <th>From</th>
            <th>To</th>
            <th>DA Percentage</th>
            <th>Created-at</th>

            <th>Action</th>
        </thead>
        <tbody>
            <?php $i = 0;
            foreach ($das as $d) : ?>
                <tr>
                    <td><?php echo $i + 1 ?></td>
                    <td><?php echo $d->da_from ?></td>
                    <td><?php echo $d->da_to ?></td>
                      <td><?php echo $d->perc ?></td>
                    <td><?php echo $d->created_at ?></td>

                    <td>

                        <a href="./edit-da.php?edit=<?php echo $d->id ?>" class="btn btn-info">Edit</a>
                        <a onclick='return confirm("Are you sure?")' href="<?php echo $_SERVER['PHP_SELF'] ?>?delete=<?php echo $d->id ?>" class="btn btn-danger">Delete</a>


                    </td>
                </tr>
            <?php $i++; endforeach ?>
        </tbody>
    </table>
</div>

<?php require_once './footer.php'; ?>