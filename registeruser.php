<?php
include 'admin/ft.php';
include 'admin/db.php';
?>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="stylesheet" type="text/css" href="/CSS/register.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>register</title>
</head>

<body>
  <div class="wrapper_res">
    <div class="main">

      <form action="" method="POST" class="form" id="form-1" role="form">
        <h3 class="heading">Đăng ký tài khoản</h3>
        <div class="spacer"></div>
        <?php if (isset($_GET['error'])) { ?>
          <p class="alert"><?php echo $_GET['error']; ?></p>
        <?php } ?>
        <?php if (isset($_GET['success'])) { ?>
          <p class="success"><?php echo $_GET['success']; ?></p>
        <?php } ?>
        <div class="form-group">
          <?php if (isset($_GET['uname'])) { ?>
            <input id="username" required placeholder=" " name="uname" type="text" class="form-control" value="<?php echo $_GET['uname'] ?>"><br>
          <?php } else { ?>
            <input id="username" required placeholder=" " name="uname" type="text" class="form-control" value="">
            <label for="username" class="form-label">Username</label>
          <?php } ?>
        </div>

        <div class="form-group">
          <input id="password" require placeholder=" " name="pwd" type="password" class="form-control" value="">
          <label for="password" class="form-label">Mật khẩu</label>
        </div>

        <div class="form-group">
          <input id="password_confirmation" required placeholder=" " name="repwd" type="password" class="form-control" value="">
          <label for="password_confirmation" class="form-label">Nhập lại mật khẩu</label>
        </div>
        <button id="button" class="form-submit" name="submit" type="submit">Đăng ký</button>
        <div class="sign-in">
          Bạn đã có tài khoản?
          <a href=login.php>Đăng nhập</a>
        </div>
      </form>
    </div>
  </div>
</body>
<?php

if (isset($_POST['submit'])) {
  $uname = ($_POST['uname']);
  $pwd = htmlspecialchars($_POST['pwd']);
  $repwd = htmlspecialchars($_POST['repwd']);
  $hash = password_hash("$pwd", PASSWORD_BCRYPT);
  $date = date("Y-m-d");
  $user = 'uname' . $uname;
  if ($pwd !== $repwd) {
    header("Location: registeruser.php?error=Hai password nhập không trùng nhau&$user");
    exit();
  } else if (strlen($pwd) < 8) {
    header("Location: registeruser.php?error=Mật khẩu phải nhập trên 8 kí tự&$user");
    exit();
  }
  $sql = "SELECT * FROM account WHERE uname = '$uname' ";
  $run = mysqli_query($con, $sql);
  if (mysqli_num_rows($run) > 0) {
    header("Location: registeruser.php?error=Username này đã tồn tại&$user");
    exit();
  } else {
    $query = "INSERT INTO account (`uname`, `pwd`, `role`,`accdate`) VALUES ('$uname', '$hash',2,'$date')";
    $save = mysqli_query($con, $query);
    if ($save) {
      header("Location: registeruser.php?success=Đã đăng ký thành công");
      exit();
    } else {
      header("Location: registeruser.php?error= Đã xảy ra lỗi");
    }
  }
}
?>