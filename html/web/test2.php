<!DOCTYPE html>
<html lang="zh-tw">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="./img/icon_linux.png">
  <title>金門領酒系統</title>
  <!-- Bootstrap core CSS -->
  <link href="../dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="./css/mainstyle.css" rel="stylesheet">
  <link rel="import" href="./page/modals.php">
</head>
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="../assets/js/vendor/jquery-3.1.1.slim.min.js"></script>
<script>
  window.jQuery || document.write('<script src="../assets/js/vendor/jquery.min.js"><\/script>')
</script>
<script src="../assets/js/vendor/tether.min.js"></script>
<script src="../dist/js/bootstrap.min.js"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="../assets/js/ie10-viewport-bug-workaround.js"></script>
<!-- Custom JS for this -->
<!--script src="XXX.js"></script-->
</html>
<?php
session_start();

    ?>
  <body>
    <?php include 'nav.php'; ?>
      <div class="container">
        <main class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3">
          <h2>帳戶資訊</h2>
          <div class="table-responsive">
            <?php
              include 'db.php';
               $mac ='64:09:80';
               //$sql1="SELECT org_name FROM oui WHERE asgmt=\"" . $mac . "\"";//64:09:80
               $sql1="SELECT * FROM `oui` WHERE asgmt LIKE '%$mac%'";
               $res=$conn->query($sql1); 
               $r = $res->fetch_assoc();
               echo $r['org_name'];
               ?>
               <p></p>
               <?php
               $mac ='64:09:80';
               $sql1="SELECT org_name FROM oui WHERE asgmt=\"" . $mac . "\"";//64:09:80
               $res=$conn->query($sql1); 
               $r = $res->fetch_assoc();
               echo $r['org_name'];
            ?>
              
          </div>
          <hr />
          
          <hr />
        </main>
        <?php include 'footer.php'; ?>
      </div>
  </body>
  <?php


?>
      <?php $_SESSION['last_action'] = bin2hex(openssl_random_pseudo_bytes(128)); ?>
