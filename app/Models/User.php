<?php

    class User {
        private $db;

        public function __construct()
        {
            $this->db = new Db;
        }


        public function signup($data)
        {
            $this->db->query('INSERT INTO users (fullname, email, username, password) VALUES(:fullname, :email, :username, :password)');
            $this->db->bind(':fullname', $data['fullname']);
            $this->db->bind(':email', $data['email']);
            $this->db->bind(':username', $data['username']);
            $this->db->bind(':password', $data['password']);
            
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
    }