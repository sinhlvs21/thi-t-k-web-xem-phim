<?php
session_start();
include 'admin/ft.php';
include 'admin/db.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="/CSS/login.css">
</head>

<body>
    <div class="wrapper_login">
        <div class="main">
            <form action="" method="POST" class="form" id="form-2">
                <h3 class="heading">Đăng nhập vào VSH Movie</h3>
                <div class="spacer"></div>
                <?php if (isset($_GET['error'])) { ?>
                    <p class="alert"><?php echo $_GET['error']; ?></p>
                <?php } ?>

                <div class="form-group">
                    <input id="fullname" required placeholder=" " name="uname" type="text" class="form-control">
                    <label for="fullname" class="form-label">Username</label>
                </div>

                <div class="form-group">
                    <input id="password" required placeholder=" " name="pwd" type="password" class="form-control">
                    <label for="password" class="form-label">Mật khẩu</label>
                </div>

                <button class="form-submit" type="submit" name="submit">Đăng Nhập</button>
                <div class="sign-up">
                    Bạn chưa có tài khoản? 
                    <a href=registeruser.php>Tạo mới</a>
                </div>
                <div class="home">
                    <a href="home.php">Về trang chủ</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
<?php
if (isset($_POST['submit'])) {
    $user = htmlspecialchars($_POST['uname']);
    $pwd = htmlspecialchars($_POST['pwd']);
    $query = "SELECT * FROM account WHERE uname = '$user'";
    $run = mysqli_query($con, $query);
    if (mysqli_num_rows($run) > 0) {
        while ($row = mysqli_fetch_assoc($run)) {
            if (password_verify($pwd, $row['pwd'])) {
                if($row['role']==1){

                $_SESSION['user'] = $user;
                setcookie("user", $user, time() + (86400 * 60));
                setcookie("pwd", $pwd, time() + (86400 * 60));
                echo "<script> window.location.href='admin/dashboard.php?';</script>";
            }else{
                $_SESSION['user'] = $user;
                setcookie("user", $user, time() + (86400 * 60));
                setcookie("pwd", $pwd, time() + (86400 * 60));
                echo "<script> window.location.href='homeLogin.php';</script>";
            } 
        }else {
            header("Location: login.php?error=Vui lòng nhập lại mật khẩu");
            exit();
        }
    }
    } else {
        header("Location: login.php?error=Vui lòng nhập lại tài khoản");
        exit();
    }
}
?>