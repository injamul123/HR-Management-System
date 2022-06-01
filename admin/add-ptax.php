<?php
require_once './src/database.php';
require_once './header.php';
require_once './sidemenu.php';


if (isset($_POST['submit'])) {
    $error = '';
    $msg = '';
    if (strlen($_POST['gross-from']) < 1) {
        $error = "please enter gross from";
    } else if (strlen($_POST['gross-to']) < 1) {

        $error = "please enter gross to";
    }else if (strlen($_POST['amount']) < 1) {

        $error = "please enter amount";
    } 
     else {

        $gross_from = $db->real_escape_string($_POST['gross-from']);
        $gross_to = $db->real_escape_string($_POST['gross-to']);
        $amount = $db->real_escape_string($_POST['amount']);
       
        $sql = "INSERT INTO ptax
                (gross_from, gross_to, amount)
                values ('$gross_from', '$gross_to', '$amount')";
        if ($db->query($sql) === true) {
            $msg = "PTAX added successfully";
        } else {
            $error = "Failed to add ptax, Please check your details and try again";
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
                            <label for="exampleInputEmail1" style="color:black">Gross From</label>
                            <input type="text" name="gross-from" class="form-control" value="" aria-describedby="emailHelp" placeholder="Enter gross from">
                        </div>
                         <div class="form-group">
                            <label for="exampleInputEmail1" style="color:black">Gross To</label>
                            <input type="text" name="gross-to" class="form-control" value="" aria-describedby="emailHelp" placeholder="Enter gross to">
                        </div>
                         <div class="form-group">
                            <label for="exampleInputEmail1" style="color:black">Amount</label>
                            <input type="text" name="amount" class="form-control" value="" aria-describedby="emailHelp" placeholder="Enter amount">
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