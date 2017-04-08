<?php
session_start();
//var_dump($_GET);
//var_dump($_POST);
//var_dump(hash( 'sha512', $_SESSION[ 'last_action'] . 'activity_reg_send.php'));
if(!isset($_GET['id']) || !isset($_POST['title']) || !isset($_POST['durationStart']) || !isset($_POST['durationEnd']) || !isset($_POST['cost'])) {
    // Verification error
    ?>
  <!DOCTYPE html>
  <html>

  <body>
    <script>
      alert("不明原因錯誤");
      window.location.replace("activity_reg.php");
    </script>
  </body>

  </html>
  <?php
}
if($_GET['id'] !== hash( 'sha512', $_SESSION[ 'last_action'] . 'activity_reg_send.php')) {
    // Verification error
    ?>
    <!DOCTYPE html>
    <html>

    <body>
      <script>
        alert("不明原因錯誤");
        window.location.replace("activity_reg.php");
      </script>
    </body>

    </html>
    <?php
}
include 'db.php';
$sql = "INSERT INTO `activity` (`title`, `durationStart`, `durationEnd`, `cost`) VALUES ('" . $_POST['title'] . "', '" . $_POST['durationStart'] . "', '" . $_POST['durationEnd'] . "', ". $_POST['cost'] .")";
$result = $conn->query($sql);
if($result === false) {
    ?>
      <!DOCTYPE html>
      <html>

      <body>
        <script>
          alert("註冊失敗");
          window.location.replace("activity_reg.php");
        </script>
      </body>

      </html>
      <?php
}
$sql = "UPDATE `activity` SET `tableName` = CONCAT('', 'adetails', LAST_INSERT_ID()) WHERE `id` = LAST_INSERT_ID(); SELECT CONCAT('', 'adetails', LAST_INSERT_ID()) AS `tableName`;";
$result = $conn->multi_query($sql);
if($result === false) {
    ?>
        <!DOCTYPE html>
        <html>

        <body>
          <script>
            alert("註冊失敗 (更新資料)");
            window.location.replace("activity_reg.php");
          </script>
        </body>

        </html>
        <?php
}
$conn->next_result();
$result = $conn->store_result();
$row = $result->fetch_assoc();
$sql = "CREATE TABLE `" . $row['tableName'] . "` (`clientID` int(10) unsigned NOT NULL, `paid` tinyint(1) unsigned NOT NULL DEFAULT '0', `got` tinyint(1) unsigned NOT NULL DEFAULT '0') ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;";
$result = $conn->query($sql);
if($result === false) {
    ?>
          <!DOCTYPE html>
          <html>

          <body>
            <script>
              alert("註冊失敗 (建立資料表失敗)");
              window.location.replace("activity_reg.php");
            </script>
          </body>

          </html>
          <?php
}
?>
            <!DOCTYPE html>
            <html>

            <body>
              <script>
                alert("註冊成功");
                window.location.replace("index2.php");
              </script>
            </body>

            </html>
            <?php $_SESSION['last_action'] = bin2hex(openssl_random_pseudo_bytes(128)); ?>
