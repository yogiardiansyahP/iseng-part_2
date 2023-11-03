<?php 

session_start();

	include("connection.php");
	include("functions.php");


	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$user_name = $_POST['user_name'];
		$password = $_POST['password'];

		if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
		{

			//read from database
			$query = "select * from users where user_name = '$user_name' limit 1";
			$result = mysqli_query($conn, $query);

			if($result)
			{
				if($result && mysqli_num_rows($result) > 0)
				{

					$user_data = mysqli_fetch_assoc($result);
					
					if($user_data['password'] === $password)
					{

						$_SESSION['user_id'] = $user_data['user_id'];
						header("Location: home.html");
						die;
					}
				}
			}
			
			echo "wrong username or password!";
		}else
		{
			echo "wrong username or password!";
		}
	}

?>


<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="shortcut icon" href="C.png" type="image/x-icon">

	<style type="text/css">
	
	#text{

		height: 25px;
		border-radius: 5px;
		padding: 4px;
		border: solid thin #aaa;
		width: 100%;
	}

	#button{
		margin-left: 7em;
		padding: 10px;
		border-radius: 20px;
		width: 100px;
		color: white;
		background-color: #176B87;
		border: none;
	}

	#box{

		margin-top: 10em;
		margin-left: 33em;
		background-color: rgba(155, 155, 155, 0.7);
		width: 300px;
		padding: 20px;
	}

	#box > form > a {
		color: #fff;
		text-decoration: none;
		margin-left: 5em;
	}

	#box > form > p{
		text-align: center;
		
	}

	body{
		background-image: url("./img/bg3.jpg");
		background-repeat: no-repeat;
		background-size: cover;
	}

	</style>

</head>
<body>


	<div id="box">
		
		<form method="post">
			
			<div style="font-size: 20px;margin-left:6em;margin-bottom:10px;color: white;">Login</div>

			<input id="text" type="text" name="user_name" placeholder="User Name"><br><br>
			<input id="text" type="password" name="password" placeholder="Password"><br><br>

			<input id="button" type="submit" value="Login"><br><br>
			<p >Don’t Have an O-Book.com account ?</p>
			<a href="signup.php">Create An Account</a><br><br>
			<div><a style="font-size:20px; text-decoration:none; float:right; color:#fff;" href="admin.login.php">Admin</a></div>
		</form>
	</div>
</body>
</html>