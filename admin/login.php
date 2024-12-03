<?php 
 include '../lib/Database.php';
 include '../config/config.php';
 include '../helpers/Format.php';
?>
<?php 
include '../lib/Session.php';
Session:: checkLogin();
?>

<?php
$db = new Database();
$fm = new Format();
?>


<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">
 <?php
 if(isset($_POST['login'])){
	 //validation is helper function from helpers/Format.php';'
	$username = $fm->validation($_POST['username']);
	$password = $fm->validation($_POST['password']);
	$username = mysqli_real_escape_string($db->link, $username);
	$password = mysqli_real_escape_string($db->link, $password);

	$query = "SELECT id, username FROM tbl_user WHERE username = '$username' AND password = '$password'";

	$result = $db->select($query);

	if($result != false){
		  $value = $result->fetch_assoc();
		  	Session::set("login", true);
			Session::set("username", $value['username']);
			Session::set("userId", $value['id']);
			Session::set("userRole", $value['role']);
			header("Location:index.php");
}else{
echo "<span style='color:red; font-size:17px; font-weight:bold'>Username or Password Dosen't match</span>";
 }
}
 ?>
 
 <form action="login.php" method="post">
			<h1>Admin Login</h1>
			<div>
				<input type="text" placeholder="Username"  name="username"/>
			</div>
			<div>
				<input type="password" placeholder="Password"  name="password"/>
			</div>
			<div>
				<input type="submit" value="Login" name="login"/>
			</div>
		</form>
		<div class="button">
		 <a href="forgotPass.php">Forgot Password</a>
		</div>
	</section>
</div>
</body>
</html>