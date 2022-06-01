<?php
require_once './src/database.php';
require_once './header.php';
require_once './sidemenu.php';


$sql = "SELECT * FROM department";
$res = $db->query($sql);
$departments = [];
while($row = $res->fetch_object()){
    $departments [] = $row;
}



$sql = "SELECT * FROM projects";
$res = $db->query($sql);
$projects = [];
while($row = $res->fetch_object()){
    $projects [] = $row;
}

if (isset($_POST['submit'])) {
    $error = '';
    $msg = '';
    if ( $_POST['department'] == 'none') {
        $error = "please select department";
    } else if ( $_POST['employee'] == 'none') {

        $error = "please select employee";
    }else if ( $_POST['project'] == 'none') {

        $error = "please select project";
    } 
     else {

        $department = $db->real_escape_string($_POST['department']);
        $employee = $db->real_escape_string($_POST['employee']);
        $project = $db->real_escape_string($_POST['project']);
       
        $sql = "INSERT INTO assigned_projects
                (department, project, employee)
                values ('$department',  '$project', '$employee')";
                
        if ($db->query($sql) === true) {
            $msg = "Project assigned successfully";
        } else {
            $error = "Failed to assign project, Please check your details and try again";
        }
    }
}



?>

<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
   <span class="fa fa-dashboard"> <a href="./assign-project.php">Assign Projects /<strong></span> Assign Project</strong></a>
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
                            <label for="exampleInputEmail1" style="color:black">Department</label>
                            <select class="form-control" id="department" name="department">
                                <option value="none">--SELECT DEPARTMENT--</option>
                                <?php foreach($departments as $d):?>
                                <option value="<?php echo $d->id ?>"><?php echo $d->name ?></option>
                            <?php endforeach ?>
                            </select>
                        </div>
                         <div class="form-group">
                            <label for="exampleInputEmail1" style="color:black">Employee</label>
                          <select class="form-control" id="employee" name="employee">
                                <option value="none">--SELECT EMPLOYEE--</option>
                                <option></option>
                            </select>
                        </div>
                         <div class="form-group">
                            <label for="exampleInputEmail1" style="color:black">Project</label>
                            <select class="form-control" id="project" name="project">
                                <option value="none">--SELECT PROJECT--</option>
                                <?php foreach($projects as $p): ?>
                                <option value="<?php echo $p->id ?>"><?php echo $p->project_name ?></option>
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
 <script>
    const department = document.querySelector('#department');
    const employee = document.querySelector('#employee');
    const project = document.querySelector('#project');
    department.addEventListener('change', function() {
    let value = this.value;
    //console.log(value);
    var params = new URLSearchParams();
    params.append('department', value);
    fetch('../api/getEmployees.php', {
    method: 'POST',
    headers: {
    "Content-Type": "application/x-www-form-urlencoded"
    },
    body: params
    })
    .then(function(response) {
    return response.json();
    })
    .then(json => {
    console.log(json);
    employee.innerHTML = '<option value="none">--SELECT EMPLOYEE--</option>';
    json.forEach(emp => {
    employee.innerHTML += '<option value="' + emp.id + '">' + emp.name +
    '</option>';

    });
    })
    .catch(function(error) {
    console.log(error);
    })
    })
    </script>