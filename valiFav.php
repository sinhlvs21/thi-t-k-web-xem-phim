<?php
include_once 'admin/db.php';
session_start();
?>
<?php 
if(isset($_GET['mv_id'])){
   $mv_id=$_GET['mv_id'];
   $id_user=$_SESSION['user'];
   $query3 = "SELECT * from account where uname= '$id_user' ";
   $run3 = mysqli_query($con,$query3);
   if ($run3) {
      while ($row3 = mysqli_fetch_assoc($run3)) {
          $user = $row3['id'];

   $query = " SELECT * from `favorite` where mv_id_fav=$mv_id and id_user=$user";
   $run = mysqli_query($con,$query);
   if($run){
     $count = mysqli_num_rows($run);
     if($count>0){
        $query1 = " DELETE FROM `favorite` where mv_id_fav=$mv_id and id_user=$user ";
        $run1 = mysqli_query($con,$query1);
        if($run1){
            echo "Chạy được phần xóa";
        }else{
           echo "không chạy được phần xóa";
        }
     }else{
        $query2 = " INSERT INTO `favorite`(`mv_id_fav`, `id_user`) VALUES ('$mv_id','$user')";
        $run2 = mysqli_query($con,$query2);
        if($run2){
        echo "Chạy được insert";
     }else{
        echo "Không chạy được insert";
     }
    }
   }else{
    echo "Lỗi về xử lý database";
    exit();
   }
}
   }
}
?>