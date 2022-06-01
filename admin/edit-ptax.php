<?php
require_once './src/database.php';
require_once './header.php';
require_once './sidemenu.php';

if (isset($_GET['edit'])) {
    $id = $db->real_escape_string($_GET['edit']);
    $sql = "SELECT * FROM ptax WHERE id = '$id'";
    $res = $db->query($sql);
    if ($res->num_rows < 1) {
        header('Location: ./ptax-index');
        exit;
    } else {
        $ptax = $res->fetch_object();
      
    }
}

if (isset($_POST['submit'])) {
    $error = '';
    $msg = '';
    if (strlen($_POST['gross-from']) < 1) {
        $error = "please enter gross from";
    } else if (strlen($_POST['gross-to']) < 1 ) {
        $error = "please enter gross to";
    } else if (strlen($_POST['amount']) < 1 ) {
        $error = "please enter amount";
    }  
    else {

        $id = $db->real_escape_string($_POST['id']);
        $gross_from = $db->real_escape_string($_POST['gross-from']);
        $gross_to = $db->real_escape_string($_POST['gross-to']);
         $amount = $db->real_escape_string($_POST['amount']);
       
        $sql = "UPDATE ptax
            SET gross_from = '$gross_from', gross_to = '$gross_to',  amount = '$amount'  WHERE id = '$id'";
           
           
        if ($db->query($sql) === true) {
            $msg = "PTAX updated successfully";
        } else {
            $error = "Failed to update ptax, Please check your details and try again";
        }
    }
}




?>

<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
    <a href="#"><strong><span class="fa fa-dashboard"></span> Edit PTAX</strong></a>
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
                            <label for="exampleInputEmail1" style="color:black">Gross From</label>
                            <input type="text" name="gross-from" class="form-control"  aria-describedby="emailHelp" value="<?php echo $ptax->gross_from ?>">
                        </div>
                         <div class="form-group">
                            <label for="exampleInputEmail1" style="color:black">Gross To</label>
                            <input type="text" name="gross-to" class="form-control"  aria-describedby="emailHelp" value="<?php echo $ptax->gross_to ?>">
                        </div> 
                           <div class="form-group">
                            <label for="exampleInputEmail1" style="color:black">Amount</label>
                            <input type="text" name="amount" class="form-control"  aria-describedby="emailHelp" value="<?php echo $ptax->amount ?>">
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