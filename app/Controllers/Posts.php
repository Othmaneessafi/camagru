<?php

    class Posts extends Controller {

        public function __construct()
        {
            if (!isLogged())
                redirect('users/login');

            $this->postModel = $this->model('Post');
        }

        public function index()
        {
            $post = $this->postModel->getPosts();
            $likes = $this->postModel->getlikes();
            $comments = $this->postModel->getcomments();
            $data = [
                'posts' =>$post,
                'likes' => $likes,
                'comments'=> $comments
            ];
            $this->view('posts/index', $data);
        }

        public function add()
        {
            $data = [
                'title' =>'',
                'content' => ''
            ];
            $this->view('posts/add', $data);
        }

        public function edit_post($id)
        {
            die($id);
        }

        public function del_post($post_id)
        {
            if($this->postModel->del($post_id))
                redirect('users/profile');
            else
                die("error");
        }

        public function like(){
            
            
            if(isset($_POST['post_id']) && isset($_POST['user_id']) && isset($_POST['c']) && isset($_POST['like_nbr']) && isLogged())
            {
                $data = [
                    'post_id'=> $_POST['post_id'],
                    'user_id' => $_POST['user_id'],
                    'c' => $_POST['c'],
                    'like_nbr' => $_POST['like_nbr']
                ];
                print_r($data);
                 $this->postModel->like_nbr($data);
                if($data['c'] == 'fa fa-heart')
                {
                  
                  if($this->postModel->deleteLike($data))
                  {
    
                  }
                  else
                  {
                    die('error');
                  }
                }
                else if($data['c'] == 'fa fa-heart-o')
                {
                  
                  if($this->postModel->addLike($data))
                  {
                  }
                  else
                  {
                    die('error');
                  }
                }
                   
             }
        }

        public function comment(){
            if(isset($_POST['c_post_id']) && isset($_POST['c_user_id']) && isset($_POST['content']) && strlen($_POST['content']) <= 255 && isLogged())
            {
                $data = [
                    'post_id'=> $_POST['c_post_id'],
                    'user_id' => $_POST['c_user_id'],
                    'content' => $_POST['content'],
                ];
                print_r($data);
                // $com = $this->userModel->get_commenter($data['user_id']);
                // $uid = $this->postModel->getUserByPostId($data['post_id']);
                // $d = $this->userModel->get_dest($uid->user_id);
                if($this->postModel->addComment($data))
                {

                }
            }
        }
    }