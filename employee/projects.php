<?php

require_once './header.php';
require_once './sidemenu.php';
require_once './src/database.php';


if (isset($_GET['update'])) {
    $id = $db->real_escape_string($_GET['update']);
    
    $sql = "UPDATE projects SET status = '1' WHERE id = '$id'";
      if ($db->query($sql) === true) {
            $msg = "status updated";
        } else {
            $error = "Failed, Please check your details and try again";
        }
}

$emp_id  = $_SESSION['emp_id'];
$sql = "SELECT * FROM assigned_projects WHERE employee = '$emp_id'";
//echo $sql;die;
$res = $db->query($sql);
$assigned_projects = [];
while ($row = $res->fetch_object()) {
    $assigned_projects[] = $row;
}

$newProj = [];
foreach( $assigned_projects as $p) {
    
  $sql = "SELECT * FROM projects WHERE id = '$p->project'" ;
  
  $res = $db->query($sql);
  while($row= $res->fetch_object()){
     $newProj[] = $row; 
  }
  //print_r($newProj);die;
  //$newProj['name'] = $res->fetch_object()->project_name;
  
}

//print_r($newProj['name']);die;
?>

<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
    <a href="#"><strong><span class="fa fa-dashboard"></span> Assigned Projects</strong></a>
    <hr>
    
    <br>
    <br>

    <table class="table table-bordered">
        <thead>
            <th>Sl No</th>
            <th>Name</th>
            <th>Status</th>

            <th>Action</th>
        </thead>
        <tbody>
          <?php $i=0; foreach($newProj as $p): ?>
                <tr>
                    <td><?php echo $i+1; ?></td>
                    <td><?php echo $p->project_name ?></td>
                  
                    <td> 

                         <?php
                                   
                             $status = $p->status == 0 ? 'On Track' : 'Finished';
                             $status_label = $p->status == 0 ? 'success' : 'danger'; ?>
                        <span class="btn btn-<?php echo $status_label?> text-uppercase"> <?php echo $status ?></span>
                    </td>
                     
                    <td>
                         <a onclick='return confirm("Are you sure?")' href="<?php echo $_SERVER['PHP_SELF'] ?>?update=<?php echo $p->id; ?>" class="btn btn-primary"> <i class="fas fa-check-double"></i>Update Status
        </a>
                    </td>

                     
                       


                    </td>
                </tr>
           <?php endforeach ?>
        </tbody>
    </table>
</div>

<?php require_once './footer.php'; ?>