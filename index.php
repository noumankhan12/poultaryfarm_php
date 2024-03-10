<?php
    include 'includes/database.php';
    include 'includes/loginServer.php';
    session_start();
    // instantiating LoginServer class to access its functions/methods
    $data = new LoginServer();
    // variable to store message
    $message = "";
    // check if login was clicked
    if(isset($_POST["login"])){
        $field = array(
            "Username" => $_POST["Username"],
            "Password" => $_POST["Password"]
        );
        if($data->loginValidation($field)){
            if($data->canLogin("User", $field)){
                $_SESSION["Username"] = $_POST["Username"];
                header("location: dashboard.php");
            }else{
                $message = $data->error;
            }
        }else{
            // if input fields are blank, execute else statement: if both input fields are blank
            $message = $data->error;
        }
    }
?>
<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./loginStyles.css" />
    <title>EPMS Login</title>
</head>
<body>
    <div class="login__container">
        <h1>Admin Login</h1>
        
        <form action="" method="post">
            <input type="text" name="Username" placeholder="Username">
            <input type="password" name="Password" placeholder="Password">
            <button type="submit" name="login">Login</button>
        </form>
    </div>   
</body>
</html> -->



<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Login Page</title>
  <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">


<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous"><link rel="stylesheet" href="./style.css">

</head>
<body>
<!-- partial:index.partial.html -->
<div class="box-form">
	<div class="left">
		<div class="overlay">
		<h1>Poultry Farm</h1>
		<p>Revolutionize your poultry farm management. Streamline operations, ensure animal welfare, and maximize efficiency with our integrated system.</p>
		<!-- <span>
			<p>login with social media</p>
			<a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
			<a href="#"><i class="fa fa-twitter" aria-hidden="true"></i> Login with Twitter</a>
		</span> -->
		</div>
	</div>
	
	
		<div class="right">
		<img src="images/logo.png" alt="">
		<!-- <p>Don't have an account? <a href="#">Creat Your Account</a> it takes less than a minute</p> -->
		<div class="login__container">
        <h5>Login</h5>
        <?php
            // display error message
            if(isset($message)){
                echo '<label>' . $message . '</label>';
            }
        ?>
        <form action="" method="post">
            <input type="text" name="Username" placeholder="Username">
            <input type="password" name="Password" placeholder="Password">
            <button type="submit" name="login">Login</button>
        </form>
    </div>
			
			<br><br>
			
		<!-- <div class="remember-me--forget-password">
			
	<label>
		<input type="checkbox" name="item" checked/>
		<span class="text-checkbox">Remember me</span>
	</label>
			<p>forget password?</p>
		</div>
			
			<br>
			<button>Login</button>
	</div> -->
	
</div>
<!-- partial -->
  
</body>
</html>
