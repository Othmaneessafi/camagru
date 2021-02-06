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

        public function verify($token, $type)
        {
            $this->db->query('SELECT * FROM users WHERE token = :token');
            $this->db->bind(':token', $token);
            
            $row = $this->db->singleFetch();

        if ($this->db->rowCount() > 0)
        {
            if ($type == 1)
            {
                $this->db->query('UPDATE users SET verified = 1 WHERE token = :token');
                $this->db->bind(':token', $token);
                if ($this->db->execute())
                    return true;
                else
                    return false;
            }
            else
                return true;
        }
        else
            return false;
        }

        public function findUsrByEmail($email){

            $this->db->query('SELECT * FROM users WHERE email = :email');
            $this->db->bind(':email', $email);

            if ($this->db->rowCount() > 0)
                return true;
            else
                return false;
        }

        public function findUsrByUsername($username){

            $this->db->query('SELECT * FROM users WHERE username = :username');
            $this->db->bind(':username', $username);

            if ($this->db->rowCount() > 0)
                return true;
            else
                return false;
        }

        public function getUserToken($email){

            $this->db->query('SELECT * FROM users WHERE email = :email');
            $this->db->bind(':email', $email);

            $row = $this->db->singleFetch();

            if ($this->db->rowCount() > 0)
                return $row;
            else
                return false;
        }

        public function update_username($new_username, $id){

            $this->db->query('UPDATE users SET username = :username WHERE id = :id');
            $this->db->bind(':username', $new_username);
            $this->db->bind(':id', $id);

            if ($this->db->execute())
                return true;
            else
                return false;
        }

        public function update_fullname($new_fullname, $id){

            $this->db->query('UPDATE users SET fullname = :fullname WHERE id = :id');
            $this->db->bind(':fullname', $new_fullname);
            $this->db->bind(':id', $id);

            if ($this->db->execute())
                return true;
            else
                return false;
        }

        public function update_pass($new_password, $id){

            $this->db->query('UPDATE users SET password = :password WHERE id = :id');
            $this->db->bind(':password', $new_password);
            $this->db->bind(':id', $id);

            if ($this->db->execute())
                return true;
            else
                return false;
        }

        public function update_email($new_email, $id){

            $this->db->query('UPDATE users SET email = :email WHERE id = :id');
            $this->db->bind(':email', $new_email);
            $this->db->bind(':id', $id);

            if ($this->db->execute())
                return true;
            else
                return false;
        }

        public function update_notifs($id, $status){
            if ($status == 1)
                $this->db->query('UPDATE users SET notification = 1 WHERE id = :id');
            else
                $this->db->query('UPDATE users SET notification = 0 WHERE id = :id');
            $this->db->bind(':id', $id);

            if ($this->db->execute())
                return true;
            else
                return false;
        }

        public function gets_user($user_id)
        {   
            $this->db->query('SELECT * FROM users WHERE id = :id');
            $this->db->bind(':id',$user_id);
            $result = $this->db->singleFetch();
            if($result)
                return ($result);
            else
                return false;
        }

        public function setPhoto($post_img, $user_id)
        {   
            $this->db->query('SELECT * FROM posts WHERE content = :img AND user_id = :id');
            $this->db->bind(':img',$post_img);
            $this->db->bind(':id',$user_id);
  
            if ($this->db->rowCount() > 0)
            {
                $this->db->query('UPDATE users SET profile_img = :img WHERE id = :id');
                $this->db->bind(':img',$post_img);
                $this->db->bind(':id',$user_id);
                if ($this->db->execute())
                    return true;
                else
                    return false;
            }
        } 
    }