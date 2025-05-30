<?php
include 'admin/db.php';
session_start();
?>
<?php
$user = $_SESSION['user'];
$query = "SELECT * from account where uname= '$user' ";
$run = mysqli_query($con, $query);
if ($run) {
    while ($row = mysqli_fetch_assoc($run)) {
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
            <title>Thông tin cá nhân của <?php echo $_SESSION['user']; ?></title>
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
                        <div class="left_bar ">
                            <div class="user_infor">
                                <div class="titile_infor">
                                    <h2>THÔNG TIN CÁ NHÂN</h2>
                                </div>
                                
                                <?php if (isset($_GET['error'])) { ?>
                                    <p class="alert"><?php echo $_GET['error']; ?></p>
                                <?php } ?>
                                <?php if (isset($_GET['success'])) { ?>
                                    <p class="success"><?php echo $_GET['success']; ?></p>
                                <?php } ?>
                                <div class="infor_acc">
                                    <div class="flex_acc">
                                        <div class="left_acc">

                                            <?php
                                                        if (empty($row['avatar'])) {
                                                            echo "<img class='user' src='/images/user.jpg' alt='ảnh đại diện'>";
                                                        } else {
                                                            echo "<img class='avatar' src='uploads/",$row['avatar'], "'alt='ảnh đại diện'>";
                                                        }
                                                        ?>
                                            <h4><?php echo $row['uname']; ?></h4>
                                            <p> NGÀY THAM GIA: <br>
                                                <?php
                                                $newdate = date("d-m-Y", strtotime($row['accdate']));
                                                echo $newdate;
                                                ?>
                                            </p>

                                        </div>
                                        <div class="right_acc">
                                            <h3>HIỂN THỊ THÔNG TIN</h3>
                                            <div class="show_infor">
                                                <div class="flex_show">
                                                    <span>Tên đầy đủ: </span>
                                                    <input type="text" disabled value="<?php echo $row['fullname']; ?> ">
                                                </div>
                                                <br>
                                                <div class="flex_show">
                                                    <span>Email: </span>
                                                    <input type="text" disabled value="<?php echo $row['email']; ?> ">
                                                </div>
                                                <br>
                                                <div class="flex_show">
                                                    <span>Quê quán: </span>
                                                    <input type="text" disabled value="<?php echo $row['address']; ?> ">
                                                </div>
                                                <br>
                                                <div class="flex_show">
                                                    <span>Giới tính: </span>
                                                    <input type="text" disabled value="<?php echo $row['gender']; ?> ">
                                                </div>
                                                <br>
                                                <div class="flex_show">
                                                    <span>Ngày sinh: </span>
                                                    <input type="text" disabled value="<?php $newdate1 = date("d-m-Y", strtotime($row['birthday']));
                                                                                        echo $newdate1; ?> ">
                                                </div>
                                                <br>

                                            </div>
                                            <div class="edit_infor">
                                                <a href="editInfor.php?id=<?php echo $row['id']; ?>">Sửa thông tin</a>
                                            </div>
                                           
                                        

                                    </div>
                                   
                                </div>
                            </div>

                        </div>

                    </div>

            <?php
        }
    }
            ?>

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
                                <p> PHIM MỚI CẬP NHẬT</p>
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

            <!-- footer -->
            <?php
            include 'footer.php';
            ?>
            <!-- <script>
                function show(anything) {
                    document.querySelector('.textbox').value = anything;
                }
                let edit = document.querySelector('.edit_info');
                let container = document.querySelector('.container_infor');
                let close = document.getElementById('movie_close');
                // document.onclick = function(e) {
                //     if (e.target.class !== 'edit_info' && e.target.class !== 'contaner_infor') {
                //         container.classList.remove('active');
                //     }
                // }
                edit.onclick = function() {
                    container.classList.toggle('active');
                }
                close.onclick = function() {
                    container.classList.remove('active');

                }
            </script> -->
        </body>