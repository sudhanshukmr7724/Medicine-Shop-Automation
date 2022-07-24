<?php
		$host="localhost";
		$username="root";
		$pass="";
		$db="msa";
		$conn = mysqli_connect($host, $username,$pass,$db);

		if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
		}
?>
