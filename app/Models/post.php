<?php

    class Post {

        private $db;

        public function __construct()
        {
            $this->db = new Db;
        }

        public function getPosts()
        {
            $this->db->query('SELECT * FROM posts');
            $res = $this->db->resultSet();

            return $res;
        }
    }