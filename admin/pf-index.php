<?php

require_once './header.php';
require_once './sidemenu.php';
require_once './src/database.php';

/* Delete paper */
if (isset($_GET['delete'])) {
    $id = $db->real_escape_string($_GET['delete']);
    $sql = "DELETE FROM pf WHERE id = '$id'";
    $db->query($sql);
}

$sql = "SELECT * FROM pf";
$res = $db->query($sql);
$pf = [];
while ($row = $res->fetch_object()) {
    $pf[] = $row;
}


?>

<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
    <a href="#"><strong><span class="fa fa-dashboard"></span> PF</strong></a>
    <hr>
    <a href="./add-pf.php"><button class="btn btn-primary" type="button">Add PF</button></a>
    <br>
    <br>

    <table class="table table-bordered">
        <thead>
            <th>Sl No</th>
            <th>PF Percentage</th>
            <th>Max Value</th>
        
            <th>Created-at</th>

            <th>Action</th>
        </thead>
        <tbody>
            <?php $i = 0;
            foreach ($pf as $p) : ?>
                <tr>
                    <td><?php echo $i + 1 ?></td>
                    <td><?php echo $p->pf_perc ?></td>
                    <td><?php echo $p->max_val ?></td>
                    <td><?php echo $p->created_at ?></td>

                    <td>

                        <a href="./edit-pf.php?edit=<?php echo $p->id ?>" class="btn btn-info">Edit</a>
                        <a onclick='return confirm("Are you sure?")' href="<?php echo $_SERVER['PHP_SELF'] ?>?delete=<?php echo $p->id ?>" class="btn btn-danger">Delete</a>


                    </td>
                </tr>
            <?php $i++; endforeach ?>
        </tbody>
    </table>
</div>

<?php require_once './footer.php'; ?>