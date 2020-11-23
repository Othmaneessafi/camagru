<?php

if (isset($_POST['logup-button']))
{
    require 'dbh.php';

    $mail = $_POST['email'];
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $pwd = $_POST['password'];
    $Cpwd = $_POST['cpassword'];

    if (empty($mail) || empty($fullname) || empty($username) || empty($pwd) || empty($Cpwd)) {
        header("Location: ../logup.php?error=emptyfields");
        exit();
    }
    else if ((!filter_var($mail, FILTER_VALIDATE_EMAIL)) && (!preg_match("/^[a-zA-z0-9]*$/", $username)))
    {
        header("Location: ../logup.php?error=invalidemailandusername");
        exit();
    }
    else if (!filter_var($mail, FILTER_VALIDATE_EMAIL))
    {
        header("Location: ../logup.php?error=invalidemail");
        exit();
    }
    else if (!preg_match("/^[a-zA-z0-9]*$/", $username))
    {
        header("Location: ../logup.php?error=invalidusername");
        exit();
    }
    else if ($pwd != $Cpwd)
    {
        header("Location: ../logup.php?error=passwordsnotthesame");
        exit();
    }
    else
    {
        $sql = "SELECT * FROM users WHERE mail=? OR username=?";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql))
        {
            header("Location: ../logup.php?error=sqlfailed");
            exit();
        }
        else
        {
            mysqli_stmt_bind_param($stmt, "ss", $mail, $username);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $res = mysqli_stmt_num_rows($stmt);
            if ($res > 0)
            {
                header("Location: ../logup.php?error=mailorusernametaken");
                exit();
            }
            else
            {
                $sql = "INSERT INTO users (fullname, username, pwd, mail) VALUES (?, ?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql))
                {
                    header("Location: ../logup.php?error=sqlfailed");
                    exit();
                }
                else
                {
                    $hashedpwd = password_hash($pwd, PASSWORD_DEFAULT);
                    mysqli_stmt_bind_param($stmt, "ssss", $fullname, $username, $hashedpwd, $mail);
                    mysqli_stmt_execute($stmt);
                    header("Location: ../index.php?success");
                    exit();
                }
            }
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
else
{
    header("Location: ../logup.php");
    exit();
}