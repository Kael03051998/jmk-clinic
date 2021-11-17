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
			$result = mysqli_query($con, $query);

			if($result)
			{
				if($result && mysqli_num_rows($result) > 0)
				{

					$user_data = mysqli_fetch_assoc($result);
					
					if($user_data['password'] === $password)
					{

						$_SESSION['user_id'] = $user_data['user_id'];
						header("Location: home.php");
						die;
					}
				}
			}
			
			echo "username already taken or credentials!";
		}else
		{
			echo "wrong username or password!";
		}
	}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" type="text/css" href="style1.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">


</head>
<body>
    <header>
	

            <ul>


                <li><a href="#">WELCOME</a></li>

            </ul>
        </div>
        <div class="centers">

		<h1> Welcome to JMK Clinic <br> Covid 19 Testing Center</h1>
		
        </div>
        <style type="text/css">

	
	#text{
		
		height: 25px;
		border-radius: 5px;
		padding: 4px;
		border: solid thin #aaa;
		width: 100%;

	}

	#button{

		padding: 10px;
		width: 100px;
		color: white;
		background-color: lightblue;
		border: none;

	}

	#box{
		background-color: grey;
		margin: auto;
		width: 300px;
		height: 300px;
		padding: 20px;

	}
    

	</style>

	<div id="box">
		
		<form method="post">
			<div style="font-size: 20px;margin: 10px;color: white;">Login</div>

			<input id="text" type="text" name="user_name" placeholder="Username.."><br><br>
			<input id="text" type="password" name="password" placeholder="Password.."><br><br>

			<input id="button" type="submit" value="Login"><br><br>

			<a href="welcome1.php">Click to Signup</a><br><br>
		</form>
	</div>
	



</header>

<footer>
    <div class="footer">Copyright © 2021
        <a href="https://www.facebook.com/cicsdecoders">
        <img src="fb.png" width="20px" height="17px">
    </a>
    </div>
</footer>
    
</body>
</html>