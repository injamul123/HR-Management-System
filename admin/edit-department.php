<?php
require_once './src/database.php';
require_once './header.php';
require_once './sidemenu.php';

if (isset($_GET['edit'])) {
    $id = $db->real_escape_string($_GET['edit']);
    $sql = "SELECT * FROM department WHERE id = '$id'";
    $res = $db->query($sql);
    if ($res->num_rows < 1) {
        header('Location: ./department-index');
        exit;
    } else {
        $department = $res->fetch_object();
    }
}

if (isset($_POST['submit'])) {
    $error = '';
    $msg = '';
    if (strlen($_POST['name']) < 1) {
        $error = "please enter department name";
    } else if (strlen($_POST['name']) > 150) {
        $error = "Department name must be less than 150 character";
    } else {

        $name = $db->real_escape_string($_POST['name']);
        $id = $db->real_escape_string($_POST['id']);



        $sql = "UPDATE department
            SET name = '$name' WHERE id = '$id'";
        if ($db->query($sql) === true) {
            $msg = "Department updated successfully";
        } else {
            $error = "Failed to update department, Please check your details and try again";
        }
    }
}




?>

<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
    <a href="#"><strong><span class="fa fa-dashboard"></span> Edit Department</strong></a>
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
                            <label for="exampleInputEmail1" style="color:black">Name</label>
                            <input type="text" name="name" class="form-control" value="<?php echo $department->name ?>" aria-describedby="emailHelp" placeholder="Enter name">
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