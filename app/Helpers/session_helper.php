<?php
    session_start();

    function pop_up($name = '', $msg = '',  $class = 'alert alert-success')
    {
        if (!empty($name))
        {
            if (!empty($msg) && empty($_SESSION[$name]))
            {
                if (!empty($_SESSION[$name]))
                    unset($_SESSION[$name]);
                if (!empty($_SESSION[$name. '_class']))
                    unset($_SESSION[$name. '_class']);

                $_SESSION[$name] = $msg;
                $_SESSION[$name. '_class'] = $class;
            }
            else if (empty($msg) && !empty($_SESSION[$name]))
            {
                $class = !empty($_SESSION[$name. '_class']) ? $_SESSION[$name. '_class'] : '';
                echo '<div class="'.$class.'" id="msg">'.$_SESSION[$name]. '</div>';
                unset($_SESSION[$name]);
                unset($_SESSION[$name. '_class']);
            }
        }
    }

    function redirect($page){
        echo "<script>location.replace('". URL_ROOT . '/' . $page."')</script>";
    }

    function isLogged()
    {
        if (isset($_SESSION['user_id']))
            return true;
        else
            return false;
    }