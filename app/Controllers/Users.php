<?php

    class Users extends Controller{

        public function __construct()
        {
            $this->userModel = $this->model('User');
            $this->postModel = $this->model('Post');

        }

        public function signup() {
            if ($_SERVER['REQUEST_METHOD'] == 'POST')
            {
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $token = openssl_random_pseudo_bytes(16);
                $token = bin2hex($token);
                $data = [
                    'fullname' => trim($_POST['fullname']),
                    'email' => trim($_POST['email']),
                    'username' => trim($_POST['username']),
                    'password' => trim($_POST['password']),
                    'confirm_pwd' => trim($_POST['confirmPwd']),
                    'token' => $token,
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
                else if (strlen($data['password']) < 6)
                    $data['err_password'] = 'Password must be at least 6 characters';
                else if (!preg_match('@[A-Z]@', $data['password']))
                    $data['err_password'] = 'Password must contain an upper case';
                else if (!preg_match('@[a-z]@', $data['password']))
                    $data['err_password'] = 'Password must contain a  lower case';
                else if (!preg_match('@[0-9]@', $data['password']))
                    $data['err_password'] = 'Password must contain a number';
                if ($data['password'] != $data['confirm_pwd'])
                    $data['err_confirmPwd'] = 'Passwords do not match !!';

                if (empty($data['err_fullname']) && empty($data['err_email']) && empty($data['err_username']) &&
                    empty($data['err_password']) && empty($data['err_confirmPwd']))
                {
                    $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                    if ($this->userModel->signup($data))
                    {
                        $to_email = $data['email'];
                        $subject = "Verify you email";
                        $token = $data['token'];
                        $body = '<p><h1>Welcome to Camagru</h1>,
                            <br /><br />
                            <br/>
                            To verify your account click here 
                            <a href="'.URL_ROOT.'/users/verification/?token='.$token.'">click here.</a>
                            </p>
                            <p>
                                <br />--------------------------------------------------------
                                <br />This is an automatic mail , please do not reply.
                            </p>';
                        $headers = "Content-type:text/html;charset=UTF-8" . "\r\n";
                        $headers .= 'From: <oes-safi@Camagru.ma>' . "\r\n";    
                        if (mail($to_email, $subject, $body, $headers))
                                pop_up('signup_ok', 'You are now part of our community, Verify your email to login');
                            else
                                pop_up('signup_ok', 'Can not send email verificaton, please retry');
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
                    'token' => '',
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
                        if($loggedUser->verified)
                            $this->createUserSession($loggedUser);
                        else
                        {
                            pop_up('not_verified', 'Please verify you email !!', 'alert alert-danger');
                            redirect('users/login');
                        }
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
            unset($_SESSION['user_id']);
            unset($_SESSION['user_email']);
            unset($_SESSION['user_username']);
            unset($_SESSION['user_fullname']);

            session_destroy();
            redirect('users/login');
        }

        public function forgot()
        {
            $this->view('users/forgot');
        }

        public function reset()
        {
            if ($_SERVER['REQUEST_METHOD'] == 'POST')
            {
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $data = [
                    'forgotEmail' => trim($_POST['forgotEmail']),
                    'err_forgotEmail' => ''
                ];

                if (empty($data['forgotEmail']))
                    $data['err_forgotEmail'] = 'please enter email !!';
                else if(!$this->userModel->findUsrByEmail($data['forgotEmail']))
                    $data['err_forgotEmail'] = 'Email doest not exist !!';
                
                if (empty($data['err_forgotEmail']))
                {
                        $to_email = $data['forgotEmail'];
                        $subject = "Reset password";
                        $user = $this->userModel->getUserToken($data['forgotEmail']);
                        $body = '<p><h1>Reset Password</h1>,
                            <br /><br />
                            <br/>
                            To reset your password click here 
                            <a href="'.URL_ROOT.'/users/newpassword/?token='.$user->token.'&id='.$user->id.'">click here.</a>
                            </p>
                            <p>
                                <br />--------------------------------------------------------
                                <br />This is an automatic mail , please do not reply.
                            </p>';
                        $headers = "Content-type:text/html;charset=UTF-8" . "\r\n";
                        $headers .= 'From: <oes-safi@Camagru.ma>' . "\r\n";    
                        if (mail($to_email, $subject, $body, $headers))
                            pop_up('signup_ok', 'Reset password verification sent to your email');
                        else
                            pop_up('signup_ok', 'Can not send email verificaton, please retry', 'alert alert-danger');
                }
                $this->view('users/forgot', $data); 
            }
        }

        public function createUserSession($user)
        {
            $_SESSION['user_id'] = $user->id;
            $_SESSION['user_email'] = $user->email;
            $_SESSION['user_username'] = $user->username;
            $_SESSION['user_fullname'] = $user->fullname;
            $_SESSION['user_img'] = $user->profile_img;
            $_SESSION['notification'] = $user->notification;

            redirect('posts');
        }

        public function verification()
        {
            if (isset($_GET['token']))
            {
                $token = $_GET['token'];
                
                if ($this->userModel->verify($token))
                {
                    pop_up('signup_ok', 'Your account is verified succesfully');
                    redirect('users/login');
                }
                else
                {
                    pop_up('signup_ok', 'Failed to verify your accout', 'alert alert-danger text-center');
                    redirect('users/login');
                }
            }
            else
                die('error');
        }

        public function newpassword()
        {
            if (isset($_GET['token']) && isset($_GET['id']))
            {
                $data =[
                    'token' => $_GET['token'],
                    'id' => $_GET['id']
                ];
                
                if ($this->userModel->verify($data['token']))
                {
                    $this->view('users/reset', $data);
                }
            }
            else
                die('error');
        }
        
        public function updatepass($id)
        {
            if ($_SERVER['REQUEST_METHOD'] == 'POST')
            {
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $data = [
                    'newPassword' => trim($_POST['newPassword']),
                    'id' => $id,
                    'err_newPassword' => ''
                ];

                if (empty($data['newPassword']))
                    $data['err_newPassword'] = 'please enter password !!';
                
                if (empty($data['err_newPassword']))
                {
                    $data['newPassword'] = password_hash($data['newPassword'], PASSWORD_DEFAULT);
                    if($this->userModel->update_pass($data['newPassword'], $data['id']))
                    {
                        pop_up('signup_ok', 'Password updated');
                        redirect('users/login');
                    }
                }
                $this->view('users/reset', $data); 
            }
        }
        
        public function profile() {
            $post = $this->postModel->getPosts();
            $data = [
                'username' => $_SESSION['username'],
                'posts' =>$post
            ];
            
            $this->view('users/profile', $data);
        }

        public function update_user() {
            
            $data = [
                'id' => $_SESSION['user_id'],
            ];
            if(!empty($_POST['new_username']))
            {
                if($this->userModel->update_username($_POST['new_username'], $data['id']))
                {
                    pop_up('updated', 'Username updated ✓', 'pop alert alert-success w-50 mx-auto text-center');
                    $_SESSION['user_username'] = $_POST['new_username'];
                    redirect('users/profile');
                }
            }
            else
                redirect('users/profile');

            if(!empty($_POST['new_fullname']))
            {
                if($this->userModel->update_fullname($_POST['new_fullname'], $data['id']))
                {
                    pop_up('updated', 'Fullname updated ✓', 'pop alert alert-success w-50 mx-auto text-center');
                    $_SESSION['user_fullname'] = $_POST['new_fullname'];
                    redirect('users/profile');
                }
            }
            else
                redirect('users/profile');
            
            if(!empty($_POST['new_email']))
            {
                if($this->userModel->update_email($_POST['new_email'], $data['id']))
                {
                    pop_up('updated', 'You need to verify the new email ✓', 'pop alert alert-success w-50 mx-auto text-center');
                    $_SESSION['user_fullname'] = $_POST['new_fullname'];
                    redirect('users/profile');
                }
            }
            else
                redirect('users/profile');
            
            if(!empty($_POST['new_password']))
            {
                if ((strlen($_POST['new_password']) < 6) || (!preg_match('@[A-Z]@', $_POST['new_password'])) || (!preg_match('@[a-z]@', $_POST['new_password'])) || (!preg_match('@[0-9]@', $_POST['new_password'])))
                {
                    pop_up('updated', 'Password not valid ✓', 'pop alert alert-danger w-50 mx-auto text-center');
                    redirect('users/profile');
                }
                else
                {
                    $_POST['new_password'] = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
                    if($this->userModel->update_pass($_POST['new_password'], $data['id']))
                    {
                        pop_up('updated', 'Password updated ✓', 'pop alert alert-success w-50 mx-auto text-center');
                        redirect('users/profile');
                    }
                }
            }
            else
                redirect('users/profile');

            if(!empty($_POST['notifs']))
            {
                if($this->userModel->update_notifs($data['id'], 1))
                {
                    pop_up('updated', 'notification updated ✓', 'pop alert alert-success w-50 mx-auto text-center');
                    $_SESSION['notification'] = 1;
                    redirect('users/profile');;
                }
            }
            else
            {
                if($this->userModel->update_notifs($data['id'], 0))
                {
                    pop_up('updated', 'Notification updated ✓', 'pop alert alert-success w-50 mx-auto text-center');
                    $_SESSION['notification'] = 0;
                    redirect('users/profile');;
                }
            }

        }
    }
