<?php
include 'admin/db.php';

?>
<!-- Phim bộ -->

<head>
  <link rel="stylesheet" type="text/css" href="/CSSPage/listmv.css">
</head>
<section>
  <div class="genre">
    <div class="name_genre">
      <h3>PHIM BỘ</h3>
      <a href="viewgenre.php?id=1">
        <p class="more"> Xem Thêm <ion-icon name="arrow-forward"></ion-icon>
        </p>
      </a>
    </div>
    <div class="mv_genre">
      <?php
      $query = "SELECT * FROM movie where genre_id=1 ORDER BY mv_date DESC limit 10";
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


</section>

<!-- Phim lẻ -->

<section>
  <div class="genre">
    <div class="name_genre">
      <h3>PHIM LẺ</h3>
      <a href="viewgenre.php?id=2">
        <p class="more"> Xem Thêm <ion-icon name="arrow-forward"></ion-icon>
        </p>
      </a>
    </div>
    <div class="mv_genre">
      <?php
      $query = "SELECT * FROM movie where genre_id=2 ORDER BY mv_date DESC limit 10";
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
</section>

<!-- Phim chiếu rạp -->

<section>
  <div class="genre">
    <div class="name_genre">
      <h3>PHIM CHIẾU RẠP</h3>
      <a href="viewgenre.php?id=3">
        <p class="more"> Xem Thêm <ion-icon name="arrow-forward"></ion-icon>
        </p>
      </a>
    </div>
    <div class="mv_genre">
      <?php
      $query = "SELECT * FROM movie where genre_id=3 ORDER BY mv_date DESC limit 10";
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
</section>

<!-- Phim hoạt hình -->

<section>
  <div class="genre">
    <div class="name_genre">
      <h3>PHIM HOẠT HÌNH</h3>
      <a href="viewgenre.php?id=4">
        <p class="more"> Xem Thêm <ion-icon name="arrow-forward"></ion-icon>
        </p>
      </a>
    </div>
    <div class="mv_genre">
      <?php
      $query = "SELECT * FROM movie where genre_id=4 ORDER BY mv_date DESC limit 10";
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
</section>