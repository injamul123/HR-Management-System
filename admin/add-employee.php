<?php
require_once './src/database.php';
require_once './header.php';
require_once './sidemenu.php';

if ($_SESSION['role'] != 'admin') {
    header('Location:./dashboard.php');
    exit;
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

        $error = "Department name must be less than 150 character";
    }else if(strlen($_POST['father-name']) < 1){
        $error = "please enter father name";
    } else if(strlen($_POST['mother-name']) < 1){
        $error = "please enter mother name";
    } else if(strlen($_POST['email']) < 1){
        $error = "please enter email";
    }else if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){

      $error = "please enter valid email";

    } else if(!ctype_digit($_POST['phone']) ){
        $error = "Please enter valid phone number";
    } else if(!preg_match('/^[0-9]{10}+$/', $_POST['phone'])){
        $error = "phone number must be 10 digit";
    }else if(strlen($_POST['phone']) < 1){
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
    }else if(strlen($_POST['bpay']) < 1){
        $error = "please enter basic pay";
    }

    else {

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
        $bpay = $db->real_escape_string($_POST['bpay']);


        $sql = "INSERT INTO employee
                (name,father_name,mother_name,email,phone,gender,dob,doj,department,address,basicPay)
                values ('$name','$father_name','$mother_name','$email','$phone','$gender','$dob','$doj','$department','$address','$bpay')";
       //echo $sql;die;
        if ($db->query($sql) === true) {
            $msg = "Employee added successfully";
        } else {
            $error = "Failed to add employee, Please check your details and try again";
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
                            <input type="text" name="name" class="form-control"  aria-describedby="emailHelp" placeholder="Enter name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Father Name</label>
                            <input type="textarea" name="father-name"  class="form-control" id="exampleInputPassword1" placeholder="enter father name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mother Name </label>
                            <input type="textarea" name="mother-name"  class="form-control" id="exampleInputPassword1" placeholder="enter mother name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Email</label>
                            <input type="textarea" name="email" class="form-control" id="exampleInputPassword1" placeholder="enter email">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Phone</label>
                            <input type="text" name="phone"  class="form-control" id="exampleInputPassword1" placeholder="enter phone">
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
                            <input type="date" name="dob"  class="form-control" id="exampleInputPassword1" placeholder="enter dob">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Doj</label>
                            <input type="date" name="doj"  class="form-control" id="exampleInputPassword1" placeholder="enter doj">
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
                            <input type="text" name="address"  class="form-control" id="exampleInputPassword1">
                        </div>
                           <div class="form-group">
                            <label for="exampleInputPassword1">Basic Pay</label>
                            <input type="text" name="bpay"  class="form-control" id="exampleInputPassword1">
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