<?php
ini_set('display_errors', 1);
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo "Method not allowed";
    exit();
}

require_once '../admin/src/database.php';


$empno = $_POST['emp-name'];
$sql = "SELECT name from employee where id = '$empno'";
$res = $db->query($sql);
$emp_name = $res->fetch_object()->name;

//print_r($emp_name);die;

//$emp_no = $db->real_escape_string($_POST['emp-no']);
$month = $db->real_escape_string($_POST['month']);
$year = $db->real_escape_string($_POST['year']);
$salary_full_days = $db->real_escape_string($_POST['working-days']);
$basicpay = $db->real_escape_string($_POST['basic-pay']);
$da = $db->real_escape_string($_POST['da']);
$ma = $db->real_escape_string($_POST['ma']);
$ca = $db->real_escape_string($_POST['ca']);
$hra = $db->real_escape_string($_POST['hra']);
$total_pay = $db->real_escape_string($_POST['total-pay']);
$gross_pay = $db->real_escape_string($_POST['gross-pay']);
$pf = $db->real_escape_string($_POST['pf']);
$esi = $db->real_escape_string($_POST['esi']);
$loan = $db->real_escape_string($_POST['loan']);
$sal_adv = $db->real_escape_string($_POST['sal-avd']);
$ptax = $db->real_escape_string($_POST['ptax']);
$lic = $db->real_escape_string($_POST['lic']);
$canteen = $db->real_escape_string($_POST['canteen']);
$tds = $db->real_escape_string($_POST['tds']);
$netpay = $db->real_escape_string($_POST['net-pay']);
//$category = $db->real_escape_string($_POST['category']);

try {

    $sql = "INSERT INTO salaryHistory (
        month,
        year,
        salary_full_days,
        basicpay,
        da,
        ma,
        ca,
        hra,
        total_payable,
        gross_payable,
        pf,
        esi,
        ptax,
        lic,
        canteen,
        tds,
        net_payable,
        fullname
       ) values(
       
         '$month',
         '$year',
         '$salary_full_days',
         '$basicpay',
         '$da',
         '$ma',
         '$ca',
         '$hra',
         '$total_pay',
         '$gross_pay',
         '$pf',
         '$esi',
         '$ptax',
         '$lic',
         '$canteen',
         '$tds',
         '$netpay',
         '$emp_name'
        )";

    //echo $sql;die;
    if ($db->query($sql) === false) {
        throw new Exception($db->error);
    }

    $response = array(
        'status' => 200,
        'msg' => 'Salary details saved successfully',
    );
    echo json_encode($response);

} catch (Exception $e) {
    if ($db->insert_id) {
        $sql = "DELETE FROM salaryHistory WHERE id = '$db->insert_id'";
        $db->query($sql);
    }
    $response = array(
        'status' => 404,
        'error' => 'Failed to upload',
    );
    echo json_encode($response);
}
