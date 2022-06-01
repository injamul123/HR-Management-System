<?php

require_once './header.php';
require_once './sidemenu.php';
require_once './src/database.php';



if (isset($_GET['delete'])) {
    $id = $db->real_escape_string($_GET['delete']);
    $sql = "DELETE FROM projects WHERE id = '$id'";
    $db->query($sql);
}

$sql = "SELECT * FROM projects";
$res = $db->query($sql);
$projects = [];
while ($row = $res->fetch_object()) {
    $projects[] = $row;
}


?>

<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
    <a href="#"><strong><span class="fa fa-dashboard"></span> Projects</strong></a>
    <hr>
    <a href="./add-project.php"><button class="btn btn-primary" type="button">Add Project</button></a>
    <br>
    <br>

    <table class="table table-bordered">
        <thead>
            <th>Sl No</th>
            <th>Project Name</th>
            <th>Department</th>
            <th>Created-at</th>
            <th>Action</th>
        </thead>
        <tbody>
            <?php $i = 0;
            foreach ($projects as $p) : ?>
                <tr>
                    <td><?php echo $i + 1 ?></td>
                    <td><?php echo $p->project_name ?></td>
                    <?php $sql = "SELECT name from department WHERE id = '$p->department'";
                        $res = $db->query($sql);
                        $name = $res->fetch_object()->name;
                    ?>
                    <td><?php echo $name ?></td>
                    <td><?php echo $p->created_at ?></td>

                    <td>

                        <a href="./edit-project.php?edit=<?php echo $p->id ?>" class="btn btn-info">Edit</a>
                        <a onclick='return confirm("Are you sure?")' href="<?php echo $_SERVER['PHP_SELF'] ?>?delete=<?php echo $p->id ?>" class="btn btn-danger">Delete</a>


                    </td>
                </tr>
            <?php $i++; endforeach ?>
        </tbody>
    </table>
</div>

<?php require_once './footer.php'; ?>