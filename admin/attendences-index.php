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

$sql = "SELECT * FROM attendences";
$res = $db->query($sql);
$attendences = [];
while ($row = $res->fetch_object()) {
    $attendences[] = $row;
}


?>

<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
    <a href="#"><strong><span class="fa fa-dashboard"></span> Attendences</strong></a>
    <hr>


    <table class="table table-bordered">
        <thead>
            <th>Sl No</th>
            <th>Employee Name</th>
            <th>Date</th>
            <th>Status</th>


        </thead>
        <tbody>
            <?php $i = 0;
            foreach ($attendences as $attendence) : ?>
                <tr>
                    <td><?php echo $i + 1 ?></td>
                    <?php $sql = "SELECT * FROM employee WHERE id = '$attendence->empId'";

                    $res = $db->query($sql);
                    $name = $res->fetch_object()->name;
                    ?>
                    <td><?php echo $name ?></td>
                    <?php $date = new DateTime();
                    $d = $date->format($attendence->date);
                    ?>
                    <td><?php echo $d ?></td>
                    <?php if ($attendence->inTime) : ?>
                        <td><span class="badge badge-danger"><?php echo "present" ?></span></td>
                    <?php else : ?>
                        <td><span class="badge badge-danger"><?php echo "Absent" ?></span></td>
                    <?php endif ?>

                </tr>
            <?php $i++;
            endforeach ?>
        </tbody>
    </table>
</div>

<?php require_once './footer.php'; ?>