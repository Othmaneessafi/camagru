<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/boot_css/bootstrap.min.css">  
	<title></title>
</head>
<body>

	
	<?php
	$user = $_SESSION['username'];
		if (isset($_SESSION['userId']))
		{
			echo '<header>
			<nav class="navbar navbar-expand-lg navbar-light bg-light">
		  <a class="navbar-brand" href="#">Camagru</a>
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		  </button>
		  <div class="collapse navbar-collapse" id="navbarNav">
			<ul class="navbar-nav">
			  <li class="nav-item active">
				<a class="nav-link" href="index.php">Home</a>
			  </li>
			  <li class="nav-item">
			  	<a class="nav-link" href="index.php">'.$user.'</a>
			  </li>
			  <li class="nav-item">
				<form action="inc/out.php">
					<button type="submit" name="logout" class="btn btn-light">logout</button>
				</form>
			  </li>
			  <li class="nav-item active">
				<a class="nav-link" href="camera.php">Camera</a>
			  </li>
			</ul>
		  </div>
		</nav>
			</header>
			
					
				</form>';
				echo '<h1>You are logged in '.$user.'</h1>';
		}
		else
		{
			header("Location: login.php");
			exit();
		}
	?>
</body>
</html>