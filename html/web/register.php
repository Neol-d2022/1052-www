<?php session_start(); ?>
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
    <script>
        idRule = /^[A-Za-z]{1}[1-2]{1}[0-9]{8}$/
        nameRule = /^[\u4E00-\u9FA5a-zA-Z]{2,10}$/
        emailRule = /^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z]+$/
        phoneRule = /^[09]{2}[0-9]{8}$/
        passwdRule = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,30}$/

        function idTest() {
            var str = document.getElementById("ID").value
            if(!str){document.getElementById("id_error").innerHTML = "不可輸入為空!"}
            else if(!idRule.test(str)){
                document.getElementById("id_error").innerHTML = "你的身分證格式輸入錯誤！"
            }else{
                document.getElementById("id_error").innerHTML = ""
                return true
            }
        }
        function nameTest() {
            var str = document.getElementById("Name").value
            if(!str){document.getElementById("name_error").innerHTML = "不可輸入為空!"}
            else if(!nameRule.test(str)){
                document.getElementById("name_error").innerHTML = "姓名不能包含特殊字元！"
            }else{
                document.getElementById("name_error").innerHTML = ""
                return true
            }
        }
        function emailTest() {
            var str = document.getElementById("EmailAddress").value
            if(!str){document.getElementById("email_error").innerHTML = "不可輸入為空!"}
            else if(!emailRule.test(str)){
                document.getElementById("email_error").innerHTML = "你的信箱格式輸入錯誤！"
            }else{
                document.getElementById("email_error").innerHTML = ""
                return true
            }
        }
        function phoneTest() {
            var str = document.getElementById("PhoneNumber").value
            if(!str){document.getElementById("phone_error").innerHTML = "不可輸入為空!"}
            else if(!phoneRule.test(str)){
                document.getElementById("phone_error").innerHTML = "你的手機號碼輸入錯誤！"
            }else{
                document.getElementById("phone_error").innerHTML = ""
                return true
            }
        }
        function pwTest() {
            var str1 = document.getElementById("Passwd").value
            var str2= document.getElementById("PasswdAgain").value
            if(!str1){document.getElementById("pw_error").innerHTML = "不可輸入為空!"}
            else if(!passwdRule.test(str1)){
                document.getElementById("pw_error").innerHTML = "你的密碼至少6到30字元以上，並包含一大寫英文一小寫英文！"
            }else{
                document.getElementById("pw_error").innerHTML = ""
            }
            if(!str2){document.getElementById("pwAgain_error").innerHTML = "不可輸入為空!"}
            else if(str1 != str2){
                document.getElementById("pwAgain_error").innerHTML = "密碼輸入不一致！"
            }else{
                document.getElementById("pwAgain_error").innerHTML = ""
                return true
            }
        }
        function checkform(){
            if(idTest()&&nameTest()&&emailTest()&&phoneTest()&&pwTest()){
                document.getElementById("signupform").submit()
            }
        }
    </script>
  </head>
  <?php
    //echo "Connected successfully";
    include 'db.php';
    //set validation error flag as false
    $error = false;
    //check if form is submitted
    //var_dump($_POST);
    if (isset($_POST['Name']) && isset($_POST['EmailAddress']) && isset($_POST['EmailAddress']) && isset($_POST['PhoneNumber']) && isset($_POST['Passwd']) && isset($_POST['ID']))
    {
        $name = mysqli_real_escape_string($conn, $_POST['Name']);
        $email = mysqli_real_escape_string($conn, $_POST['EmailAddress']);
        $phone = mysqli_real_escape_string($conn, $_POST['PhoneNumber']);
        $password = mysqli_real_escape_string($conn, $_POST['Passwd']);
        $id = mysqli_real_escape_string($conn, $_POST['ID']);
        //因為多了EMAIL請於資料庫clients新增信箱欄位
        $sql1 = "SELECT COUNT(*) AS num FROM clients WHERE id = \"" . $id . "\"";
        $res=$conn->query($sql1);
        $r = $res->fetch_assoc();
        $n = $r['num'];//沒有找到是0有是1
        if($n) {
            $error=true;
            $errormsg="此帳號已經註冊了!請直接登入。";
        }

        if (!$error) {
            if(mysqli_query($conn, "INSERT INTO clients (pw, name, phone, id, email)VALUES ('" . $password . "', '" . $name . "', '" . $phone . "', '" . $id . "', '" . $email . "')")) {
               $successmsg = "註冊成功!";
            } else {
               $errormsg = "註冊失敗...請稍後再試!";
            }
       }
        
    }
    $conn->close();
