<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://unpkg.com/ionicons@4.5.10-0/dist/css/ionicons.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="/CSSPage/header.css">
  <title>Home</title>
</head>

<body>
  <div class="wrapper_user">
    <div class="navbar">

      <!-- Logo trang web -->

      <div class="logo">
        <a href="homeLogin.php">
        <img src="images/85bb7cc6796140939b8e497f510904bb.png" alt="Logo">
        </a>
      </div>

      <!-- Thanh navbar -->

      <div class="nav_item">
        <ul>
          <li><a href="homeLogin.php" class="active">TRANG CHỦ</a></li>
          <li><a href="viewgenre.php?id=2">PHIM LẺ</a></li>
          <li><a href="viewgenre.php?id=1">PHIM BỘ</a></li>
          <li><a href="viewgenre.php?id=3">PHIM CHIẾU RẠP</a></li>
          <li class="dropdown"><a href="viewcat.php">THỂ LOẠI</a>
            <div class="dropdown_content">
              <div class="flex_cat">
                <div class="cat_name">
                  <?php
                  $query4 = "SELECT * from category  limit 4";
                  $run4 = mysqli_query($con, $query4);
                  if ($run4) {
                    while ($row4 = mysqli_fetch_assoc($run4)) {
                  ?>
                      <div>
                        <a href="viewcat.php?id=<?php echo $row4['id']; ?>"><?php echo $row4['category_name'] ?></a>
                      </div>
                  <?php
                    }
                  }
                  ?>
                </div>
                <div class="cat_name">
                  <?php
                  $query4 = "SELECT * from category ORDER BY id DESC limit 4";
                  $run4 = mysqli_query($con, $query4);
                  if ($run4) {
                    while ($row4 = mysqli_fetch_assoc($run4)) {
                  ?>
                      <div>
                        <a href="viewcat.php?id=<?php echo $row4['id']; ?>"><?php echo $row4['category_name'] ?></a>
                      </div>
                  <?php
                    }
                  }
                  ?>
                </div>
              </div>
            </div>
          </li>
          <li class="dropdown nation"><a href="#">QUỐC GIA</a>
            <div class="dropdown_content">
              <div class="flex_cat">
                <div class="cat_name">
                  <?php
                  $query4 = "SELECT * from nation  limit 3";
                  $run4 = mysqli_query($con, $query4);
                  if ($run4) {
                    while ($row4 = mysqli_fetch_assoc($run4)) {
                  ?>
                      <div>
                        <a href="viewnation.php?id=<?php echo $row4['id']; ?>"><?php echo $row4['nation_name'] ?></a>
                      </div>
                  <?php
                    }
                  }
                  ?>
                </div>
                <div class="cat_name">
                  <?php
                  $query4 = "SELECT * from nation ORDER BY id DESC limit 3";
                  $run4 = mysqli_query($con, $query4);
                  if ($run4) {
                    while ($row4 = mysqli_fetch_assoc($run4)) {
                  ?>
                      <div>
                        <a href="viewnation.php?id=<?php echo $row4['id']; ?>"><?php echo $row4['nation_name'] ?></a>
                      </div>
                  <?php
                    }
                  }
                  ?>
                </div>
              </div>
            </div>
          </li>

          <li class="dropdown year"><a href="#">NĂM</a>
            <div class="dropdown_content year_drop">
              <div class="flex_cat">
                <div class="cat_name year_hidden">
                  <?php
                  $query4 = "SELECT * from year ORDER BY (id)DESC limit 4";
                  $run4 = mysqli_query($con, $query4);
                  if ($run4) {
                    while ($row4 = mysqli_fetch_assoc($run4)) {
                  ?>
                      <div>
                        <a href="viewyear.php?id=<?php echo $row4['id']; ?>"><?php echo $row4['year'] ?></a>
                      </div>
                  <?php
                    }
                  }
                  ?>
                </div>
                <div class="cat_name year_hidden">
                  <?php
                  $query4 = "SELECT * from year ORDER BY (id) limit 4 offset 19";
                  $run4 = mysqli_query($con, $query4);
                  if ($run4) {
                    while ($row4 = mysqli_fetch_assoc($run4)) {
                  ?>
                      <div>
                        <a href="viewyear.php?id=<?php echo $row4['id']; ?>"><?php echo $row4['year'] ?></a>
                      </div>
                  <?php
                    }
                  }
                  ?>
                </div>
              </div>
            </div>
          </li>

        </ul>
      </div>

      <!-- Form search -->
      <div class="search_nav">
        <form action="searchresult.php" method="GET">
          <input id="search_mv" type="text" name="search_page" placeholder="Tìm kiếm: phim, diễn viên...">
          <button type="submit" name="submit">
            <ion-icon name="search"></ion-icon>
          </button>
        </form>
        <ul id="search_result">

        </ul>
      </div>

      <!-- Form đăng kí đăng nhập -->

      <div class="user_login">
        <input type="text" class="textBox" placeholder="Chào, <?php echo $_SESSION['user']; ?>" readonly >
        <div class="option">
          <div onclick="show('')">
            <a href="userInfor.php">
              <ion-icon name="contact"></ion-icon> Thông tin cá nhân
            </a>
          </div>

          <div onclick="show('')">
            <a href="myMovie.php">
              <ion-icon name="heart"></ion-icon> Tủ phim
          </div>
          <?php
          $user = $_SESSION['user'];
          $sql1 = "SELECT * from account where uname= '$user' ";
          $check1 = mysqli_query($con, $sql1);
          if ($check1) {
            while ($acc = mysqli_fetch_assoc($check1)) {
              if ($acc['role'] == 1) {


          ?>
                <div onclick="show('')">
                  <a href="admin/dashboard.php">
                    <ion-icon name="arrow-round-back"></ion-icon> Về trang quản trị
                  </a>
                </div>
          <?php
              }
            }
          }
          ?>
          <div onclick="show('')">
            <a href='logout.php'>
              <ion-icon name="log-out"></ion-icon> Logout
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script type="module" src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule="" src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons/ionicons.js"></script>

  <!-- Search bằng ajax -->
  <script type="text/javascript">
    $(document).ready(function() {
      $("#search_mv").keyup(function() {
        var input = $(this).val();
        if (input != "") {
          $.ajax({
            url: "searchpage.php",
            method: "POST",
            data: {
              input: input
            },
            success: function(data) {
              $("#search_result").html(data);
            }
          });
        } else {
          $("#search_result").html("");
        }
      })
    })

    // dropdown
    function show(anything) {
      document.querySelector('.textbox').value = anything;

    }

    let user_login = document.querySelector('.user_login');
    document.onclick = function(e) {
      if (e.target.class == '.option') {
        user_login.classList.remove('active');
      }
    }
    user_login.onclick = function() {
      user_login.classList.toggle('active');
    }
  </script>
</body>

</html>