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

        public function getPostsPage($depart, $postsPerPage)
        {
            $this->db->query("SELECT *, posts.id as postId, users.id as userId FROM posts INNER JOIN users ON posts.user_id = users.id ORDER BY posts.create_at DESC LIMIT $depart,$postsPerPage");
            $res = $this->db->resultSet();

            return $res;
        }

        public function save($data){
            $this->db->query('INSERT INTO posts (user_id, content) VALUES(:user_id, :path)');
    
            $this->db->bind(':user_id', $data['user_id']);
            $this->db->bind(':path', $data['path']);
    
            if($this->db->execute()){
                return true;
            }else {
                return false;
            }
        }

        public function count_posts(){
            $this->db->query('SELECT count(*) FROM posts');
    
            $c = $this->db->ftchColumn();
            if($c)
                return $c;
            else
                return false;
        }
        
        public function del($id)
        {
            $this->db->query('DELETE FROM posts WHERE id = :id');
            $this->db->bind(':id', $id);

            if ($this->db->execute())
                return true;
            else
                return false;
        }

        public function getlikes(){
            $this->db->query('SELECT * FROM likes');
            $result = $this->db->resultSet();
            return ($result);
        }
    
       public function addLike($data)
        {
            $this->db->query('INSERT INTO likes (user_id, post_id) VALUES (:user_id, :post_id)');
            $this->db->bind(':user_id',$data['user_id']);
            $this->db->bind(':post_id',$data['post_id']);
    
            if($this->db->execute())
            {
                return true;
            }else
                return false;
        }
        public function deleteLike($data)
        {
            $this->db->query('DELETE FROM likes WHERE user_id = :user_id AND post_id = :post_id');
            $this->db->bind(':user_id',$data['user_id']);
            $this->db->bind(':post_id',$data['post_id']);
    
            if($this->db->execute())
            {
                return true;
            }else
                return false;
        }
    
        public function like_nbr($data)
        {
            $this->db->query('UPDATE posts SET like_nbr = :like_nbr WHERE id = :post_id');
        
            $this->db->bind(':like_nbr', $data['like_nbr']);
            $this->db->bind(':post_id', $data['post_id']);
        
            if($this->db->execute()){
            return true;
            }else {
            return false;
            }
        }

        public function getcomments()
        {
            $this->db->query('SELECT *,
                            comments.id as commentId,
                            users.id as userId
                            FROM `comments`
                            INNER JOIN users
                            ON comments.user_id = users.id');

            $result = $this->db->resultSet();
            if($result)
            return ($result);
            else
            return false;
        }

        public function addComment($data)
        {
            $this->db->query('INSERT INTO comments (user_id, post_id, content) VALUES (:user_id, :post_id, :content)');
                $this->db->bind(':user_id',$data['user_id']);
                $this->db->bind(':post_id',$data['post_id']);
                $this->db->bind(':content',$data['content']);

                if($this->db->execute())
                {
                    return true;
                }else
                    return false;
        }

        public function getPostById($postId){
            $this->db->query('SELECT * FROM posts WHERE id = :postid');
            $this->db->bind(':postid',$postId);
        
            $result = $this->db->singleFetch();
            if($result)
              return ($result);
            else
              return false;
        }

        public function del_comments($post_id)
        {
            $this->db->query('DELETE FROM comments WHERE post_id = :id');
            $this->db->bind(':id', $post_id);

            if ($this->db->execute())
                return true;
            else
                return false;
        }

        public function del_likes($post_id)
        {
            $this->db->query('DELETE FROM likes WHERE post_id = :id');
            $this->db->bind(':id', $post_id);

            if ($this->db->execute())
                return true;
            else
                return false;
        }

    }