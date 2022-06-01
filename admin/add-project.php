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

if (isset($_POST['submit'])) {
    $error = '';
    $msg = '';
    if (strlen($_POST['project-name']) < 1) {
        $error = "please enter project name";
    } else if (strlen($_POST['department']) < 1) {

        $error = "please enter department";
    }else {

        $project_name = $db->real_escape_string($_POST['project-name']);
        $department = $db->real_escape_string($_POST['department']);
        $sql = "INSERT INTO projects
                (project_name, department)
                values ('$project_name', '$department')";
                //echo $sql;die;
        if ($db->query($sql) === true) {
            $msg = "project added successfully";
        }
    }
}



?>

<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
   <span class="fa fa-dashboard"> <a href="./pf-index.php">Projects /<strong></span> Add New Project</strong></a>
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
                        
                        <div class="form-group">
                            <label for="exampleInputEmail1" style="color:black">Project name</label>
                            <input type="text" name="project-name" class="form-control" value="" aria-describedby="emailHelp" placeholder="Enter project name">
                        </div>
                         <div class="form-group">
                            <label for="exampleInputEmail1" style="color:black">Department</label>
                           <select class="form-control" name="department">
                               <option value="none">--SELECT Department--</option>
                               <?php foreach($departments as $d): ?>
                               <option value="<?php echo $d->id ?>"><?php echo $d->name ?></option>
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