<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/boot_css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css"> 
	<script src="js/jquery-3.2.1.min.js"></script>
    <title></title>
    <style>
    #cam {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
    #btns {
        position: absolute;
        left: 50%;
        transform: translate(-50%);
    }
    </style>
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
    <div id="cam">
        <video id="video" autoplay="true"></video><br>
        <div id="btns">
            <button id="snap" class="btn btn-info">Snap</button>
            <button id="clear" class="btn btn-danger">clear</button>
			<!-- <form action="inc/saveImage.php" method="POST"> -->
				<button id="save" name="saveImage" class="btn btn-success">Save</button>
			<!-- </form> -->
        </div>
        <canvas id="canvas"></canvas>
    </div>

	<script type="text/javascript">
		var video = document.getElementById('video');
		var canvas = document.getElementById('canvas');
		var context = canvas.getContext('2d');
		var clear = document.getElementById('clear');
		var snap = document.getElementById('snap');
		var save = document.getElementById('save');

		navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia
								|| navigator.oGetUserMedia || navigator.msGetUserMedia;

		if (navigator.getUserMedia)
		{
			navigator.getUserMedia({video:true, audio: false}, streamWebCam, throwError);
		}

		function streamWebCam(stream) {
			video.srcObject = stream;
			video.play();
		}
		function throwError(e) {
			alert(e.name);
		}


		//capture button
		snap.addEventListener('click', function() {
			canvas.width = video.clientWidth;
			canvas.height = video.clientHeight;
			context.drawImage(video, 0, 0);
      	}, false);

		//clear button
		clear.addEventListener('click', function() {
        	context.clearRect(0, 0, canvas.width, canvas.height);
      	}, false);

		save.addEventListener('click', function() {
			var dataURL = canvas.toDataURL('image/png');
			$.ajax({
				type: "POST",
				url: "inc/saveImage.php",
				data: {image: dataURL}
			});
		}, false);

		</script>
	</body>
</html>