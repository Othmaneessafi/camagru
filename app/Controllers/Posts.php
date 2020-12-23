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
            $data = [
                'posts' =>$post
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
    }