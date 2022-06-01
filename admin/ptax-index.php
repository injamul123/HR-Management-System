<?php

require_once './header.php';
require_once './sidemenu.php';
require_once './src/database.php';

/* Delete paper */
if (isset($_GET['delete'])) {
    $id = $db->real_escape_string($_GET['delete']);
    $sql = "DELETE FROM ptax WHERE id = '$id'";
    $db->query($sql);
}

$sql = "SELECT * FROM ptax";
$res = $db->query($sql);
$ptax = [];
while ($row = $res->fetch_object()) {
    $ptax[] = $row;
}


?>

<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
    <a href="#"><strong><span class="fa fa-dashboard"></span> PTAX</strong></a>
    <hr>
    <a href="./add-ptax.php"><button class="btn btn-primary" type="button">Add PTAX</button></a>
    <br>
    <br>

    <table class="table table-bordered">
        <thead>
            <th>Sl No</th>
            <th>Gross From</th>
            <th>Gross To</th>
             <th>Amount</th>
            <th>Created-at</th>
            <th>Action</th>
        </thead>
        <tbody>
            <?php $i = 0;
            foreach ($ptax as $p) : ?>
                <tr>
                    <td><?php echo $i + 1 ?></td>
                    <td><?php echo $p->gross_from ?></td>
                    <td><?php echo $p->gross_to ?></td>
                    <td><?php echo $p->amount ?></td>
                    <td><?php echo $p->created_at ?></td>

                    <td>

                        <a href="./edit-ptax.php?edit=<?php echo $p->id ?>" class="btn btn-info">Edit</a>
                        <a onclick='return confirm("Are you sure?")' href="<?php echo $_SERVER['PHP_SELF'] ?>?delete=<?php echo $p->id ?>" class="btn btn-danger">Delete</a>


                    </td>
                </tr>
            <?php $i++; endforeach ?>
        </tbody>
    </table>
</div>

<?php require_once './footer.php'; ?>