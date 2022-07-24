<!DOCTYPE html>
<html>

<link rel="stylesheet" type="text/css" href="login1.css">
<head>
<div class="header">
  <h1>Medical Shop Automation System</h1>

</div>
<title>
Medical Shop Automation System
</title>
</head>

<body style="background-image:url(mainPage_pic.jpg);">

	<br><br>
	<div class="container">
		<form method="post" action="">
			<div id="div_login" style="background-color: #dae8e5; padding: 30px; border-radius: 10px;" class="mt-4">
				<h1>Login Here</h1>
				<center>
				<div>
          	<label for="username" class="form-label" style="text-align:left;">Username</label>
					<input type="text" class="textbox" id="uname" name="uname" placeholder="Username" />
				</div>
				<div>
          <label for="password" class="form-label">Password</label>
					<input type="password" class="textbox" id="pwd" name="pwd" placeholder="Password"/>
				</div>
				<div>

				<input type="submit" value="Submit" name="submit" id="submit" />
				<!--<input type="submit" value="Click here for Pharmacist Login" name="psubmit" id="submit" /> -->

	<?php

		include "config.php";

		if(isset($_POST['submit'])){

				$uname = mysqli_real_escape_string($conn,$_POST['uname']);
				$password = mysqli_real_escape_string($conn,$_POST['pwd']);

			if ($uname != "" && $password != ""){

					$sql="SELECT * FROM admin WHERE a_username='$uname' AND a_password='$password'";
					$result = $conn->query($sql);
					$row = $result->fetch_row();
					if(!$row) {
						echo "<p style='color:red;'>Invalid username or password!</p>";
					}
					else {
						session_start();
						$_SESSION['user']=$uname;
						header('location:adminmainpage.php');
					}
				}
			}

		if(isset($_POST['psubmit']))
		{
			header("location:mainpage1.php");
		}
	?>

				</div>
				</center>
			</div>
		</form>
	</div>

	<div class=footer>
	<br>
  Developed by:GRP-13(GRP2)
	<br><br>
	</div>

</body>

</html>
