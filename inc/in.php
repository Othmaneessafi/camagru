<?php
if(isset($_POST['login-button']))
{
    require 'dbh.php';

    $user = $_POST['username'];
    $pass = $_POST['password'];

    if (empty($user) || empty($pass))
    {
        header("Location: ../login.php?emptyfields");
        exit();
    }
    else
    {
        $sql = "SELECT * FROM users WHERE username=? OR mail=?";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql))
        {
            header("Location: ../login.php?error=sqlfailed");
            exit();
        }
        else
        {
            mysqli_stmt_bind_param($stmt, "ss", $user, $user);
            mysqli_stmt_execute($stmt);
            $res = mysqli_stmt_get_result($stmt);
            if ($row = mysqli_fetch_assoc($res))
            {
                $pwdcheck = password_verify($pass, $row['pwd']);
                if ($pwdcheck == false)
                { 
                    header("Location: ../login.php?error=wrong+password");
                    exit();
                }
                else if($pwdcheck == true)
                {
                    session_start();
                    $_SESSION['userId'] = $row['id'];
                    $_SESSION['username'] = $row['username'];
                    header("Location: ../index.php?logged+in");
                    exit();
                }
            }
            else
            {
                header("Location: ../login.php?error=user+not+found");
                exit();
            }

        }

    }

}
else
{
    header("Location: ../login.php");
    exit();
}

?>