﻿<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<div class="grid_10">

<div class="box round first grid">
<h2>Update Social Media</h2>
<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $fb = $fm->validation($_POST['fb']);
    $tw = $fm->validation($_POST['tw']);
    $ln = $fm->validation($_POST['ln']);
    $gp = $fm->validation($_POST['gp']);

	$fb = mysqli_real_escape_string($db->link, $fb);
	$tw = mysqli_real_escape_string($db->link, $tw);
	$ln = mysqli_real_escape_string($db->link, $ln);
	$gp = mysqli_real_escape_string($db->link, $gp);

    if ($fb == "" || $tw == "" || $ln == "" || $gp == ""){
      echo "<span class='error'>Field Must Not be Empty!!</span>";
    } else {
        $query = "UPDATE tbl_social SET 
         fb = '$fb',
         tw = '$tw',
         ln = '$ln',
         gp = '$gp'
         WHERE id='1'";

        $updateSocial = $db->update($query);
        if ($updateSocial) {
            echo "<span class='success'>Social Updated Successfully!!</span>";
   } else{
      echo "<span class='error'>Something went wrong :( Please try again !!</span>";
 }
    }
}
?>

<div class="block">   
<?php
 $query = "SELECT * FROM tbl_social WHERE id=1";
 $social_title = $db->select($query);
 if ($social_title) {
   while ($result = $social_title->fetch_assoc()){
 ?>            
<form action="" method="post" enctype="multipart/form">
<table class="form">					
<tr>
    <td>
        <label>Facebook</label>
    </td>
    <td>
        <input type="text" name="fb" value="<?php echo $result['fb']?>" class="medium" />
    </td>
</tr>
    <tr>
    <td>
        <label>Twitter</label>
    </td>
    <td>
        <input type="text" name="tw"  value="<?php echo $result['tw']?>" class="medium" />
    </td>
</tr>

    <tr>
    <td>
        <label>LinkedIn</label>
    </td>
    <td>
        <input type="text" name="ln"  value="<?php echo $result['ln']?>" class="medium" />
    </td>
</tr>

    <tr>
    <td>
        <label>Google Plus</label>
    </td>
    <td>
        <input type="text" name="gp" value="<?php echo $result['gp']?>" class="medium" />
    </td>
</tr>

    <tr>
    <td></td>
    <td>
        <input type="submit" name="submit" Value="Update" />
    </td>
</tr>
</table>
</form>
<?php } } ?>
</div>
</div>
</div>

<?php include 'inc/footer.php';?>