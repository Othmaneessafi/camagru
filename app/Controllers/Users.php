<?php

    class Users extends Controller{

        public function __construct()
        {
            
        }

        public function signup() {
            if ($_SERVER['REQUEST_METHOD'] == 'POST')
            {

                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $data = [
                    'fullname' => trim($_POST['fullname']),
                    'email' => trim($_POST['email']),
                    'username' => trim($_POST['username']),
                    'password' => trim($_POST['password']),
                    'confirm_pwd' => trim($_POST['confirmPwd']),
                    'err_fullname' => '',
                    'err_email' => '',
                    'err_username' => '',
                    'err_password' => '',
                    'err_confirmPwd' => ''
                ];

                if (empty($data['fullname']))
                    $data['err_fullname'] = 'please enter fullname !!';
                if (empty($data['email']))
                    $data['err_email'] = 'please enter email !!';
                if (empty($data['username']))
                    $data['err_username'] = 'please enter username !!';
                if (empty($data['password']))
                    $data['err_password'] = 'please enter password !!';
                if ($data['password'] != $data['confirmPwd'])
                    $data['err_confirmPwd'] = 'Passwords do not match !!';

                if (empty($data['err_fullname']) && empty($data['err_email']) && empty($data['err_username']) &&
                    empty($data['err_password']) && empty($data['err_confirmPwd']))
                    die('success');
                else
                    $this->view('users/signup', $data);
            }
            else
            {
                $data = [
                    'fullname' => '',
                    'email' => '',
                    'username' => '',
                    'password' => '',
                    'confirm_pwd' => '',
                    'err_name' => '',
                    'err_email' => '',
                    'err_username' => '',
                    'err_password' => '',
                    'err_confirm-pwd' => ''
                ];

                $this->view('users/signup', $data);
            }
        }

        public function login() {
            if ($_SERVER['REQUEST_METHOD'] == 'POST')
            {
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $data = [
                    'username' => trim($_POST['username']),
                    'password' => trim($_POST['password']),
                    'err_username' => '',
                    'err_password' => '',
                ];

                if (empty($data['username']))
                    $data['err_username'] = 'please enter username !!';
                
                if (empty($data['password']))
                    $data['err_password'] = 'please enter password !!';

                if (empty($data['err_username']) && empty($data['err_password']))
                    die('success');
                else
                    $this->view('users/login', $data);
            }
            else
            {
                $data = [
                    'username' => '',
                    'password' => '',
                    'err_username' => '',
                    'err_password' => '',
                ];

                $this->view('users/login', $data);
            }
        }
    }