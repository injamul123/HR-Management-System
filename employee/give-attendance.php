<?php
require_once './src/database.php';
require_once './header.php';
require_once './sidemenu.php';


$emp_id = $_SESSION['emp_id'];
if (isset($_POST['submit'])) {
    $error = '';
    $msg = '';
    if (strlen($_POST['in-time']) < 1) {
        $error = "please enter entry time";
    } else {

        $in_time = $db->real_escape_string($_POST['in-time']);


        $sql = "INSERT INTO attendences
                (inTime,empId)
                values ('$in_time', '$emp_id')";

        if ($db->query($sql) === true) {
            $msg = "Attendence given successfully";
        } else {
            $error = "Failed, Please check your details and try again";
        }
    }
}



?>

<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
    <span class="fa fa-dashboard"> <a href="./department-index.php">Attendances/<strong></span> Give Attendance</strong></a>
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

                    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo $id ?>">
                        <div class="form-group">
                            <label for="exampleInputEmail1" style="color:black">In Time</label>
                            <input type="time" name="in-time" class="form-control" value="" aria-describedby="emailHelp">
                        </div>
                        <!--<div class="form-group">
                            <label for="exampleInputPassword1">Paper name</label>
                            <input type="textarea" name="paper-name" value="" class="form-control"
                                id="exampleInputPassword1" placeholder="enter paper name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Year</label>
                            <input type="textarea" name="year" value="" class="form-control" id="exampleInputPassword1"
                                placeholder="enter year">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Degree</label>
                            <input type="textarea" name="degree" value="" class="form-control"
                                id="exampleInputPassword1" placeholder="enter degree">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Scanned paper</label>
                            <input type="file" name="image-file" value="" class="form-control"
                                id="exampleInputPassword1">
                        </div>-->
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