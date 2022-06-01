<?php
require_once './header.php';
require_once './sidemenu.php';
require_once './src/database.php';



if (isset($_POST['submit'])) {

    $month = $_POST['month'];
    $year = $_POST['year'];
   // print_r($month);die;
    $sql = "SELECT * FROM salaryHistory WHERE month = '$month' AND year = '$year' ";
   // echo $sql;die;
    $res = mysqli_query($db, $sql);
    if ($res->num_rows > 0) {
        echo ("<script>location.href = './printpayslip.php?month={$month} & year={$year}';</script>");
    } else {
        echo "No Data Found";
    }

}


?>

<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
	<a href="#"><strong><span class="fa fa-dashboard"></span> Payslip</strong></a>
	<hr>

	 <div class="card">
            <div class="card-header ">
                <i class="fas fa-plus-circle"></i>
                <span class="mb-5">Employee Payslip</span> 
            </div>
            <div class="card-body">
                <form class="" method="post" action=" ./payslip.php">
                    <div class="form-row">
                        <div class="form-group col-lg-3">
                            <label for="name" class="sr-only">Month</label>
                            <select class="form-control" name="month">
                                <option value="none">--Select Month--</option>
                                <?php
$d = new DateTime('Asia/Kolkata');
$months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
$currMonth = $d->format('F');
?>
                                <?php foreach ($months as $m): ?>
                                <option <?=$m == $currMonth ? 'selected' : null?> value="<?=$m?>"><?=$m?></option>
                                <?php endforeach?>
                            </select>
                            <small class="form-text text-danger"> </small>
                        </div>

                        <div class="form-group col-lg-3">
                            <label for="name" class="sr-only">Year</label>
                            <select class="form-control" name="year">
                                <option value="none">--Select Year--</option>
                                <?php
$currYear = $d->format('Y');
?>
                                <?php for ($i = 10; $i > 0; $i--): ?>
                                <option <?=$currYear == $currYear - $i + 1 ? 'selected' : null?>
                                    value="<?=$currYear - $i + 1?>"><?=$currYear - $i + 1?></option>
                                <?php endfor?>
                            </select>
                            <small class="form-text text-danger"> </small>
                        </div>

                        <div class="form-group col-lg-3">
                            <button type="submit" name="submit" class="btn btn-primary">Generate</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

</div>

<?php include './footer.php'; ?>
 <script>
    function printSlip() {
        var divContents = document.getElementById("payslip-table").innerHTML;
        var a = window.open('', '', 'height=500, width=500');
        a.document.write('<html>');
        a.document.write('<body > <h1>Div contents are <br>');
        a.document.write(divContents);
        a.document.write('</body></html>');
        a.document.close();
        a.print();
    }
    </script>