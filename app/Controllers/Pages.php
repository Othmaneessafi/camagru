<?php
    class Pages extends Controller {
        public function __construct()
        {
            $this->postModel = $this->model('Post');
            
        }

        public function index()
        {
            $post = $this->postModel->getPosts();
            $comments = $this->postModel->getcomments();
            $data = [
                'posts' =>$post,
                'comments'=> $comments
            ];
            $this->view('pages/index', $data);
        }


        public function about()
        {
            $data = ['title' => 'about'];
            $this->view('pages/index', $data);
        }
    }