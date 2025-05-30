<?php
include 'admin/db.php';
session_start();

?>
<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM `movie` WHERE id=$id";
    $run = mysqli_query($con, $query);
    if ($run) {
        while ($row = mysqli_fetch_assoc($run)) {

?>

            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link href="https://unpkg.com/ionicons@4.5.10-0/dist/css/ionicons.min.css" rel="stylesheet">
                <meta property="fb:admins" content="&#123;100050151532306&#125;" />
                <link rel="stylesheet" href="https://cdnjs.cloudfla're.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css" />
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
                <link rel="stylesheet" type="text/css" href="/CSSPage/episode.css">
                <title>Phim <?php echo $row['mv_name']; ?></title>
            </head>

            <body>
                <?php
                if (isset($_SESSION['user'])) {
                    include_once 'headerLogin.php';
                } else {
                    include_once 'header.php';
                }
                ?>
                <div class="wrapper_es">
                    <div class="main_es">
                        <div class="flex_es">
                            <div class="left_es">
                                <div class="video">
                                    <?php
                                    $id = $_GET['id'];
                                    $es_id = $_GET['es_id'];
                                    $query = "SELECT * FROM  episode where mv_id=$id and id=$es_id ";
                                    $run = mysqli_query($con, $query);
                                    if ($run) {
                                        while ($row = mysqli_fetch_assoc($run)) {
                                    ?>
                                            <iframe width="880" height="560" src="<?php echo $row['es_url'] ?>" title="Phim" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

                                    <?php
                                        }
                                    }
                                    ?>
                                </div>
                                <div class="show_es">
                                    <div class="title_es">
                                        </p>
                                        <ion-icon name="play-circle"></ion-icon> Số tập phim </p>
                                    </div>
                                    <span class="episode">
                                        <?php
                                        $id = $_GET['id'];
                                        $query1 = "SELECT * FROM episode where mv_id=$id";
                                        $run1 = mysqli_query($con, $query1);
                                        if ($run1) {
                                            while ($row1 = mysqli_fetch_assoc($run1)) {
                                        ?>
                                                <span>
                                                    <a href="episode.php?id=<?php echo $row1['mv_id']; ?>&es_id=<?php echo $row1['id']; ?>"><?php echo $row1['es_name'] ?> </a>
                                                </span>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </span>
                                </div>
                                <div class="information_mv">
                                    <?php

                                    if (isset($_GET['id'])) {
                                        $id = $_GET['id'];
                                        $query = "SELECT * FROM `movie` WHERE id=$id";
                                        $run = mysqli_query($con, $query);
                                        if ($run) {
                                            while ($row = mysqli_fetch_assoc($run)) {

                                    ?>
                                                <div class="information_bg">
                                                    <img src="<?php echo $row['mv_bg']; ?>">
                                                </div>
                                                <div class="information_poisition">
                                                    <div class="information_images">
                                                        <img src="<?php echo $row['mv_img']; ?>">
                                                    </div>
                                                    <div class="information_deces">
                                                        <h3><?php echo $row['mv_name']; ?></h3>
                                                        <p class="deces"><?php echo $row['mv_deces']; ?></p>
                                                        <div class="line"></div>
                                                        <div class="icon_detail">
                                                            <ion-icon name="calendar"></ion-icon> <?php echo $row['mv_date']; ?>
                                                            <ion-icon name="time"></ion-icon> <?php
                                                                                                $id = $row['id'];
                                                                                                $query2 = "SELECT * from movie,year where movie.mv_year = year.id and movie.id=$id";
                                                                                                $run2 = mysqli_query($con, $query2);
                                                                                                if ($run2) {

                                                                                                    while ($row2 = mysqli_fetch_assoc($run2)) {
                                                                                                        echo $row2['year'];
                                                                                                    }
                                                                                                }
                                                                                                ?>
                                                            <ion-icon name="eye"></ion-icon> <?php echo $row['mv_view']; ?> Lượt xem
                                                        </div>

                                                    </div>
                                                </div>
                                    <?php
                                            }
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="right_es">
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
                                        <!-- 
        Plugin facebook -->

                                        <div class="quiz">
                                            <div class="quiz_text">
                                                <strong>Chuyên mục hỏi và trả lời.Đây là web đồ án của nhóm mong các bạn ủng hộ</strong>
                                                <p>Xem thêm Page Facebook <a href="https://www.facebook.com/profile.php?id=100086581351351">Tại đây</a></p>
                                            </div>
                                            <div id="fb-root"></div>
                                            <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v15.0" nonce="aQlDu7tj"></script>
                                            <div class="fb-comments" data-href="http://localhost/3000" data-width="300" data-numposts="3" data-colorscheme="light"></div>
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
                <footer>
                    <?php
                    include 'footer.php';
                    ?>
                </footer>

                <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.js"></script>
                <script type="module" src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons/ionicons.esm.js"></script>
                <script nomodule="" src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons/ionicons.js"></script>
            </body>
<?php
        }
    }
}
?>