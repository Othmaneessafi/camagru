<?php

    class Users extends Controller{

        public function __construct()
        {
            
        }

        public function signup() {
            if ($_SERVER['REQUEST_METHOD'] == 'POST')
            {

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
    }