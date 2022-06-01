<?php

require_once './header.php';
require_once './sidemenu.php';
require_once './src/database.php';
?>

<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
    <a href="#"><strong><span class="fa fa-dashboard"></span> My Dashboard</strong></a>
    <hr>
    <h2 >welcome: <span class="text-primary"><?php echo $_SESSION['name']?> </span></h2>
    <?php
      $dept_id = $_SESSION['department'];
     $sql = "SELECT * FROM department where id = '$dept_id'";
      $res = $db->query($sql);
      $dept = $res->fetch_object()->name;
     ?>
    <h4>Department:  <?php echo $dept ?></h4>

</div>

<?php require_once './footer.php';?>