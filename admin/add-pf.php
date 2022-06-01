<?php
require_once './src/database.php';
require_once './header.php';
require_once './sidemenu.php';


if (isset($_POST['submit'])) {
    $error = '';
    $msg = '';
    if (strlen($_POST['pf-perc']) < 1) {
        $error = "please enter pf percentage";
    } else if (strlen($_POST['max-val']) < 1) {

        $error = "please enter pf max value";
    } else {

        $pf_perc = $db->real_escape_string($_POST['pf-perc']);
        $max_val = $db->real_escape_string($_POST['max-val']);
       
        $sql = "INSERT INTO pf
                (pf_perc, max_val)
                values ('$pf_perc', $max_val)";
        if ($db->query($sql) === true) {
            $msg = "PF added successfully";
        } else {
            $error = "Failed to add pf, Please check your details and try again";
        }
    }
}



?>

<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
   <span class="fa fa-dashboard"> <a href="./pf-index.php">DA /<strong></span> Add New PF</strong></a>
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
                            <label for="exampleInputEmail1" style="color:black">PF Percentage</label>
                            <input type="text" name="pf-perc" class="form-control" value="" aria-describedby="emailHelp" placeholder="Enter da from">
                        </div>
                         <div class="form-group">
                            <label for="exampleInputEmail1" style="color:black">Max Value</label>
                            <input type="text" name="max-val" class="form-control" value="" aria-describedby="emailHelp" placeholder="Enter da to">
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