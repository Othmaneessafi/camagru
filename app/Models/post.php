<?php

    class Post {

        private $db;

        public function __construct()
        {
            $this->db = new Db;
        }

        public function getPosts()
        {
            $this->db->query('SELECT *, posts.id as postId, users.id as userId FROM posts INNER JOIN users ON posts.user_id = users.id ORDER BY posts.create_at DESC');
            $res = $this->db->resultSet();

            return $res;
        }
    }