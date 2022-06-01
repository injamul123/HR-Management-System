<?php
require_once './src/database.php';
require_once './header.php';
require_once './sidemenu.php';

if (isset($_GET['edit'])) {
    $id = $db->real_escape_string($_GET['edit']);
    $sql = "SELECT * FROM hra WHERE id = '$id'";
    $res = $db->query($sql);
    if ($res->num_rows < 1) {
        header('Location: ./hra-index');
        exit;
    } else {
        $hra = $res->fetch_object();
    }
}

if (isset($_POST['submit'])) {
    $error = '';
    $msg = '';
    if (strlen($_POST['hra-perc']) < 1) {
        $error = "please enter hra percentage";
    } else {

        $hra_perc = $db->real_escape_string($_POST['hra-perc']);
        $id = $db->real_escape_string($_POST['id']);



        $sql = "UPDATE hra
            SET hra_perc = '$hra_perc' WHERE id = '$id'";
        if ($db->query($sql) === true) {
            $msg = "HRA updated successfully";
        } else {
            $error = "Failed to update hra, Please check your details and try again";
        }
    }
}




?>

<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
    <a href="#"><strong><span class="fa fa-dashboard"></span> Edit HRA</strong></a>
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
                            <label for="exampleInputEmail1" style="color:black">HRA Percentage</label>
                            <input type="text" name="name" class="form-control" value="<?php echo $hra->name ?>" aria-describedby="emailHelp" placeholder="">
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