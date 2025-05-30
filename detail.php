<?php
include 'admin/db.php';

session_start();
if (!isset($_SESSION['user'])) {

?>
    <?php

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $update = "UPDATE movie set mv_view=mv_view+1 where id=$id ";
        $run1 = mysqli_query($con, $update);
        $query = "SELECT * FROM `movie` WHERE id=$id";
        $run = mysqli_query($con, $query);

        if ($run) {
            while ($row = mysqli_fetch_assoc($run)) {
                if (!$row['mv_role'] == 'VIP') {



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
                        <link rel="stylesheet" type="text/css" href="/CSSPage/detail.css">
                        <title>Chi tiết phim <?php echo $row['mv_name']; ?></title>
                    </head>

                    <body>
                        <!-- Header -->
                        <?php
                        include_once 'header.php';
                        ?>

                        <div class="wrapper_detail">
                            <div class="main_detail">
                                <div class="flex_detail">
                                    <div class="left_detail">
                                        <div class="info_detail">
                                            <div class="img_detail">
                                                <img src="<?php echo $row['mv_bg']; ?>">

                                            </div>

                                            <div class="infor_moive">
                                                <div class="img_link">



                                                    <div class="overlay_detail"></div>
                                                    <div id="favorite">
                                                       
                                                            <ion-icon name="heart" class="heart_fav"></ion-icon>
                                                          
                                                    </div>
                                                    <img src="<?php echo $row['mv_img']; ?>">
                                                    <a href="episode.php?id=<?php echo $row['id']; ?>&es_id=<?php
                                                                                                            $id = $row['id'];
                                                                                                            $query1 = "SELECT * FROM episode where mv_id=$id order by id limit 1 ";
                                                                                                            $run1 = mysqli_query($con, $query1);
                                                                                                            if ($run1) {
                                                                                                                while ($row1 = mysqli_fetch_assoc($run1)) {
                                                                                                                    echo $row1['id'];
                                                                                                                }
                                                                                                            }
                                                                                                            ?>">
                                                        <div class="watch">
                                                            <p>
                                                                XEM PHIM
                                                            </p>
                                                        </div>
                                                    </a>
                                                </div>
                                                <div class="deces_detail">
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
                                        </div>

                                        <!-- Switch tabs -->

                                        <div class="switch_tabs">
                                            <ul class="tabs">
                                                <li>
                                                    <ion-icon name="book"></ion-icon> Thông tin phim
                                                </li>
                                                <li>
                                                    <ion-icon name="film"></ion-icon> Trailer phim
                                                </li>
                                            </ul>

                                            <div class="container_tabs ">
                                                <div class="content_tabs active">
                                                    <div class="flex_tabs">
                                                        <ul class="flex_a">
                                                            <li>
                                                                <ion-icon name="radio-button-on"></ion-icon> Tập mới: <span class="episode">
                                                                    <?php
                                                                    $id = $_GET['id'];
                                                                    $query1 = "SELECT * FROM episode where mv_id=$id order by id DESC limit 3";
                                                                    $run1 = mysqli_query($con, $query1);
                                                                    if ($run1) {
                                                                        if (mysqli_num_rows($run1) > 0) {
                                                                            while ($row1 = mysqli_fetch_assoc($run1)) {

                                                                    ?>
                                                                                <span>
                                                                                    <a href="episode.php?id=<?php echo $row1['mv_id']; ?>&es_id=<?php echo $row1['id']; ?>"><?php echo $row1['es_name'] ?> </a>
                                                                                </span>
                                                                    <?php
                                                                            }
                                                                        } else {
                                                                            echo 'Chưa có tập phim!';
                                                                        }
                                                                    }
                                                                    ?>
                                                                </span>
                                                            </li>
                                                            <li>
                                                                <ion-icon name="radio-button-on"></ion-icon> Trạng thái: <?php echo $row['mv_status'] ?>
                                                            </li>
                                                            <li>
                                                                <ion-icon name="radio-button-on"></ion-icon> Thể loại: <?php
                                                                                                                        $id = $_GET['id'];
                                                                                                                        $query3 = "SELECT * from movie,category,cat_mv where  cat_mv.mv_id=movie.id and cat_mv.category_id=category.id and movie.id=$id";
                                                                                                                        $run3
                                                                                                                            = mysqli_query($con, $query3);
                                                                                                                        if ($run3) {

                                                                                                                            while ($row3 = mysqli_fetch_assoc($run3)) {
                                                                                                                        ?>
                                                                        <a class="link_detail" href="viewcat.php?id=<?php echo $row3['id']; ?>">
                                                                            <?php
                                                                                                                                echo $row3['category_name'];
                                                                            ?>
                                                                        </a>
                                                                <?php
                                                                                                                            }
                                                                                                                        }
                                                                ?>
                                                            </li>
                                                            <li>
                                                                <ion-icon name="radio-button-on"></ion-icon> Quốc gia:<?php $id = $row['id'];
                                                                                                                        $query2 = "SELECT * from movie,nation where movie.mv_nation = nation.id and movie.id=$id";
                                                                                                                        $run2 = mysqli_query($con, $query2);
                                                                                                                        if ($run2) {

                                                                                                                            while ($row2 = mysqli_fetch_assoc($run2)) {
                                                                                                                        ?>

                                                                <a class="link_detail" href="viewnation.php?id=<?php echo $row2['id']; ?>">
                                                                    <?php
                                                                                                                                echo $row2['nation_name'];
                                                                    ?>
                                                                </a>
                                                        <?php
                                                                                                                            }
                                                                                                                        } ?>
                                                            </li>
                                                            <li>
                                                                <ion-icon name="radio-button-on"></ion-icon> Đạo diễn: <?php echo $row['mv_des'] ?>
                                                            </li>
                                                            <li>
                                                                <ion-icon name="radio-button-on"></ion-icon> Điểm IMDb: <?php
                                                                                                                        if ($row['IMDb'] == 0) {
                                                                                                                            echo "N/A";
                                                                                                                        } else
                                                                                                                            echo $row['IMDb'] ?>
                                                            </li>
                                                        </ul>
                                                        <ul class="flex_b">
                                                            <li>
                                                                <ion-icon name="radio-button-on"></ion-icon> Thời lượng: <?php echo $row['mv_duration'] ?>
                                                            </li>
                                                            <li>
                                                                <ion-icon name="radio-button-on"></ion-icon> Chất lượng: <?php echo $row['mv_quality'] ?>
                                                            </li>
                                                            <li>
                                                                <ion-icon name="radio-button-on"></ion-icon> Yêu cầu: <?php echo $row['mv_request'] ?>
                                                            </li>
                                                            <li>
                                                                <ion-icon name="radio-button-on"></ion-icon> Năm SX: <?php $id = $row['id'];
                                                                                                                        $query2 = "SELECT * from movie,year where movie.mv_year = year.id and movie.id=$id";
                                                                                                                        $run2 = mysqli_query($con, $query2);
                                                                                                                        if ($run2) {

                                                                                                                            while ($row2 = mysqli_fetch_assoc($run2)) {
                                                                                                                        ?>

                                                                        <a class="link_detail" href="viewyear.php?id=<?php echo $row2['id']; ?>">
                                                                            <?php
                                                                                                                                echo $row2['year'];
                                                                            ?>
                                                                        </a>
                                                                <?php
                                                                                                                            }
                                                                                                                        } ?>
                                                            </li>
                                                            <li>
                                                                <ion-icon name="radio-button-on"></ion-icon> Diễn Viên: <?php echo $row['mv_actor'] ?>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="content_tabs">
                                                    <iframe width="810" height="480" src="<?php echo $row['mv_trailer'] ?>" title="Phim" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                                </div>

                                            </div>
                                        </div>

                                        <!-- plugin facebook -->
                                        <div class="plugin">
                                            <strong>Hãy để lại bình luận tại đây.Đây là web đồ án của nhóm mong các bạn ủng hộ</strong>
                                            <p>Xem thêm Page Facebook <a href="https://www.facebook.com/profile.php?id=100086581351351">Tại đây</a></p>
                                            <div class="fb-like" data-share="true" data-width="450" data-show-faces="true">
                                            </div>

                                            <div id="fb-root"></div>
                                            <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v15.0" nonce="Hg4apuxI"></script>

                                            <div class="fb-comments" data-href="http://localhost:3000/<?php echo $row['id']; ?>" data-width="550" data-numposts="10" data-colorscheme="light"></div>
                                        </div>

                                       
                                    </div>

                                    <div class="right_detail">
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

                                        <!-- Thông tin film -->

                                        <div>

                                        </div>
                                    </div>

                                </div>
                                 <!-- Phim liên quan -->
                                 <div class="similar_mv">
                                            <div class="title_similar">
                                                <h3>Phim liên quan</h3>
                                            </div>
                                            <div class="mv_genre">
                                                <?php
                                                $genre_id  = $_GET['genre_id'];
                                                $query = "SELECT * FROM movie where genre_id = $genre_id limit 8";
                                                $run = mysqli_query($con, $query);
                                                if ($run) {
                                                    while ($row = mysqli_fetch_assoc($run)) {
                                                ?>
                                                        <div class="movie_show">
                                                            <div class="images">
                                                                <img src="<?php echo $row['mv_img']; ?>">

                                                                <!-- Infor hidden -->

                                                                <div class="infor_hidden">
                                                                    <div class="infor_tab">
                                                                        <h3 class="name_hidden"><?php echo $row['mv_name'] ?></h3>
                                                                        <p class="deces"> <?php if (strlen($row['mv_deces']) > 210) {
                                                                                                echo mb_substr($row['mv_deces'], 0, 210) . "... ";
                                                                                            } else {
                                                                                                echo $row['mv_deces'];
                                                                                            }
                                                                                            ?> </p>
                                                                        <div class="flex_hidden">
                                                                            <?php
                                                                            $id = $row['id'];
                                                                            $query1 = "SELECT * FROM movie,category WHERE category.id=movie.cat_id and movie.id=$id";
                                                                            $run1 = mysqli_query($con, $query1);
                                                                            if ($run1) {
                                                                                while ($row1 = mysqli_fetch_assoc($run1)) {

                                                                            ?>
                                                                                    <strong>Thể loại: <?php echo $row1['category_name']; ?></strong>
                                                                            <?php
                                                                                }
                                                                            }

                                                                            ?>
                                                                            <?php
                                                                            $id = $row['id'];
                                                                            $query2 = "SELECT * FROM movie,nation WHERE nation.id=movie.mv_nation and movie.id=$id";
                                                                            $run2 = mysqli_query($con, $query2);
                                                                            if ($run2) {
                                                                                while ($row2 = mysqli_fetch_assoc($run2)) {

                                                                            ?>
                                                                                    <strong>Quốc gia: <?php echo $row2['nation_name']; ?></strong>
                                                                            <?php
                                                                                }
                                                                            }

                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <!-- Overlay hidden -->

                                                                <a href="detail.php?id=<?php echo $row['id']; ?>&genre_id=<?php echo $row['genre_id'] ?>">
                                                                    <div class="overlay_mv"></div>
                                                                </a>

                                                                <!-- icon hidden -->

                                                                <div class="iconic">
                                                                    <ion-icon name="play-circle"></ion-icon>
                                                                </div>
                                                            </div>
                                                            <a href="detail.php?id=<?php echo $row['id']; ?>&genre_id=<?php echo $row['genre_id'] ?>">
                                                                <p>
                                                                    <?php
                                                                    if (strlen($row['mv_name']) > 10) {
                                                                        echo mb_substr($row['mv_name'], 0, 10) . "... ";
                                                                    } else {
                                                                        echo $row['mv_name'];
                                                                    }
                                                                    ?>
                                                                    <p>
                                                            </a>
                                                            <p class="view">Lượt xem: <?php echo $row['mv_view'] ?></p>


                                                        </div>

                                                <?php
                                                    }
                                                }
                                                ?>



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

                        <script>
                            const tabs = document.querySelectorAll(".tabs li");
                            const content = document.querySelectorAll(".content_tabs");

                            tabs.forEach((tab, index) => {
                                tab.addEventListener("click", () => {
                                    tabs.forEach((tab) => tab.classList.remove("active"));

                                    tab.classList.add("active");
                                    content.forEach(c => c.classList.remove("active"));
                                    content[index].classList.add('active');
                                });
                            });
                            tabs[0].click();
                              
                            // Favorite
                            
                        const favorite = document.querySelector("#favorite");
                        favorite.onclick = function() {
                            favorite.innerHTML = favorite.innerHTML + "<div class='noti'> <h2> Thông báo lỗi </h2><p> Bạn phải đăng nhập mới được theo dõi </p></div>"
                            setTimeout(favorite,3000);
                        }
                        </script>
                    </body>
                <?php
                } else {
                    echo "<script>alert('Bạn cần đăng nhập mới xem được phim này');window.location.href='home.php';</script>";
                }
            }
        }
    }
} else {

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $update = "UPDATE movie set mv_view=mv_view+1 where id=$id ";
        $run1 = mysqli_query($con, $update);
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
                    <link rel="stylesheet" type="text/css" href="/CSSPage/detail.css">
                    <title>Chi tiết phim <?php echo $row['mv_name']; ?></title>
                </head>

                <body>
                    <!-- Header -->
                    <?php
                    include_once 'headerLogin.php';
                    ?>

                    <div class="wrapper_detail">
                        <div class="main_detail">
                            <div class="flex_detail">
                                <div class="left_detail">
                                    <div class="info_detail">
                                        <div class="img_detail">
                                            <img src="<?php echo $row['mv_bg']; ?>">

                                        </div>

                                        <div class="infor_moive">
                                            <div class="img_link">



                                                <div class="overlay_detail"></div>
                                             
                                                <div id="favorite">
                                                  
                                                        <ion-icon name="heart" class="heart_fav"></ion-icon>
                                                       
                                                </div>
                                                <img src="<?php echo $row['mv_img']; ?>">
                                                <a href="episode.php?id=<?php echo $row['id']; ?>&es_id=<?php
                                                                                                        $id = $row['id'];
                                                                                                        $query1 = "SELECT * FROM episode where mv_id=$id order by id limit 1 ";
                                                                                                        $run1 = mysqli_query($con, $query1);
                                                                                                        if ($run1) {
                                                                                                            while ($row1 = mysqli_fetch_assoc($run1)) {
                                                                                                                echo $row1['id'];
                                                                                                            }
                                                                                                        }
                                                                                                        ?>">
                                                    <div class="watch">
                                                        <p>
                                                            XEM PHIM
                                                        </p>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="deces_detail">
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
                                    </div>

                                    <!-- Switch tabs -->

                                    <div class="switch_tabs">
                                        <ul class="tabs">
                                            <li>
                                                <ion-icon name="book"></ion-icon> Thông tin phim
                                            </li>
                                            <li>
                                                <ion-icon name="film"></ion-icon> Trailer phim
                                            </li>
                                        </ul>

                                        <div class="container_tabs ">
                                            <div class="content_tabs active">
                                                <div class="flex_tabs">
                                                    <ul class="flex_a">
                                                        <li>
                                                            <ion-icon name="radio-button-on"></ion-icon> Tập mới: <span class="episode">
                                                                <?php
                                                                $id = $_GET['id'];
                                                                $query1 = "SELECT * FROM episode where mv_id=$id order by id DESC limit 3";
                                                                $run1 = mysqli_query($con, $query1);
                                                                if ($run1) {
                                                                    if (mysqli_num_rows($run1) > 0) {
                                                                        while ($row1 = mysqli_fetch_assoc($run1)) {

                                                                ?>
                                                                            <span>
                                                                                <a href="episode.php?id=<?php echo $row1['mv_id']; ?>&es_id=<?php echo $row1['id']; ?>"><?php echo $row1['es_name'] ?> </a>
                                                                            </span>
                                                                <?php
                                                                        }
                                                                    } else {
                                                                        echo 'Chưa có tập phim!';
                                                                    }
                                                                }
                                                                ?>
                                                            </span>
                                                        </li>
                                                        <li>
                                                            <ion-icon name="radio-button-on"></ion-icon> Trạng thái: <?php echo $row['mv_status'] ?>
                                                        </li>
                                                        <li>
                                                            <ion-icon name="radio-button-on"></ion-icon> Thể loại: <?php
                                                                                                                    $id = $_GET['id'];
                                                                                                                    $query3 = "SELECT * from movie,category,cat_mv where  cat_mv.mv_id=movie.id and cat_mv.category_id=category.id and movie.id=$id";
                                                                                                                    $run3
                                                                                                                        = mysqli_query($con, $query3);
                                                                                                                    if ($run3) {

                                                                                                                        while ($row3 = mysqli_fetch_assoc($run3)) {
                                                                                                                    ?>
                                                                    <a class="link_detail" href="viewcat.php?id=<?php echo $row3['id']; ?>">
                                                                        <?php
                                                                                                                            echo $row3['category_name'];
                                                                        ?>
                                                                        ,
                                                                    </a>
                                                            <?php
                                                                                                                        }
                                                                                                                    }
                                                            ?>
                                                        </li>
                                                        <li>
                                                            <ion-icon name="radio-button-on"></ion-icon> Quốc gia: <?php $id = $row['id'];
                                                                                                                    $query2 = "SELECT * from movie,nation where movie.mv_nation = nation.id and movie.id=$id";
                                                                                                                    $run2 = mysqli_query($con, $query2);
                                                                                                                    if ($run2) {

                                                                                                                        while ($row2 = mysqli_fetch_assoc($run2)) {
                                                                                                                    ?>

                                                                    <a class="link_detail" href="viewnation.php?id=<?php echo $row2['id']; ?>">
                                                                        <?php
                                                                                                                            echo $row2['nation_name'];
                                                                        ?>
                                                                    </a>
                                                            <?php
                                                                                                                        }
                                                                                                                    } ?>
                                                        </li>
                                                        <li>
                                                            <ion-icon name="radio-button-on"></ion-icon> Đạo diễn: <?php echo $row['mv_des'] ?>
                                                        </li>
                                                        <li>
                                                            <ion-icon name="radio-button-on"></ion-icon> Điểm IMDb: <?php
                                                                                                                    if ($row['IMDb'] == 0) {
                                                                                                                        echo "N/A";
                                                                                                                    } else
                                                                                                                        echo $row['IMDb'] ?>
                                                        </li>
                                                    </ul>
                                                    <ul class="flex_b">
                                                        <li>
                                                            <ion-icon name="radio-button-on"></ion-icon> Thời lượng: <?php echo $row['mv_duration'] ?>
                                                        </li>
                                                        <li>
                                                            <ion-icon name="radio-button-on"></ion-icon> Chất lượng: <?php echo $row['mv_quality'] ?>
                                                        </li>
                                                        <li>
                                                            <ion-icon name="radio-button-on"></ion-icon> Yêu cầu: <?php echo $row['mv_request'] ?>
                                                        </li>
                                                        <li>
                                                            <ion-icon name="radio-button-on"></ion-icon> Năm SX: <?php $id = $row['id'];
                                                                                                                    $query2 = "SELECT * from movie,year where movie.mv_year = year.id and movie.id=$id";
                                                                                                                    $run2 = mysqli_query($con, $query2);
                                                                                                                    if ($run2) {

                                                                                                                        while ($row2 = mysqli_fetch_assoc($run2)) {
                                                                                                                    ?>

                                                                    <a class="link_detail" href="viewyear.php?id=<?php echo $row2['id']; ?>">
                                                                        <?php
                                                                                                                            echo $row2['year'];
                                                                        ?>
                                                                    </a>
                                                            <?php
                                                                                                                        }
                                                                                                                    } ?>
                                                        </li>
                                                        <li>
                                                            <ion-icon name="radio-button-on"></ion-icon> Diễn Viên: <?php echo $row['mv_actor'] ?>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="content_tabs">
                                                <iframe width="730" height="480" src="<?php echo $row['mv_trailer'] ?>" title="Phim" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                            </div>

                                        </div>
                                    </div>

                                    <!-- plugin facebook -->
                                    <div class="plugin">
                                        <strong>Hãy để lại bình luận tại đây.Đây là web đồ án của nhóm mong các bạn ủng hộ</strong>
                                        <p>Xem thêm Page Facebook <a href="https://www.facebook.com/profile.php?id=100086581351351">Tại đây</a></p>
                                        <div class="fb-like" data-share="true" data-width="450" data-show-faces="true">
                                        </div>

                                        <div id="fb-root"></div>
                                        <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v15.0" nonce="Hg4apuxI"></script>

                                        <div class="fb-comments" data-href="http://localhost:3000/<?php echo $row['id']; ?>" data-width="550" data-numposts="10" data-colorscheme="light"></div>
                                    </div>

                                  
                                </div>

                                <div class="right_detail">
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

                                    <!-- Thông tin film -->

                                    <div>

                                    </div>
                                </div>

                            </div>
                              <!-- Phim liên quan -->
                              <div class="similar_mv">
                                        <div class="title_similar">
                                            <h3>Phim liên quan</h3>
                                        </div>
                                        <div class="mv_genre">
                                            <?php
                                            $genre_id  = $_GET['genre_id'];
                                            $query = "SELECT * FROM movie where genre_id = $genre_id limit 10";
                                            $run = mysqli_query($con, $query);
                                            while ($row = mysqli_fetch_assoc($run)) {
                                            ?>
                                                <div class="movie_show">
                                                    <div class="images">
                                                        <a href="#">
                                                            <img src="<?php echo $row['mv_img']; ?>">
                                                        </a>
                                                        <!-- Infor hidden -->

                                                        <div class="infor_hidden">
                                                            <div class="infor_tab">
                                                                <h3 class="name_hidden"><?php echo $row['mv_name'] ?></h3>
                                                                <p class="deces"> <?php if (strlen($row['mv_deces']) > 210) {
                                                                                        echo mb_substr($row['mv_deces'], 0, 210) . "... ";
                                                                                    } else {
                                                                                        echo $row['mv_deces'];
                                                                                    }
                                                                                    ?> </p>
                                                                <div class="flex_hidden">
                                                                    <?php
                                                                    $id = $row['id'];
                                                                    $query1 = "SELECT * FROM movie,category WHERE category.id=movie.cat_id and movie.id=$id";
                                                                    $run1 = mysqli_query($con, $query1);
                                                                    if ($run1) {
                                                                        while ($row1 = mysqli_fetch_assoc($run1)) {

                                                                    ?>
                                                                            <strong>Thể loại: <?php echo $row1['category_name']; ?></strong>
                                                                    <?php
                                                                        }
                                                                    }

                                                                    ?>
                                                                    <?php
                                                                    $id = $row['id'];
                                                                    $query2 = "SELECT * FROM movie,nation WHERE nation.id=movie.mv_nation and movie.id=$id";
                                                                    $run2 = mysqli_query($con, $query2);
                                                                    if ($run2) {
                                                                        while ($row2 = mysqli_fetch_assoc($run2)) {

                                                                    ?>
                                                                            <strong>Quốc gia: <?php echo $row2['nation_name']; ?></strong>
                                                                    <?php
                                                                        }
                                                                    }

                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Overlay hidden -->

                                                        <a href="detail.php?id=<?php echo $row['id']; ?>&genre_id=<?php echo $row['genre_id'] ?>">
                                                            <div class="overlay_mv"></div>
                                                        </a>

                                                        <!-- icon hidden -->

                                                        <div class="iconic">
                                                            <ion-icon name="play-circle"></ion-icon>
                                                        </div>
                                                    </div>
                                                    <a href="detail.php?id=<?php echo $row['id']; ?>&genre_id=<?php echo $row['genre_id'] ?>">
                                                        <p>
                                                            <?php
                                                            if (strlen($row['mv_name']) > 10) {
                                                                echo mb_substr($row['mv_name'], 0, 10) . "... ";
                                                            } else {
                                                                echo $row['mv_name'];
                                                            }
                                                            ?>
                                                            <p>
                                                    </a>
                                                    <p class="view">Lượt xem: <?php echo $row['mv_view'] ?></p>


                                                    <div class="mv_role">
                                                        <?php
                                                        $id = $row['id'];
                                                        $query1 = "SELECT * FROM movie where id=$id";
                                                        $run1 = mysqli_query($con, $query1);
                                                        while ($row1 = mysqli_fetch_assoc($run1)) {
                                                            if (empty($row['mv_role'])) {
                                                            } else {
                                                        ?>
                                                                <p class="role_name"><?php echo $row1['mv_role']; ?></p>
                                                        <?php
                                                            }
                                                        }

                                                        ?>
                                                    </div>
                                                    <!-- show tập phim -->
                                                    <?php
                                                    $id = $row['id'];
                                                    $query2 = "SELECT * ,count(*) as total FROM episode where mv_id=$id";
                                                    $run2 = mysqli_query($con, $query2);
                                                    while ($row2 = mysqli_fetch_assoc($run2)) {
                                                        if (!empty($row2['mv_id'])) {

                                                    ?>
                                                            <div class="show_episode">
                                                                <p class="show_name">Tập <?php echo $row2['total']; ?></p>
                                                            </div>
                                                    <?php

                                                        }
                                                    }

                                                    ?>
                                                </div>

                                            <?php
                                            }
                                            ?>

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

                    <script>
                        const tabs = document.querySelectorAll(".tabs li");
                        const content = document.querySelectorAll(".content_tabs");

                        tabs.forEach((tab, index) => {
                            tab.addEventListener("click", () => {
                                tabs.forEach((tab) => tab.classList.remove("active"));

                                tab.classList.add("active");
                                content.forEach(c => c.classList.remove("active"));
                                content[index].classList.add('active');
                            });
                        });
                        tabs[0].click();

                        // favorite

                        const favorite = document.querySelector("#favorite");
                        favorite.onclick = function() {
                            let xhr = new XMLHttpRequest();
                          
                          
                            xhr.open("GET", "valiFav.php?mv_id=<?php $mv_id=$_GET['id'];echo $mv_id; ?>", true);
                           
                            xhr.send();
                            xhr.onreadystatechange = function() {
                                if (this.readyState == 4 && this.status == 200) {

                                    console.log(xhr);
                                    favorite.classList.toggle('active')
                                }
                            }
                        }
                    </script>
                </body>
<?php

            }
        }
    }
}
?>