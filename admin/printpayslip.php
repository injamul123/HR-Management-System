<?php
require_once './header.php';
require_once './sidemenu.php';
require_once './src/database.php';

$month = trim($_GET['month']);
//print_r($_GET['month']);die;
$year = trim($_GET['year']);
$sql = "SELECT * FROM salaryHistory WHERE month = '$month' AND year = '$year' ";
//echo $sql;die;
$res = $db->query($sql);
$salaries = [];
while ($row = $res->fetch_object()) {
    $salaries[] = $row;
}

?>
<style>
@page {
    size: portrait;
    margin: 10mm 10mm 10mm 10mm;
}
</style>
<style type="text/css" media="print">
div.page-break {
    page-break-after: always;
    page-break-inside: avoid;
}
</style>
<div id="content-wrapper">
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="./dashboard">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Payslip Employee</li>
        </ol>
        <!--<div class="col-lg-12 my-2 text-right">
            <a href="./payslip.php" class="btn btn-danger"> Cancel </a>
            <a href="./payslippdf.php?month=<?php echo $_GET['month'] ?>&year=<?php echo $_GET['year'] ?>"
                class="btn btn-primary"> Print </a>
        </div>-->
        <div class="table-responsive" style="height: 600px; overflow-y:auto">
            <div id="payslip-table" class="col-lg-12">
                <?php $i = 1;
foreach ($salaries as $salary): ?>
                <table border="1" cellspacing="0" width="100%" class="my-5" style="margin-top:60px">
                    <tr>
                        <td colspan="2" style="padding: 10px">
                            <table width="100%">
                                <tr>
                                    <td width="100px"><img width="60px" src="<?=$path?>" alt=""></td>
                                    <td>
                                        <h3 class="text-center">Pay Slip for the month of <?=$salary->month?>,
                                            <?=$salary->year?></h3>
                                    </td>
                                </tr>
                            </table>
                            <table width="100%">
                              
                                <tr>
                                    <td><strong>Region:</strong></td>
                                    <td width="200px"><?= "Guwahati" ?></td>
                                    <td width="150px"><strong>Working Days:</strong></td>
                                    <td><?=$salary->salary_full_days?></td>
                                </tr>
                            </table>

                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="padding: 10px">
                            <table width="100%">
                              
                                <tr>
                                    <td><strong>Employee Name:</strong></td>
                                    <td colspan="3"><?=$salary->fullname?></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                    <tr>
                        <td width="80%" style="padding: 10px">
                            <strong>Allowances</strong>
                            <table width="100%" border="1" cellspacing="0" style="text-align: center">
                                <tr>
                                    <th>DA</th>

                                    <th>CA</th>
                                    <th>HRA</th>
                                </tr>
                                <tr>
                                    <td><?=$salary->da?></td>

                                    <td><?=$salary->ca?></td>
                                    <td><?=$salary->hra?></td>
                                </tr>
                            </table>
                            <strong>Allowances</strong>
                            <table width="100%" border="1" cellspacing="0" style="text-align: center">
                                <tr>
                                    <th>ESI</th>
                                    <th>PTAX</th>
                                    <th>PF</th>

                                    <th>LIC</th>
                                    <th>Canteen</th>
                                    <th>TDS</th>
                                </tr>
                                <tr>
                                    <td><?=$salary->esi?></td>
                                    <td><?=$salary->ptax?></td>
                                    <td><?=$salary->pf?></td>

                                    <td><?=$salary->lic?></td>
                                    <td><?=$salary->canteen?></td>
                                    <td><?=$salary->tds?></td>
                                </tr>
                            </table>
                        </td>
                        <td>
                            <table cellspacing="0" width="100%" style="text-align: center">
                                <tr>
                                    <td style="border-bottom: solid 1px #000"><strong>Basic Pay</strong></td>
                                </tr>
                                <tr>
                                    <td style="border-bottom: solid 1px #000"><?=$salary->basicpay?></td>
                                </tr>
                                <tr>
                                    <td style="border-bottom: solid 1px #000"><strong>Total Payable</strong></td>
                                </tr>
                                <tr>
                                    <td style="border-bottom: solid 1px #000"><?=$salary->total_payable?></td>
                                </tr>
                                <tr>
                                    <td style="border-bottom: solid 1px #000"><strong>Gross Payable</strong></td>
                                </tr>
                                <tr>
                                    <td style="border-bottom: solid 1px #000"><?=$salary->gross_payable?></td>
                                </tr>
                                <tr>
                                    <td style="border-bottom: solid 1px #000"><strong>Net Payable</strong></td>
                                </tr>
                                <tr>
                                    <td><?=$salary->net_payable?></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <table width="100%" style="text-align: center; visibility:visible">
                                <tbody>
                                    <tr height="70px"></tr>
                                    <tr height="40px">
                                        <td width="33%">Prepared By</td>
                                        <td width="33%">Checked By</td>
                                        <td width="33%">Passed By</td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </table>

                <?php if ($i !== 1 && $i % 2 == 0): ?>
                <div class="page-break" style="position:relative; height:75px"></div>
                <?php endif?>
                <?php $i++?>
                <?php endforeach?>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<?php include './footer.php'; ?>