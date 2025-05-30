<?php
include 'admin/db.php';
session_start();
?>
 <?php
    if (isset($_POST['submit'])) {
        $user = $_SESSION['user'];
        $query8 = "SELECT * from account where uname= '$user' ";
        $run8 = mysqli_query($con, $query8);
        if ($run8) {
            while ($row8 = mysqli_fetch_assoc($run8)) {
                $id_user = $row8['id'];
                $mv_id = $_GET['mv_id'];
       $query9 = "DELETE  from `favorite` where id_user=$id_user and mv_id_fav = $mv_id ";
                        $run9 = mysqli_query($con, $query9);
                        if ($run9) {
                            echo "<script>window.location.href='myMovie.php';</script>";
                                
                            exit();
                        } else {
                            echo "<div class='noti'> 
                                    <h2> Thông báo lỗi </h2>
                                    <p> Đã xảy ra lỗi về database </p>
                                 </div>";
                            exit();
                        }
                    }
                }
            }
   
    ?>