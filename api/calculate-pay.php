<?php
ini_set('display_errors', 1);

require_once "../admin/src/database.php";
//include '../../vendor/autoload.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(400);
    echo 'Method not allowed';
    return;
}

$POST = json_decode(file_get_contents("php://input"));
//print_r($POST);die;
$validationErrors = validationBody($POST);
//http_response_code(400);
//echo json_encode($validationErrors);
if (!$validationErrors) {
    http_response_code(401);

} else {
    http_response_code(400);
    echo json_encode($validationErrors);
}

$basic_pay = $POST->basicPay;
//print_r($basic_pay);die;

/**TODO: Validation before this */

$sql = "SELECT pf_perc from pf";
$res = $db->query($sql);
$pf_perc = $res->fetch_object()->pf_perc;

$sql = "SELECT hra_perc from hra";
$res = $db->query($sql);
$hra_perc = $res->fetch_object()->hra_perc;

$sql = "SELECT perc from da";
$res = $db->query($sql);
$da_perc = $res->fetch_object()->perc;
//print_r($pf);die;

$da = 0;

/*if ($basic_pay <= 5000) {
    /** If Basic pay <= 5000 DA = 100% of Basic pay 
    $da = $basic_pay;
} elseif ($basic_pay > 5000 && $basic_pay <= 7000) {

    /** 80% of basic pay 
    $d = round($basic_pay * 80 / 100);
    $da = $d;
} elseif ($basic_pay > 7000 && $basic_pay <= 9500) {

    $d = round($basic_pay * 70 / 100);
     $da = $d; 

} elseif ($basic_pay > 9500 && $basic_pay <= 12500) {

    $d = round($basic_pay * 60 / 100);
    $da = $d;

} elseif ($basic_pay > 12500) {

    $d = round($basic_pay * 50 / 100);
    $da = $d;

}*/

if($basic_pay >=5000 && $basic_pay <=50000){
    $d = round($basic_pay * $da_perc / 100);
    $da = $d;
}

$hra = round($basic_pay * $hra_perc / 100);
$pf = round(($basic_pay + $da) * ($pf_perc) / 100);

if ($pf > 1800) {
    $pf = 1800;
}

$totalPay = $basic_pay + $da + $hra + 150 + 60;

$grossPay = round($totalPay / 30 * $POST->workingDays);

$grossPayForPtax = $totalPay / 30 * 30;

$esi = 0;
if ($grossPay <= 21000) {
    $esi = round($grossPay * 0.75 / 100);
}

$ptax = 0;

if ($grossPayForPtax <= 10000) {
    $ptax = 0;
} elseif ($grossPayForPtax > 10000 && $grossPayForPtax < 15000) {
    $ptax = 150;
} elseif ($grossPayForPtax >= 15000 && $grossPayForPtax < 25000) {
    $ptax = 180;
} elseif ($grossPayForPtax >= 25000) {
    $ptax = 208;
}

$payable = $pf + $esi + $POST->loan + $POST->salAvd + $ptax + $POST->canteen + $POST->lic + $POST->tds;
$netPay = $grossPay - round($payable);

$payload = [
    'basicPay' => round($basic_pay),
    'da' => round($da),
    'hra' => round($hra),
    'pf' => round($pf),
    'esi' => round($esi),
    'loan' => $POST->loan,
    'salAvd' => $POST->salAvd,
    'ptax' => round($ptax),
    'canteen' => $POST->canteen,
    'lic' => $POST->lic,
    'tds' => $POST->tds,
    'totalPay' => round($totalPay),
    'grossPay' => round($grossPay),
    'netPay' => round($netPay),
];
echo json_encode($payload);

function validationBody($body)
{

    $errors = new stdClass;

    $errors->basicPay = '';
    $errors->tds = '';
    $errors->loan = '';
    $errors->salAdv = '';
    $errors->canteen = '';
    $errors->lic = '';
    $errors->workingdays = '';

    $isError = false;

    /* if ($body['month'] == 'none') {
    $isError = true;
    $errors->month = "Please enter select Month";
    }*/

    if (strlen($body->basicPay) < 1) {
        $isError = true;
        $errors->basicPay = "Please enter Basic Pay";
    } else if (!filter_var($body->basicPay, FILTER_VALIDATE_INT)) {
        $isError = true;
        $errors->basicPay = 'Please enter a integer value';
    }

    if (strlen($body->tds) < 1) {
        $isError = true;
        $errors->tds = 'Please enter TDS.';
    }

    if (strlen($body->loan) < 1) {
        $isError = true;
        $errors->loan = 'Please enter Loan';
    }

    if (strlen($body->salAvd) < 1) {
        $isError = true;
        $errors->salAdv = 'Please enter Salary Advance';
    }
    if (strlen($body->canteen) < 1) {
        $isError = true;
        $errors->canteen = 'Please enter Canteen';
    }
    if (strlen($body->lic) < 1) {
        $isError = true;
        $errors->lic = 'Please enter LIC';
    }
    if (strlen($body->workingDays) < 1) {
        $isError = true;
        $errors->workingdays = 'Please enter Working Days';
    }

    if ($isError) {
        return $errors;
    } else {
        return false;
    }
}
