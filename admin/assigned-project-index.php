<?php

require_once './header.php';
require_once './sidemenu.php';
require_once './src/database.php';


if (isset($_GET['delete'])) {
    $id = $db->real_escape_string($_GET['delete']);
    $sql = "DELETE FROM assigned_projects WHERE id = '$id'";
    $db->query($sql);
}

$sql = "SELECT * FROM assigned_projects";
$res = $db->query($sql);
$assigned_projects = [];
while ($row = $res->fetch_object()) {
    $assigned_projects[] = $row;
}

//print_r($assigned_projects);die;


?>

<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
    <a href="#"><strong><span class="fa fa-dashboard"></span> Assigned Projects</strong></a>
    <hr>
    <a href="./assign-project.php"><button class="btn btn-primary" type="button">Assign Project</button></a>
    <br>
    <br>

    <table class="table table-bordered">
        <thead>
            <th>Sl No</th>
            <th>Name</th>
            <th>Project Name</th>
            <th>Department</th>
            <th>Created-at</th>

            <th>Action</th>
        </thead>
        <tbody>
            <?php $i = 0;
            foreach ($assigned_projects as $project) : ?>
                <tr>
                    <td><?php echo $i + 1 ?></td>
                    <?php $sql = "SELECT * FROM employee WHERE id = '$project->employee'";
                     //echo $sql;die;
                       $res = $db->query($sql);
                       $emp_name = $res->fetch_object()->name;

                     ?>
                    <td><?php echo $emp_name ?></td>
                     <?php $sql = "SELECT * FROM projects WHERE id = '$project->project'";
                     //echo $sql;die;
                       $res = $db->query($sql);
                       $proj_name = $res->fetch_object()->project_name;

                     ?>
                    <td><?php echo $proj_name ?></td>
                     <?php $sql = "SELECT * FROM department WHERE id = '$project->department'";
                
                       $res = $db->query($sql);
                       $dept_name = $res->fetch_object()->name;

                     ?>
                    <td><?php echo $dept_name ?></td>
                    <td><?php echo $project->created_at ?></td>

                    <td>

                        <!--<a href="./edit-department.php?edit=<?php echo $department->id ?>" class="btn btn-info">Edit</a>-->
                        <a onclick='return confirm("Are you sure?")' href="<?php echo $_SERVER['PHP_SELF'] ?>?delete=<?php echo $project->id ?>" class="btn btn-danger">Delete</a>


                    </td>
                </tr>
            <?php $i++;endforeach ?>
        </tbody>
    </table>
</div>

<?php require_once './footer.php'; ?>