?>
  <body>
    <!--?php include 'nav.php'; ?-->
    <div class="container">
      <!--/row-->
      <hr>
    <div class="row">
        <div class="col-md-4 col-md-offset-4 well">
            <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="signupform" id="signupform">
                <fieldset>
                    <h1>註冊帳戶</h1>

                    <div class="form-group">
                        <label for="Name"></label>
                        <input type="text" name="Name" id="Name" placeholder="請輸入名字" onchange="nameTest()" required value="<?php if($error) echo $name; ?>" class="form-control form-control-lg" />
                        <span class="text-danger" id="name_error"></span>
                    </div>
                    
                    <div class="form-group">
                        <label for="ID"></label>
                        <input type="text" name="ID" id="ID" placeholder="請輸入身分證" onchange="idTest()" required value="<?php if($error) echo $id; ?>" class="form-control form-control-lg" />
                        <span class="text-danger" id="id_error"></span>
                    </div>

                    <div class="form-group">
                        <label for="Passwd"></label>
                        <input type="password" name="Passwd" id="Passwd" placeholder="請輸入密碼" onchange="pwTest()" required class="form-control form-control-lg" />
                        <span class="text-danger" id="pw_error"></span>
                    </div>

                    <div class="form-group">
                        <label for="PasswdAgain"></label>
                        <input type="password" id="PasswdAgain" placeholder="重複輸入密碼" onchange="pwTest()" required class="form-control form-control-lg" />
                        <span class="text-danger" id="pwAgain_error"></span>
                    </div>

                    <div class="form-group">
                        <label for="EmailAddress"></label>
                        <input type="text" name="EmailAddress" id="EmailAddress" placeholder="請輸入電子信箱" onchange="emailTest()" required value="<?php if($error) echo $email; ?>" class="form-control form-control-lg" />
                        <span class="text-danger" id="email_error"></span>
                    </div>

                    <div class="form-group">
                        <label for="PhoneNumber"></label>
                        <input type="text" name="PhoneNumber" id="PhoneNumber" placeholder="請輸入手機號碼" onchange="phoneTest()" required value="<?php if($error) echo $phone; ?>" class="form-control form-control-lg" />
                        <span class="text-danger" id="phone_error"></span>
                    </div>
                    <div class="form-group">
                        <input  type="button" name="signup"  value="Sign Up" onclick="checkform()" class="btn btn-primary" />
                    </div>
                </fieldset>
            </form>
            <span class="text-success"><?php if (isset($successmsg)) { echo $successmsg; } ?></span>
            <span class="text-danger"><?php if (isset($errormsg)) { echo $errormsg; } ?></span>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-md-offset-4 text-center">    
        你已經註冊了嗎? <a href="index2.php">點我登入</a>
        </div>
    </div>
      <?php include 'footer.php'; ?>
    </div>
    <!--/.container-->
  </body>

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
  <!-- Custom Modal for this -->
    <script>
      var link = document.querySelector('link[rel="import"]');
      var content = link.import;
      // Grab DOM from modals.html's document.
      var el = content.querySelector('.modals');
      document.body.appendChild(el.cloneNode(true));

    </script>
    <!-- Custom JS for this -->
    <script src="./js/main.js"></script>

</html>
  <?php $_SESSION['last_action'] = bin2hex(openssl_random_pseudo_bytes(128)); ?>
