<?php
session_start();
?>
  <!DOCTYPE html>

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="./img/icon_linux.png">
    <title>金門領酒系統 - 領酒期註冊頁面</title>
    <link href="../dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="./css/mainstyle.css" rel="stylesheet">

  </head>

  <body>
    <?php include 'nav.php'; ?>
      <div class="container">
        <main class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3">
          <h2>領酒期資訊</h2>
          <div class="table-responsive">
            <?php
//include 'db.php';
//$sql = "SELECT clientID, name, phone, id FROM clients WHERE clientID = \"" . $_SESSION['login'] . "\"";
//$result = $conn->query($sql);
//$row = $result->fetch_assoc();
//$conn->close();
$_SESSION['last_action'] = bin2hex(openssl_random_pseudo_bytes(128));
?>
              <form method="POST" action="activity_reg_send.php?id=<?php echo hash( 'sha512', $_SESSION[ 'last_action'] . 'activity_reg_send.php'); ?>">
                <table class="table table-striped">
                  <tbody>
                    <tr>
                      <td><b>標題</b></td>
                      <td>
                        <input type="text" name="title" placeholder="106 - 春季" />
                      </td>
                    </tr>
                    <tr>
                      <td><b>開始日期</b></td>
                      <td>
                        <input type="text" name="durationStart" placeholder="2017-03-01" />
                      </td>
                    </tr>
                    <tr>
                      <td><b>結束日期</b></td>
                      <td>
                        <input type="text" name="durationEnd" placeholder="2017-04-30" />
                      </td>
                    </tr>
                    <tr>
                      <td><b>價格</b></td>
                      <td>
                        <input type="text" name="cost" placeholder="4800" />
                      </td>
                    </tr>
                  </tbody>
                </table>
                <input type="submit" value="確認修改" />
              </form>
          </div>
          <hr />
          <a href="detail.php">返回檢視</a>
          <hr />
        </main>
        <?php include 'footer.php'; ?>
      </div>
      <script src="../assets/js/vendor/jquery-3.1.1.slim.min.js"></script>
      <script>
        window.jQuery || document.write('<script src="../assets/js/vendor/jquery.min.js"><\/script>')
      </script>
      <script src="../assets/js/vendor/tether.min.js"></script>
      <script src="../dist/js/bootstrap.min.js"></script>
      <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
      <script src="../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
