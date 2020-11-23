<?php

$servername = "localhost";
$DBusername = "root";
$DBpassword = "";
$DBname = "loginsystem";

$conn = mysqli_connect($servername, $DBusername, $DBpassword, $DBname);

if (!$conn)
{
    die("Connection failed: ".mysqli_connect_error());
}