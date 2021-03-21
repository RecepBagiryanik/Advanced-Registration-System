<?php 
// Github : RecepBagiryanik
// Advanced Registration System
// Feel happy while using it
include "connect.php";
include "function.php";
include "csrf.php";
error_reporting(0);
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
	<title>RecepBagiryanik / Register Project</title>
	<link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>
	<div class="container">
		<?php 
		if (isset($_SESSION["username"])) {
			echo "<center>";
			echo "Hi " . $_SESSION["username"];
			echo "<br>";
			echo "<a href='logout.php'>Çıkış Yap</a></center>";
		}
		?>
		<?php 
		if (!isset($_SESSION["username"])) { ?>
			<center>
				<div style="margin-top: 18em;"></div>
				<div class="card border-bottom-radius" style="width: 30rem; border: 0px;">
					<?php 
					$username=filteredcontent($_POST["username"]);
					$email=filteredcontent($_POST["email"]);
					$password=filteredcontent($_POST["password"]);
					$repassword=filteredcontent($_POST["repassword"]);
					$creationip=$_SERVER["REMOTE_ADDR"];
					$defaultpermission=0; // You Change The Default Permission Level
					$accountusername=$db->prepare("SELECT * FROM accounts where username = ?");
					$accountusername->execute(array($_POST["username"]));
					$accountemail=$db->prepare("SELECT * FROM accounts where email = ?");
					$accountemail->execute(array($email));
					if (isset($_POST["register"])) {
						if (csrf() == 1) {
							if ($username == null or $email == null or $password == null or $repassword == null) {
								echo error("Please Fill In The Form Information");
							} elseif ($accountusername->rowCount() > 0) {
								echo error("Your Username is Already Using By Another User");
							} elseif ($accountemail->rowCount() > 0) {
								echo error("Your Email Address is Already Using By Another User");
							} elseif ($password != $repassword) {
								echo error("Your Passwords Do Not Match");
							} elseif (emailcheck($email) == 0) {
								echo error("Please Use an Appropriate Email Account");
							} elseif (checkusername($username)) {
								echo error("Your Username is Contains İllegal Characters");
							} else {
								echo success("Registration is Successful");
								$accountinsert=$db->prepare("INSERT INTO accounts set username=:username, email=:email, password=:password, creationip=:creationip, permission=:permission");
								$accountinsert->execute(array("username" => $username, "email" => $email, "password" => $password, "creationip" => $creationip, "permission" => $defaultpermission));
								$_SESSION["username"] = $username;
								header("Refresh: 1");
							}
						} else {
							echo error("Problem Occurred Please Try Again");

						}
					}
					?>
					<div class="card-header" style="background: black; color:white;">Register Form</div>
					<div class="card-body border-bottom-radius" style="background-color: #f0eded;">
						<form action="" method="post">
							<input type="text" required="" class="form-control" placeholder="Username" name="username"><br>
							<input type="email" required="" class="form-control" placeholder="Email" name="email"><br>
							<input type="password" required="" class="form-control" placeholder="Password" name="password"><br>
							<input type="password" required="" class="form-control" placeholder="Repassword" name="repassword"><br>
							<input type="hidden" name="csrftoken" value="<?php echo $_SESSION["csrftoken"] ?>">
							<button name="register" class="btn btn-primary btn-block">Register</button>
						</form>
					</div>
				</div>
			</center>
		<?php } ?>

	</div>
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>
</html>

