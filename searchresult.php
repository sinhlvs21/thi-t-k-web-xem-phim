<?php
include_once 'admin/db.php';
session_start();
?>
<?php
if (isset($_GET['page'])) {
  $page = $_GET['page'];
} else {
  $page = 1;
}

if (isset($_GET['submit'])) {
  $search = $_GET['search_page'];
  $searchpreg = preg_replace("#[^0-9a-z]#i", "", $search);
  $rowsPerPage = 15;
  $perRow = ($page - 1) * 15;
  $query4 = "SELECT * FROM movie where mv_name Like '%$search%'  LIMIT $perRow,$rowsPerPage";
  $run4 = mysqli_query($con, $query4);
  $query = "SELECT * FROM movie where mv_name Like '%$search%'";
  $run = mysqli_query($con, $query);
  $count = mysqli_num_rows($run);
  if ($count == 0) {
?>


    <head>
      <link rel="stylesheet" type="text/css" href="/CSSPage/searchresult.css">
      <title>Tìm kiếm cho <?php echo $search ?> </title>
    </head>
    <?php


    if (isset($_SESSION['user'])) {
      include_once 'headerLogin.php';
    } else {
      include_once 'header.php';
    }
    ?>
    <div class="wrapper_search">
      <div class="main_search">
        <div class="flex_search">
          <div class="left_search">
            <div class="titile_search">
              <h3> KẾT QUẢ TÌM KIẾM CHO <?php echo $search ?> </h3>
              <br>
              <p>Không có phim như yêu cầu</p>
            </div>
          </div>

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
              <!-- Plugin facebook -->

              <div class="quiz">
                <div class="quiz_text">
                  <strong>Chuyên mục hỏi và trả lời.Đây là web đồ án của nhóm mong các bạn ủng hộ</strong>
                  <p>Xem thêm Page Facebook <a href="https://www.facebook.com/profile.php?id=100086581351351">Tại đây</a></p>
                </div>
                <div id="fb-root"></div>
                <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v15.0" nonce="aQlDu7tj"></script>
                <div class="fb-comments" data-href="http://localhost/3000" data-width="300" data-numposts="5" data-colorscheme="light"></div>
              </div>

              <!-- List phim moi cap nhat -->

              <div class="new_mv">
                <div class="titile_new">
                  <p> PHIM MỚI CẬP NHẬT</p>
                </div>
                <hr>
                <br>

                <div class="list_new">
                  <?php
                  $query = "SELECT * FROM movie ORDER BY id DESC limit 12";
                  $run = mysqli_query($con, $query);
                  if ($run) {
                    while ($row = mysqli_fetch_assoc($run)) {
                  ?>
                      <a href="detail.php?id=<?php echo $row['id'] ?>&genre_id=<?php echo $row['genre_id'] ?>">
                        <p> <?php
                            if (strlen($row['mv_name']) > 20) {
                              echo mb_substr($row['mv_name'], 0, 20) . "... ";
                            } else {
                              echo $row['mv_name'];
                            }
                            ?></p>
                      </a>
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
    <!-- Footer -->

    <?php
    include_once 'footer.php'
    ?>
  <?php
  } else {


  ?>

    <head>
      <link rel="stylesheet" type="text/css" href="/CSSPage/searchresult.css">
      <title>Tìm kiếm cho <?php echo $search ?> </title>
    </head>
    <?php


if (isset($_SESSION['user'])) {
  include_once 'headerLogin.php';
} else {
  include_once 'header.php';
}
?>
    <div class="wrapper_search">
      <div class="main_search">
        <div class="flex_search">
          <div class="left_search">
            <div class="titile_search">
              <h3> KẾT QUẢ TÌM KIẾM CHO <?php echo $search ?> </h3>
              <br>
            </div>
            <div class="result_mv">
              <?php
              while ($row = mysqli_fetch_assoc($run)) {
              ?>

                <div class="genre">
                  <div class="mv_genre">
                    <?php
                    $query = "SELECT * FROM  movie where mv_name Like '%$search%'  LIMIT $perRow,$rowsPerPage ";
                    $run = mysqli_query($con, $query);
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

              <?php
              }


              ?>
            </div>
            <!-- Phân trang  -->
            <ul class="pagination">

              <?php
                
                $query5 = "SELECT * FROM movie where mv_name Like '%$search%' ";
                $run5 = mysqli_query($con, $query5);
                $total = mysqli_num_rows($run5);
                $total_page = ceil($total / $rowsPerPage);

                if ($page > 1) {
                  echo "<li ><a class='prev' href='searchresult.php?search_page=$search&submit=&page=" . ($page - 1) . "'  >Prev</a></li>";
                } else {
                  echo "<li ><a class='prev' href='searchresult.php?search_page=$search&submit=&page=" . ($total_page) . "'  >Prev</a></li>";
                }
                for ($i = 1; $i <= $total_page; $i++) {
                  if ($i  > $page - 3 && $i < $page + 3) {
                    echo "<li ><a class='pageNumber' href='searchresult.php?search_page=$search&submit=&page=" . ($i) . "'  >$i</a></li>";
                  }
                }

                if ($total_page > $page) {
                  echo "<li ><a class='next' href='searchresult.php?search_page=$search&submit=&page=" . ($page + 1) . "'  >Next </a></li>";
                } else {
                  echo "<li ><a class='next' href='searchresult.php?search_page=$search&submit=&page=1'  >Next </a></li>";
                }
              
              ?>
            </ul>
          </div>
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
                  $query1 = "SELECT count(*)  as total FROM movie";
                  $run2 = mysqli_query($con, $query1);
                  if ($run2) {
                    while ($row2 = mysqli_fetch_assoc($run2)) {
                  ?>
                      <a href="detail.php?id=<?php echo (rand(1, $row2['total'])); ?>">Xem phim <strong>Ngẫu Nhiên</strong></a>
                  <?php
                    }
                  }
                  ?>
                </div>
              </div>
              <!-- Plugin facebook -->

              <div class="quiz">
                <div class="quiz_text">
                  <strong>Chuyên mục hỏi và trả lời.Đây là web đồ án của nhóm mong các bạn ủng hộ</strong>
                  <p>Xem thêm Page Facebook <a href="https://www.facebook.com/profile.php?id=100086581351351">Tại đây</a></p>
                </div>
                <div id="fb-root"></div>
                <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v15.0" nonce="aQlDu7tj"></script>
                <div class="fb-comments" data-href="http://localhost/3000" data-width="300" data-numposts="5" data-colorscheme="light"></div>
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
    <!-- Footer -->

    <?php
    include_once 'footer.php'
    ?>
<?php
  }
}
?>