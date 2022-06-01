<?php
require_once './src/database.php';
require_once './header.php';
require_once './sidemenu.php';


if (isset($_POST['submit'])) {
    $error = '';
    $msg = '';
    if (strlen($_POST['da-from']) < 1) {
        $error = "please enter da from";
    } else if (strlen($_POST['da-to']) < 1) {

        $error = "please enter da to";
    }else if (strlen($_POST['perc']) < 1) {

        $error = "please enter da percentage";
    }  else {

        $da_from = $db->real_escape_string($_POST['da-from']);
        $da_to = $db->real_escape_string($_POST['da-to']);
        $perc = $db->real_escape_string($_POST['perc']);
        $sql = "INSERT INTO da
                (da_from, da_to, perc)
                values ('$da_from', '$da_to', $perc)";
        if ($db->query($sql) === true) {
            $msg = "DA added successfully";
        } else {
            $error = "Failed to add da, Please check your details and try again";
        }
    }
}



?>

<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
   <span class="fa fa-dashboard"> <a href="./department-index.php">DA /<strong></span> Add New DA</strong></a>
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
                            <label for="exampleInputEmail1" style="color:black">From</label>
                            <input type="text" name="da-from" class="form-control" value="" aria-describedby="emailHelp" placeholder="Enter da from">
                        </div>
                         <div class="form-group">
                            <label for="exampleInputEmail1" style="color:black">To</label>
                            <input type="text" name="da-to" class="form-control" value="" aria-describedby="emailHelp" placeholder="Enter da to">
                        </div>
                          <div class="form-group">
                            <label for="exampleInputEmail1" style="color:black">DA Percentage</label>
                            <input type="text" name="perc" class="form-control" value="" aria-describedby="emailHelp" placeholder="Enter da to">
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