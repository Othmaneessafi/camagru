<?php
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/boot_css/bootstrap.min.css">  
    <link rel="stylesheet" type="text/css" href="css/logup.css">
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/popper.min.js"></script>    
    <script src="css/boot_js/bootstrap.js"></script>
    <title></title>
    <style>
        #alert
        {
            font-size: 20px;
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
            color: red;
        }
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
                <h1 id="cmr">Camagru</h1>';
                if (isset($_GET['error']))
                {
                    if ($_GET['error'] == "emptyfields")
                    {
                        echo '<p id="alert">Fill in all the fields !</p>';
                    }
                        
                    else if ($_GET['error'] == "invalidemailandusername")
                        echo '<p id="alert">Enter a valid email and username !</p>';
                    else if ($_GET['error'] == "invalidemail")
                        echo '<p id="alert">Enter a valid email !</p>';
                    else if ($_GET['error'] == "passwordsnotthesame")
                        echo '<p id="alert">The passwords not identical !</p>';
                    else if ($_GET['error'] == "invalidusername")
                        echo '<p id="alert">Enter a valid username !</p>';
                }
            echo '</div>
            <form id="frm" action="inc/up.php" method="POST">
                <input type="text" name="email" class="form-control" id="user1" placeholder="Email"><br>
                <input type="text" name="fullname" class="form-control" id="user" placeholder="Full name"><br>
                <input type="text" name="username" class="form-control" id="user" placeholder="Username"><br>
                <input type="password" name="password" class="form-control" id="user" placeholder="Password"><br>
                <input type="password" name="cpassword" class="form-control" id="user" placeholder="Confirm Password"><br>
                <button type="submit" name="logup-button"  class="btn btn-primary" id="log">Sign up</button>
            </form>
            </div>
            <div id="logup">
            <div id="up">
                <p id="signup">Already have an account?<a href="login.php"> log in</a></p>
                </div>
            </div>';
		}
	?>
	
</body>
</html>