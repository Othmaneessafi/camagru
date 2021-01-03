<?php

    class User {
        private $db;

        public function __construct()
        {
            $this->db = new Db;
        }


        public function signup($data)
        {   
            $this->db->query('INSERT INTO users (fullname, email, username, password, token) VALUES(:fullname, :email, :username, :password, :token)');
            $this->db->bind(':fullname', $data['fullname']);
            $this->db->bind(':email', $data['email']);
            $this->db->bind(':username', $data['username']);
            $this->db->bind(':password', $data['password']);
            $this->db->bind(':token', $data['token']);
            
            if ($this->db->execute())
                return true;
            else
                return false;
        }

        public function login($username, $password)
        {
            $this->db->query('SELECT * FROM users WHERE username = :username');
            $this->db->bind(':username', $username);
            
            $row = $this->db->singleFetch();
            $hashed_pass = $row->password;
            if (password_verify($password, $hashed_pass))
                return $row;
            else
                return false;
        }

        public function verify($token)
        {
            $this->db->query('SELECT * FROM users WHERE token = :token');
            $this->db->bind(':token', $token);
            
            $row = $this->db->singleFetch();


        if ($this->db->rowCount() > 0)
        {
            $this->db->query('UPDATE users SET verified = 1 WHERE token = :token');
            $this->db->bind(':token', $token);
            if ($this->db->execute())
                return true;
            else
               return false;
        }
        else
            return false;
        }

        public function findUsrByEmail($email){

            $this->db->query('SELECT * FROM users WHERE email = :email');
            $this->db->bind(':email', $email);

            $row = $this->db->singleFetch();

            if ($this->db->rowCount() > 0)
                return true;
            else
                return false;
        }

        public function findUsrByUsername($username){

            $this->db->query('SELECT * FROM users WHERE username = :username');
            $this->db->bind(':username', $username);

            $row = $this->db->singleFetch();

            if ($this->db->rowCount() > 0)
                return true;
            else
                return false;
        }

        public function update_username($new_username, $data){

            $this->db->query('UPDATE users SET username = :username WHERE id = :id');
            $this->db->bind(':username', $new_username);
            $this->db->bind(':id', $data);

            if ($this->db->execute())
                return true;
            else
                return false;
        }

        public function update_fullname($new_fullname, $data){

            $this->db->query('UPDATE users SET fullname = :fullname WHERE id = :id');
            $this->db->bind(':fullname', $new_fullname);
            $this->db->bind(':id', $data);

            if ($this->db->execute())
                return true;
            else
                return false;
        }

        public function update_pass($new_password, $data){

            $this->db->query('UPDATE users SET password = :password WHERE id = :id');
            $this->db->bind(':password', $new_password);
            $this->db->bind(':id', $data);

            if ($this->db->execute())
                return true;
            else
                return false;
        }

        public function update_email($new_email, $data){

            $this->db->query('UPDATE users SET email = :email WHERE id = :id');
            $this->db->bind(':email', $new_email);
            $this->db->bind(':id', $data);

            if ($this->db->execute())
                return true;
            else
                return false;
        }
    }