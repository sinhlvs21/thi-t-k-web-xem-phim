<?php
include 'admin/db.php';
?>
<?php
$query = "SELECT * FROM movie ORDER BY id DESC limit 20";
$run = mysqli_query($con, $query);
session_start();
if (isset($_SESSION['user'])) {
} else {
    echo "<script> alert ('Bạn chưa đăng nhập'); window.location.href = '/login.php'; </script>";
}
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/ionicons@4.5.10-0/dist/css/ionicons.min.css" rel="stylesheet">
    <meta property="fb:app_id" content="&#123;1160280281554543&#125;" />
    <link rel="stylesheet" href="https://cdnjs.cloudfla're.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
    <link rel="stylesheet" type="text/css" href="/CSSPage/home.css">
    <title>Trang chủ</title>
</head>

<body>

    <!-- Header -->
    <?php
    include 'headerLogin.php';
    ?>

    <!-- Plugin facebook -->

    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v15.0" nonce="SOdotQ0j"></script>


    <div class="wrapper_home">
        <div class="main_home">
            <!-- Owl carousel -->

            <section>
                <div class="owl-carousel owl-theme">
                    <?php
                    while ($row = mysqli_fetch_assoc($run)) {
                    ?>
                        <div class="item">
                            <div class="overlay"></div>
                            <div class="overlay"></div>
                            <div class="mv_role_owl">
                                <?php
                                $id = $row['id'];
                                $query1 = "SELECT * FROM movie where id=$id";
                                $run1 = mysqli_query($con, $query1);
                                while ($row1 = mysqli_fetch_assoc($run1)) {
                                    if (empty($row['mv_role'])) {
                                    } else {
                                ?>
                                        <p class="role_name_owl"><?php echo $row1['mv_role']; ?></p>

                                <?php
                                    }
                                }

                                ?>
                            </div>
                            <a href="detail.php?id=<?php echo $row['id']; ?>&genre_id=<?php echo $row['genre_id'] ?>" title="<?php echo $row['mv_name']; ?>">
                                <img src="<?php echo $row['mv_img']; ?>">
                                <p class="name_mv"><?php echo $row['mv_name']; ?></p>
                            </a>
                        </div>
                    <?php
                    }
                    ?>
                </div>

            </section>

            <div class="full_bar">

                <!--Side bar bên trái  -->

                <div class="left_bar">

                    <!-- Slider -->
                    <section class="slider_mv">
                        <div class="overlay_slider"></div>
                        <div class="slider">

                            <?php
                            $query1 = "SELECT * FROM movie ORDER BY id DESC limit 8";
                            $run1 = mysqli_query($con, $query1);
                            while ($row1 = mysqli_fetch_assoc($run1)) {
                            ?>
                                <div class="show">
                                    <div class="show_bg">
                                        <a href="detailLogin.php?id=<?php echo $row1['id']; ?>&genre_id=<?php echo $row1['genre_id']; ?>">
                                            <img src="<?php echo $row1['mv_bg']; ?>">
                                        </a>
                                    </div>

                                    <div class="info_mv">
                                        <a href="detailLogin.php?id=<?php echo $row['id']; ?>&genre_id=<?php echo $row1['genre_id'] ?>">
                                            <h3><?php echo $row1['mv_name'] ?></h3>
                                        </a>
                                    </div>

                                </div>

                            <?php
                            }
                            ?>
                        </div>

                    </section>





                    <!-- List movie -->

                    <section>
                        <?php
                        include '/App/Xampp/htdocs/vsh_movie/list_mv.php';
                        ?>
                    </section>

                    <!-- Plugin facebook -->

                    <section>

                        <br>
                        <?php
                        include '/App/Xampp/htdocs/vsh_movie/comment.php';
                        ?>
                    </section>
                </div>

                <!-- Side bar bên phải -->

                <div class="right_bar">
                    <?php
                    include '/App/Xampp/htdocs/vsh_movie/rightbar.php'
                    ?>
                </div>
            </div>

            <!-- Contact -->

            <section>
                <div class="contact" id="contact">
                    <h3 class="contact_title"> CONTACT </h3>
                    <?php
                    include '/App/Xampp/htdocs/vsh_movie/contact.php';
                    ?>
                </div>
            </section>
        </div>
    </div>

    <!-- Footer -->

    <footer>
        <?php
        include '/App/Xampp/htdocs/vsh_movie/footer.php';
        ?>
    </footer>


    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule="" src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons/ionicons.js"></script>

    <!-- Owl carousel -->
    <script type="text/javascript">
        $('.owl-carousel').owlCarousel({
            loop: true,
            margin: 15,
            nav: true,
            responsive: {
                0: {
                    items: 1
                },
                400: {
                    items: 2
                },
                600: {
                    items: 4
                },
                800: {
                    items: 6
                },
                1250: {
                    items: 8
                },
                1500: {
                    items: 10
                }
            }
        })

        //  Slider show

        let sildes = document.querySelectorAll('.show');
        let index = 0;

        function next() {
            sildes[index].classList.remove('active');
            index = (index + 1) % sildes.length;
            sildes[index].classList.add('active');
        }

        function pre() {
            sildes[index].classList.remove('active');
            index = (index - 1 + sildes.length) % sildes.length;
            sildes[index].classList.add('active');
        }
        setInterval(next, 2000);
    </script>
</body>