<?php
include 'admin/db.php';
session_start();
$msg = "";
?>
<?php

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "SELECT * FROM `account` WHERE id=$id";
    $run1 = mysqli_query($con, $query);
    if ($run1) {
        while ($row = mysqli_fetch_assoc($run1)) {


?>

            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link href="https://unpkg.com/ionicons@4.5.10-0/dist/css/ionicons.min.css" rel="stylesheet">

                <link rel="stylesheet" href="https://cdnjs.cloudfla're.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css" />
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
                <link rel="stylesheet" type="text/css" href="/CSSPage/userInfor.css">
                <title>Sửa thông tin cá nhân</title>
            </head>

            <body>
                <!-- Header -->

                <?php
                if (isset($_SESSION['user'])) {
                    include_once 'headerLogin.php';
                } else {
                    include_once 'header.php';
                }
                ?>
                <div class="wrapper_infor">
                    <div class="main_infor">
                        <div class="full_bar">
                            <div class="left_bar left_edit">
                                <h2 class="titile_edit_info">Sửa thông tin cá nhân</h2>
                                <?php
                                echo $msg;
                                ?>
                                <div class="container_infor">

                                    <form action="#" method="Post" enctype="multipart/form-data">


                                        <div class="row">

                                            <div class="col">

                                                <h3 class="title">Sửa thông tin</h3>

                                                <div class="inputBox">
                                                    <span>Tên đầy đủ :</span>
                                                    <input type="text" value="<?php echo $row['fullname']; ?>" name="fullname" placeholder="VD: Đào Xuân Vinh">
                                                </div>
                                                <div class="inputBox">
                                                    <span>Email : <small>(Đúng định dạng email)</small></span>
                                                    <input type="email" value="<?php echo $row['email']; ?>" name="email" placeholder="VD: vinhhttt@gmail.com">
                                                </div>
                                                <div class="inputBox">
                                                    <span>Địa chỉ :</span>
                                                    <input type="text" value="<?php echo $row['address']; ?>" name="address" placeholder="VD: Học Viện Nông Nghiệp">
                                                </div>


                                            </div>


                                            <div class="col">

                                                <h3 class="title">cá nhân</h3>

                                                <div class="inputBox">
                                                    <span>Sinh nhật : <small>(Số tuổi phải lớn hơn 10)</small></span>
                                                    <input type="date" value="<?php echo $row['birthday']; ?>" name="birthday" placeholder="VD: 16-06-2001">
                                                </div>
                                                <div class="inputBox">
                                                    <span>Giới tính :</span>
                                                    <input list="genders" name="gender" value="<?php echo $row['gender']; ?>" id="gender">
                                                    <datalist id="genders">
                                                        <option value="Nam">
                                                        <option value="Nữ">
                                                        <option value="LGBT">
                                                    </datalist>
                                                </div>
                                                <div class="inputBox">
                                                    <span>Upload ảnh đại diện : <small>(Có thể để trống)</small></span>
                                                    <input type="file" name="img" value="<?php echo $row['avatar'] ?>">
                                                </div>
                                            </div>
                                            <input type="submit" name="submit" value="Sửa thông tin" class="submit-btn edit">


                                    </form>
                                </div>
                    <?php
                }
            }
        }
                    ?>
                            </div>
                        </div>
                        <div class="right_bar">
                            <div class="right">
                                <div class="container_right">

                                    <!-- Random  -->

                                    <div class="random">
                                        <div class="random_mv">
                                            <div class="tittle_random">
                                                <p>Hôm nay xem gì?</p>
                                            </div>
                                            <p class="text_random">Nếu bạn buồn phiền không biết xem gì hôm nay. Hãy để chúng tôi chọn cho bạn</p>
                                            <?php
                                            $query1 = "SELECT *,count(*)  as total FROM movie";
                                            $run2 = mysqli_query($con, $query1);
                                            if ($run2) {
                                                while ($row2 = mysqli_fetch_assoc($run2)) {
                                            ?>
                                                    <a href="detail.php?id=<?php echo (rand(1, $row2['total'])); ?>&genre_id=<?php echo $row2['genre_id']; ?>">Xem phim <strong>Ngẫu Nhiên</strong></a>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <!-- List phim moi cap nhat -->

                                    <div class="new_mv">
                                        <div class="titile_new">
                                            <p> ANIME MỚI CẬP NHẬT</p>
                                        </div>
                                        <hr>
                                        <br>
                                        <div class="flex_list">
                                            <?php
                                            $query = "SELECT * FROM movie  ORDER BY id DESC limit 12";
                                            $run = mysqli_query($con, $query);
                                            if ($run) {
                                                while ($row = mysqli_fetch_assoc($run)) {
                                            ?>
                                                    <div class="list_new">
                                                        <div class="name_list">
                                                            <a href="detail.php?id=<?php echo $row['id'] ?>&genre_id=<?php echo $row['genre_id'] ?>">
                                                                <p> <?php
                                                                    if (strlen($row['mv_name']) > 20) {
                                                                        echo mb_substr($row['mv_name'], 0, 20) . "... ";
                                                                    } else {
                                                                        echo $row['mv_name'];
                                                                    }
                                                                    ?></p>
                                                            </a>
                                                        </div>
                                                        <div class="es_list">
                                                            <?php
                                                            $id = $row['id'];
                                                            $query1 = "SELECT * FROM episode where mv_id=$id order by id DESC limit 1 ";
                                                            $run1 = mysqli_query($con, $query1);
                                                            if ($run1) {
                                                                while ($row1 = mysqli_fetch_assoc($run1)) {
                                                            ?>

                                                                    <p><?php echo $row1['es_name']; ?></p>

                                                            <?php
                                                                }
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
                </div>
                <!-- footer -->
                <?php
                include 'footer.php';
                ?>


            </body>
            <?php

            if (isset($_POST['submit'])) {
                $id = $_GET['id'];
                $fullname  = $_POST['fullname'];
                $email = $_POST['email'];
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    echo "<div class='noti'> 
                            <h2> Thông báo lỗi </h2>
                            <p> Xảy ra lỗi về định dạng email </p>
                         </div>";
                    exit();
                }
                $address = $_POST['address'];
                $birthday = date("Y-m-d", strtotime($_POST['birthday']));
                $newbir = date("Y", strtotime("$birthday"));
                $now = date("Y");
                $nowday = date("Y-m-d");
                if ($nowday < $birthday) {
                    echo "<div class='noti'> 
                            <h2> Thông báo lỗi </h2>
                            <p> Ngày này quá thời gian thực </p>
                         </div>";
                    exit();
                } else if (($now - $newbir) < 10) {
                    echo "<div class='noti'> 
                               <h2> Thông báo lỗi </h2>
                               <p> Số tuổi phải lớn hơn 10 </p>
                            </div>";
                    exit();
                }


                $gender = $_POST['gender'];
                $img = basename($_FILES['img']['name']);
                $target_dir = "uploads/";
                $target_file = $target_dir . $img;

                if (empty($img)) {
                    $query5 = "SELECT * FROM `account` WHERE id=$id";
                    $run5 = mysqli_query($con, $query5);
                    if ($run5) {
                        while ($row5 = mysqli_fetch_assoc($run5)) {
                            $img = $row5['avatar'];
                            $target_dir = "uploads/";
                            $target_file = $target_dir . $img;
                        }
                    }
                } else {
                    $target_dir = "uploads/";
                    $target_file = $target_dir . $img;
                    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                    if (
                        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                        && $imageFileType != "gif"
                    ) {
                        echo "<div class='noti'> 
                               <h2> Thông báo lỗi </h2>
                               <p> Xảy ra lỗi về định dạng đuôi ảnh </p>
                            </div>";
                        exit();
                    }
                }

                move_uploaded_file($_FILES["img"]["tmp_name"], $target_file);
                $sql = "UPDATE `account` SET `email`='$email',`fullname`='$fullname',`avatar`='$img',`address`='$address',`birthday`='$birthday',`gender`='$gender' WHERE id=$id";
                $run = mysqli_query($con, $sql);
                if ($run) {
                    echo "<div class='noti success_noti'> 
                            <h2> Thông báo thành công </h2>
                            <p> Đã sửa thông tin thành công </p>
                         </div>";
                    echo "<script> window.location.href='userInfor.php?id=$id' </script>";
                    exit();
                } else {
                    echo "<div class='noti'> 
                            <h2> Thông báo lỗi </h2>
                            <p> Đã xảy ra lỗi về database </p>
                         </div>";
                    exit();
                }
            }


            ?>