<?php

    class Users extends Controller{

        public function __construct()
        {
            $this->userModel = $this->model('User');
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
                else
                {
                    if($this->userModel->findUsrByEmail($data['email']))
                        $data['err_email'] = 'Email is already taken !!';
                }
                if (empty($data['username']))
                    $data['err_username'] = 'please enter username !!';
                else
                {
                    if($this->userModel->findUsrByUsername($data['username']))
                        $data['err_username'] = 'Username is already taken !!';
                }
                if (empty($data['password']))
                    $data['err_password'] = 'please enter password !!';
                if ($data['password'] != $data['confirm_pwd'])
                    $data['err_confirmPwd'] = 'Passwords do not match !!';

                if (empty($data['err_fullname']) && empty($data['err_email']) && empty($data['err_username']) &&
                    empty($data['err_password']) && empty($data['err_confirmPwd']))
                {
                    $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                    if ($this->userModel->signup($data))
                    {
                        pop_up('signup_ok', 'You are now part of our community, you can login now');
                        redirect('users/login');
                    }
                    else
                        die('wrong');
                }                   
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
                else if(!$this->userModel->findUsrByUsername($data['username']))
                    $data['err_username'] = 'Username doest not exist !!';
                if (empty($data['password']))
                    $data['err_password'] = 'please enter password !!';

                if (empty($data['err_username']) && empty($data['err_password']))
                {
                    $loggedUser = $this->userModel->login($data['username'], $data['password']);
                    if ($loggedUser)
                    {
                        $this->createUserSession($loggedUser);
                    }
                    else
                    {
                        $data['err_password'] = 'Invalid password !!';
                        $this->view('users/login', $data);
                    }   
                }
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

        public function logout()
        {
            unset($_SESSION['userid']);
            unset($_SESSION['user_email']);
            unset($_SESSION['user_username']);
            unset($_SESSION['user_fullname']);

            session_destroy();
            redirect('users/login');
        }

        public function createUserSession($user)
        {
            $_SESSION['user_id'] = $user->id;
            $_SESSION['user_email'] = $user->email;
            $_SESSION['user_username'] = $user->username;
            $_SESSION['user_fullname'] = $user->fullname;
            $_SESSION['user_img'] = $user->profile_img;

            redirect('posts');
        }
        
        public function profile() {
            $data = [
                'username' => $_SESSION['username']
            ];
            
            $this->view('users/profile', $data);
        }

        public function update_user() {
            
            $data = [
                'id' => $_SESSION['user_id'],
            ];
            if($this->userModel->update_username($_POST['new_username'], $data['id']))
            {
                pop_up('updated', 'Profile updated ✓', 'pop alert alert-success w-50 mx-auto text-center');
                $_SESSION['user_username'] = $_POST['new_username'];
                redirect('users/profile');
            }
        }
    }