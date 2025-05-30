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
                <div class="fb-like" data-share="true" data-width="300" data-show-faces="true">
            </div>
            </div>
           
            <div id="fb-root"></div>
            <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v15.0" nonce="035N0j20"></script>
           
            <div class="fb-comments" data-href="http://localhost/3000" data-width="300" data-numposts="5" data-colorscheme="light"></div>
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
                      
                            <p><?php echo $row1['es_name'] ;?></p>
                   
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

        <!-- Top phim -->
        <div class="top_mv">
            <div class="tittle_top">
                <h3>
                    TOP PHIM HOT
                </h3>
                <div class="boder_top"></div>
                <div class="show_top">
                    <?php
                    $query1 = "SELECT * FROM movie ORDER BY mv_view DESC limit 10";
                    $run1 = mysqli_query($con, $query1);
                    if ($run1) {
                        while ($row1 = mysqli_fetch_assoc($run1)) {
                    ?>
                            <div class="flex_top">
                                <div class="img_top">
                                    <a href="detail.php?id=<?php echo $row1['id'] ?>&genre_id=<?php echo $row1['genre_id'] ?>">
                                        <img src="<?php echo $row1['mv_img'] ?>">
                                    </a>
                                </div>
                                <div class="name_top">
                                    <a href="detail.php?id=<?php echo $row1['id']; ?>&genre_id=<?php echo $row1['genre_id'] ?>">
                                        <p>
                                            <?php echo $row1['mv_name']; ?>
                                        </p>
                                    </a>
                                    <ion-icon name="eye"> </ion-icon> <?php echo $row1['mv_view']; ?>
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