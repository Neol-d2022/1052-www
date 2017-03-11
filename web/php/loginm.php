<?php session_start(); ?>
  <!DOCTYPE html>
  <html lang="zh-tw">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../img/icon_linux.png">

    <title>金門領酒系統 - 登入頁面</title>
    <!-- Bootstrap core CSS -->
    <link href="../../dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="../css/mainstyle.css" rel="stylesheet">
  </head>
  <!-- Bootstrap core JavaScript
================================================== -->
  <!-- Placed at the end of the document so the pages load faster -->
  <script src="../../assets/js/vendor/jquery-3.1.1.slim.min.js"></script>
  <script>
    window.jQuery || document.write('<script src="../assets/js/vendor/jquery.min.js"><\/script>')
  </script>
  <script src="../../assets/js/vendor/tether.min.js"></script>
  <script src="../../dist/js/bootstrap.min.js"></script>
  <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
  <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
  <!-- Custom JS for this -->
  <!--script src="XXX.js"></script-->
  <!-- Modal -->
  <div id="LoginSuccessModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h3 class="modal-title">登入狀態</h3>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <h1>登入成功!</h1>
            <p><a href="pay.php">3秒後跳轉，點我直接跳轉。</a></p>
            <p></p>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary btn-lg" onclick="window.location.href='./pay.php'">確認</button>
        </div>
      </div>
    </div>
  </div>
  <!--Modal End-->
  <!-- Modal -->
  <div id="AlreadyLoggedinModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h3 class="modal-title">登入狀態</h3>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <h1>您已經登入了!</h1>
            <p></p>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary btn-lg" onclick="window.location.href='./index.php'">確認</button>
        </div>
      </div>
    </div>
  </div>
  <!--Modal End-->
  <!-- Modal -->
  <div id="LoginPasswordIncorrectModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h3 class="modal-title"></h3>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <h1>密碼錯誤!</h1>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary btn-lg" onclick="window.location.href='./index.php'">確認</button>
        </div>
      </div>
    </div>
  </div>
  <!--Modal End-->

  </body>

  </html>

  <?php
if(isset($_SESSION['login'])) {
    ?>
    <!DOCTYPE html>
    <html>

    <body>
      <script>
        //alert("您已經登入");
        //window.location.replace("index.php");
        $("#AlreadyLoggedinModal").modal('show');
        setTimeout(function() {
          window.location.href = './index.php';
        }, 3000);
      </script>
    </body>

    </html>
    <?php
}
else {
    $conn = new mysqli("db", "pi", "pi", "pi");
    mysqli_set_charset($conn, "utf8");
    if ($conn->connect_error) {
        die("DB Connection failed: " . $conn->connect_error);
    }
    $sql = "SELECT clientID, name FROM clients WHERE id = \"" . $_POST["id"] . "\" AND pw = \"" . $_POST["pwd"] . "\"";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['login'] = $row["clientID"];
        $_SESSION['login_name'] = $row["name"];
        $_SESSION['last_action'] = '';
        //echo "登入成功<br />";
        ?>
      <!DOCTYPE html>
      <html>

      <body>
        <script>
          //alert("登入成功");
          //window.location.replace("index.php");
          $("#LoginSuccessModal").modal('show');
          setTimeout(function() {
            window.location.href = './pay.php';
          }, 3000);
        </script>
      </body>

      </html>
      <?php
        $conn->close();
    }
    else {
        //echo "帳號密碼錯誤<br />";
        ?>
        <!DOCTYPE html>
        <html>

        <body>
          <script>
            //alert("帳號密碼錯誤");
            //window.location.replace("index.php");
            $("#LoginPasswordIncorrectModal").modal('show');
            setTimeout(function() {
              window.location.href = './index.php';
            }, 3000);
          </script>
        </body>

        </html>
        <?php
    }
}
?>
