<?php
echo '<script>console.log("Your stuff here")</script>';
session_start();

if (isset($_POST['saveImage']))
{
    require 'dbh.php';
    $imgData = $_POST['image'];
    $imgName = $_SESSION['username'];
    $imgDir = "../Img";

    $sql="insert into userImage(imageName, imageDir, imageData) values(?, ?, ?)";
    $stmt = mysqli_stmt_init($conn);

    mysqli_stmt_bind_param($stmt, "sss", $imgName, $imgDir ,$imgData);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    $res = mysqli_stmt_num_rows($stmt);
}
else
{
    header("Location: ../camera.php");
    exit();
}