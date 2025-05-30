<?php
include 'admin/db.php';
?>
<?php
if(isset($_POST['input'])){
    $input = $_POST['input'];
    $input_preg =preg_replace("#[^0-9a-z]#i", "", $input);
    $query = "SELECT * FROM movie where mv_name LIKE '%$input%' ORDER BY id limit 3  ";
    $run = mysqli_query($con,$query);
    if(mysqli_num_rows($run)>0){?>
    <?php
    while($row = mysqli_fetch_assoc($run)){
     ?>
            <li>
            <div class="search_flex" style="display:flex;">
            <div class="img"><a href="detail.php?id=<?php echo $row['id'] ;?>"><img src="<?php echo $row['mv_img'] ;?>"style="width:55px;height:70px; margin-top:10px;"></a></div>
            <div class="name" >
            <a style="text-decoration: none; color:#fff;margin-top:10px;"; href="detail.php?id=<?php echo $row['id'];?>&genre_id=<?php echo $row['genre_id'];?>"> <?php echo $row['mv_name'] ;?> </a>
            </div>
    </li>
    <?php
}
    }
}
?>