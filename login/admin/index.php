<?php
	$host="localhost";
	$user = "root";
	$password="";
	$db = "login";

	$data= mysqli_connect($host,$user,$password,$db);
	if($data == false){
		die("connection error");
	}

	if($_SERVER['REQUEST_METHOD'] == "POST"){
		$username = $_POST['username'];
		$password = $_POST['password'];

		$sql = "SELECT * FROM user where username= '".$username."' AND password='".$password."' ";

		$result = mysqli_query($data, $sql);
		$row =mysqli_fetch_array($result);
		if ($row['usertype']== "admin") {
			header("location:display.php");
		}
		else{

			header("location:home.php");

		}
	


	}

?>






<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
	<br><br><br>
	<div style="background-color: gray; width: 500px; margin-left: 450px; margin-top: 200px ; padding-left: 20px;">
		<form action="#" method="POST">
			<div>
					<br><br><br>

				<label>username</label>
				<input type="text" name="username" requried>
			</div>
			<div>	<br><br>

				<label>password</label>
				<input type="password" name="password" requried>
			</div>
			<br><br>
			<div>
				<input type="submit" name="" value="submit">
			</div>
		</form>
	</div>
</body>
</html>