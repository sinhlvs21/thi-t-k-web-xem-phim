<?php
include 'admin/db.php';
session_start();
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/ionicons@4.5.10-0/dist/css/ionicons.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudfla're.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
    <link rel="stylesheet" type="text/css" href="/CSSPage/myMovie.css">
    <title>Tủ phim của <?php echo $_SESSION['user']; ?></title>
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
    <div class="wrapper_movie">
        <div class="main_movie">

            <div class="full_myMovie">
                <div class="left_myMovie ">
                    <div class="titile_myMovie">
                        <h2>Tủ phim của bạn</h2>
                    </div>

                    <div class="mv_my">
                        <?php
                        $user = $_SESSION['user'];
                        $query = "SELECT * from account where uname= '$user' ";
                        $run = mysqli_query($con, $query);
                        if ($run) {
                            while ($row = mysqli_fetch_assoc($run)) {
                                $id_user = $row['id'];
                                $query1 = "SELECT * from favorite where id_user=$id_user ";
                                $run1 = mysqli_query($con, $query1);

                                if ($run1) {
                                    $count = mysqli_num_rows($run1);
                                    if ($count > 0) {



                        ?>

                                        <?php
                                        $query2 = "SELECT * from favorite,movie where favorite.mv_id_fav=movie.id and favorite.id_user=$id_user ";
                                        $run2 = mysqli_query($con, $query2);
                                        if ($run2) {
                                            while ($row2 = mysqli_fetch_assoc($run2)) {
                                        ?>
                                                <div class="movie_show">
                                                    <div class="form_delete">

                                                        <form action="deleteMovie.php?mv_id=<?php echo $row2['id'] ?>" method="POST">
                                                            <button type="submit" name="submit">X</button>

                                                        </form>
                                                    </div>

                                                    <div class="images">

                                                        <img src="<?php echo $row2['mv_img']; ?>">

                                                        <!-- Infor hidden -->

                                                        <div class="infor_hidden">
                                                            <div class="infor_tab">
                                                                <h3 class="name_hidden"><?php echo $row2['mv_name'] ?></h3>
                                                                <p class="deces"> <?php if (strlen($row2['mv_deces']) > 210) {
                                                                                        echo mb_substr($row2['mv_deces'], 0, 210) . "... ";
                                                                                    } else {
                                                                                        echo $row2['mv_deces'];
                                                                                    }
                                                                                    ?> </p>
                                                                <div class="flex_hidden">
                                                                    <?php
                                                                    $id = $row2['mv_id_fav'];
                                                                    $query3 = "SELECT * FROM movie,category WHERE category.id=movie.cat_id and movie.id=$id";
                                                                    $run3 = mysqli_query($con, $query3);
                                                                    if ($run3) {
                                                                        while ($row3 = mysqli_fetch_assoc($run3)) {

                                                                    ?>
                                                                            <strong>Thể loại: <?php echo $row3['category_name']; ?></strong>
                                                                    <?php
                                                                        }
                                                                    }

                                                                    ?>
                                                                    <?php
                                                                    $id = $row2['mv_id_fav'];
                                                                    $query3 = "SELECT * FROM movie,nation WHERE nation.id=movie.mv_nation and movie.id=$id";
                                                                    $run3 = mysqli_query($con, $query3);
                                                                    if ($run3) {
                                                                        while ($row3 = mysqli_fetch_assoc($run3)) {

                                                                    ?>
                                                                            <strong>Quốc gia: <?php echo $row3['nation_name']; ?></strong>
                                                                    <?php
                                                                        }
                                                                    }

                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Overlay hidden -->
                                                        <a href="detail.php?id=<?php echo $row2['id']; ?>&genre_id=<?php echo $row2['genre_id'] ?>">
                                                            <div class="overlay_mv"></div>
                                                        </a>
                                                        <!-- icon hidden -->

                                                        <div class="iconic">
                                                            <ion-icon name="play-circle"></ion-icon>
                                                        </div>
                                                    </div>
                                                    <a href="detail.php?id=<?php echo $row2['id']; ?>&genre_id=<?php echo $row2['genre_id'] ?>">
                                                        <p>
                                                            <?php
                                                            if (strlen($row2['mv_name']) > 10) {
                                                                echo mb_substr($row2['mv_name'], 0, 10) . "... ";
                                                            } else {
                                                                echo $row2['mv_name'];
                                                            }
                                                            ?>
                                                            <p>
                                                    </a>
                                                    <p class="view">Lượt xem: <?php echo $row2['mv_view'] ?></p>

                                                    <div class="mv_role">
                                                        <?php
                                                        $id = $row2['mv_id_fav'];
                                                        $query3 = "SELECT * FROM movie where id=$id";
                                                        $run3 = mysqli_query($con, $query3);
                                                        while ($row3 = mysqli_fetch_assoc($run3)) {
                                                            if (empty($row3['mv_role'])) {
                                                            } else {
                                                        ?>
                                                                <p class="role_name"><?php echo $row3['mv_role']; ?></p>
                                                        <?php
                                                            }
                                                        }

                                                        ?>
                                                    </div>
                                                    <!-- show tập phim -->
                                                    <?php
                                                    $id = $row2['mv_id_fav'];
                                                    $query3 = "SELECT * ,count(*) as total FROM episode where mv_id=$id";
                                                    $run3 = mysqli_query($con, $query2);
                                                    while ($row3 = mysqli_fetch_assoc($run3)) {
                                                        if (!empty($row3['mv_id'])) {

                                                    ?>
                                                            <div class="show_episode">
                                                                <p class="show_name">Tập <?php echo $row3['total']; ?></p>
                                                            </div>
                                                    <?php

                                                        }
                                                    }
                                                    ?>
                                                </div>

                                <?php
                                            }
                                        }
                                    } else {
                                        echo "<h4 class='alert'>Bạn chưa theo dõi phim nào</h4>";
                                    }
                                }
                                ?>






                    </div>
            <?php



                            }
                        }

            ?>
                </div>

                <div class="right_myMovie">
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

    <?php
    require_once 'footer.php';
    ?>
    <script type="module" src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule="" src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons/ionicons.js"></script>

   