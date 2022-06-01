<?php
require_once './src/database.php';
require_once './header.php';
require_once './sidemenu.php';

if (isset($_GET['edit'])) {
    $id = $db->real_escape_string($_GET['edit']);
    $sql = "SELECT * FROM employee WHERE id = '$id'";
    $res = $db->query($sql);
    if ($res->num_rows < 1) {
        header('Location: ./employee-index');
        exit;
    } else {
        $employee = $res->fetch_object();
    }
}

$sql = "SELECT * FROM department";
$res = $db->query($sql);
$departments = [];
while($row = $res->fetch_object()){
    $departments[] = $row; 
}

if (isset($_POST['submit'])) {
    $error = '';
    $msg = '';
    if (strlen($_POST['name']) < 1) {
        $error = "please enter employee name";
    } else if (strlen($_POST['name']) > 150) {

        $error = "emp name must be less than 150 character";
    }else if(strlen($_POST['father-name']) < 1){
        $error = "please enter father name";
    } else if(strlen($_POST['mother-name']) < 1){
        $error = "please enter mother name";
    } else if(strlen($_POST['email']) < 1){
        $error = "please enter email";
    } else if(strlen($_POST['phone']) < 1){
        $error = "please enter phone";
    } else if($_POST['gender'] == 'none'){
        $error = "please select gender";
    } else if(strlen($_POST['dob']) < 1){
        $error = "please enter dob";
    } else if(strlen($_POST['doj']) < 1){
        $error = "please enter doj";
    } else if($_POST['department'] == 'none'){
        $error = "please select department";
    }else if(strlen($_POST['address']) < 1){
        $error = "please enter address";
    }

    else {

        $id = $db->real_escape_string($_POST['id']);
        $name = $db->real_escape_string($_POST['name']);
        $father_name = $db->real_escape_string($_POST['father-name']);
        $mother_name = $db->real_escape_string($_POST['mother-name']);
        $email = $db->real_escape_string($_POST['email']);
        $phone = $db->real_escape_string($_POST['phone']);
        $gender = $db->real_escape_string($_POST['gender']);
        $dob = $db->real_escape_string($_POST['dob']);
        $doj = $db->real_escape_string($_POST['doj']);
        $department = $db->real_escape_string($_POST['department']);
        $address = $db->real_escape_string($_POST['address']);


        $sql =  "UPDATE employee
            SET name = '$name', father_name = '$father_name', mother_name = '$mother_name', email = '$email', phone = '$phone',
            gender = '$gender', dob = '$dob', doj = '$doj', department = '$department', address = '$address' WHERE id = '$id'";
      // echo $sql;die;
        if ($db->query($sql) === true) {
            $msg = "Employee updated successfully";
        } else {
            $error = "Failed to update employee, Please check your details and try again";
        }
    }
}



?>

<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
   <span class="fa fa-dashboard"> <a href="./department-index.php">Employees /<strong></span> Add New Employee</strong></a>
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
                            <label for="exampleInputEmail1" style="color:black">Name</label>
                            <input type="text" name="name" class="form-control" value="<?php echo $employee->name ?>"  aria-describedby="emailHelp" placeholder="Enter name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Father Name</label>
                            <input type="textarea" name="father-name"  value="<?php echo $employee->father_name ?>" class="form-control" id="exampleInputPassword1" placeholder="enter father name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mother Name </label>
                            <input type="textarea" name="mother-name" value="<?php echo $employee->mother_name ?>"  class="form-control" id="exampleInputPassword1" placeholder="enter mother name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Email</label>
                            <input type="textarea" name="email" class="form-control" value="<?php echo $employee->email ?>" id="exampleInputPassword1" placeholder="enter email">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Phone</label>
                            <input type="text" name="phone"  value="<?php echo $employee->phone ?>" class="form-control" id="exampleInputPassword1" placeholder="enter phone">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1" style="color:black">Gender</label>
                           <select class="form-control" name="gender">
                                <option value="none">SELECT</option>
                                <option value="male">Male</option>
                                 <option value="female">Female</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Dob</label>
                            <input type="date" name="dob" value="<?php echo $employee->dob ?>" class="form-control" id="exampleInputPassword1" placeholder="enter dob">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Doj</label>
                            <input type="date" name="doj" value="<?php echo $employee->doj ?>"  class="form-control" id="exampleInputPassword1" placeholder="enter doj">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Department</label>
                            <select class="form-control" name="department">
                                <option value="none">SELECT</option>
                                <?php foreach($departments as $d): ?>
                                <option value="<?php echo $d->id ?>"><?php echo $d->name ?></option>
                            <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Address</label>
                            <input type="text" name="address" value="<?php echo $employee->address ?>" class="form-control" id="exampleInputPassword1">
                        </div>
                          <div class="form-group">
                            <label for="exampleInputPassword1">Basic Pay</label>
                            <input type="text" name="bpay" value="<?php echo $employee->basicPay ?>" class="form-control" id="exampleInputPassword1">
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