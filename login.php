<?php
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/boot_css/bootstrap.min.css">  
	<link rel="stylesheet" type="text/css" href="css/style.css">
    <title></title>
    <style>
    </style>
</head>
<body>
    <?php
		if (isset($_SESSION['userId']))
		{
            header("Location: index.php");
            exit();
		}
		else
		{
			echo '<div id="login_form">
            <div id="logo">
                <h1>Camagru</h1>
            </div>
            <form id="frm" action="inc/in.php" method="POST">
                <input type="text" name="username" class="form-control" id="user" placeholder="Username or email" >
                <input type="password" name="password" class="form-control" id="user" placeholder="Password"><br>
                <button type="submit" name="login-button" class="btn btn-primary" id="log">Log in</button>
            </form>
            <div id="forgot">
                <a href="#">Forgot password?</a>
            </div>
        </div>
        <div id="logup">
            <div id="up">
               <p id="signup">Don t have an account?<a href="logup.php"> sign up</a></p>
            </div>
        </div>';
		}
	?>
</body>
</html>