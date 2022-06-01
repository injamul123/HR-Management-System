<?php
require_once './src/database.php';
require_once './header.php';
require_once './sidemenu.php';

$sql = "SELECT * FROM department";
$res = $db->query($sql);
$departments = [];
while($row = $res->fetch_object()){
    $departments[] = $row; 
}

if (isset($_GET['edit'])) {
    $id = $db->real_escape_string($_GET['edit']);
    $sql = "SELECT * FROM projects WHERE id = '$id'";
    $res = $db->query($sql);
    if ($res->num_rows < 1) {
        header('Location: ./projects-index');
        exit;
    } else {
        $project = $res->fetch_object();

    }
}




if (isset($_POST['submit'])) {
    $error = '';
    $msg = '';
    if (strlen($_POST['project-name']) < 1) {
        $error = "please enter project name";
    } else if (strlen($_POST['department']) > 150) {
        $error = "enter department";
    } else {

        
        $id = $db->real_escape_string($_POST['id']);
        $project_name = $db->real_escape_string($_POST['project-name']);
        $department = $db->real_escape_string($_POST['department']);



        $sql = "UPDATE projects
            SET project_name = '$project_name', department = '$department' WHERE id = '$id'";
        if ($db->query($sql) === true) {
            $msg = "Project updated successfully";
        } else {
            $error = "Failed to update project, Please check your details and try again";
        }
    }
}




?>

<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
    <a href="#"><strong><span class="fa fa-dashboard"></span> Edit Project</strong></a>
    <hr>


</div>
<div class="container-fluid">
    <div class="row">
        <div class="col col-lg-4 col-md-4 col-sm-12 col-xs-12 offset-lg-4" style="margin-left: 100px">
            <div class="card">
                <div class="card-body">
                    <?php if (isset($error) && strlen($error) > 1) : ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $error; ?>
                        </div>
                    <?php endif ?>

                    <?php if (isset($msg) && strlen($msg) > 1) : ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo $msg; ?>
                        </div>
                    <?php endif ?>

                    <?php if (isset($_SESSION['error']) && strlen($_SESSION['error']) > 1) : ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $_SESSION['error'];
                            unset($_SESSION['error']) ?>
                        </div>
                    <?php endif ?>

                    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
                        <input type="hidden" name="id" value="<?php echo $id ?>">
                        <div class="form-group">
                            <label for="exampleInputEmail1" style="color:black">Project Name</label>
                            <input type="text" name="project-name" class="form-control" value="<?php echo $project->project_name ?>" aria-describedby="emailHelp" placeholder="Enter project name">
                        </div>
                          <div class="form-group">
                            <label for="exampleInputEmail1" style="color:black">Department</label>
                            <select class="form-control" name="department">
                                <option value="none">--SELECT--</option>
                                <?php foreach($departments as $d): ?>
                                <option <?php echo isset($project) && $d->id  == $project->department ? 'selected' : null ?>
                                value="<?php echo $d->id ?>"><?php echo $d->name ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                      
                        <div class="form-group" style="float: right">
                            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                            <a href=""><button type="button" class="btn btn-primary">Cancel</button>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once './footer.php'; ?>