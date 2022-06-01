<?php

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo "Method not allowed";
    exit();
}

require_once '../admin/src/database.php';

if (isset($_POST['emp_id'])) {

  
	$emp_id = $_POST['emp_id'];
    //print_r($emp_id);die;
	$employess = [];

	$sql = "SELECT * FROM employee WHERE id = '$emp_id'";
	//echo $sql;die;
	$res = $db->query($sql);
	while($row = $res->fetch_object()){
		$employess[] = $row;
	}

	$empWithDept = [];
	
	foreach($employess as $e){
		
		$sql = "SELECT name FROM department where id = '$e->department'";
		
		$res = $db->query($sql);
		//$employess['dept'] = $res->fetch_object()->name;
		//$employess[] = $empWithDept;
		//print_r($employess);die;
		$e->dept_name = $res->fetch_object()->name;
		
		$empWithDept = $e;
		 

	}
	
	http_response_code(200);
	echo json_encode($empWithDept);

}else{
	http_response_code(400);
}
