<?php

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo "Method not allowed";
    exit();
}

require_once '../admin/src/database.php';

if (isset($_POST['department'])) {

  
	$department_id = $_POST['department'];
    //print_r($department_id);die;
	$employess = [];

	$sql = "SELECT * FROM employee WHERE department = '$department_id'";
	//echo $sql;die;
	$res = $db->query($sql);
	while($row = $res->fetch_object()){
		$employess[] = $row;
	}
	//print_r($employess);die;
	http_response_code(200);
	echo json_encode($employess);

}else{
	http_response_code(400);
}
