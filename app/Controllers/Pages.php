<?php
    class Pages extends Controller {
        public function __construct()
        {
            $this->postModel = $this->model('Post');
            
        }

        public function index()
        {
            $postsPerPage = 5;
            $totalPosts = $this->postModel->count_posts();
            $totalPages = ceil($totalPosts/$postsPerPage);

            if(isset($_GET['page']) AND !empty($_GET['page']) AND $_GET['page'] > 0 AND $_GET['page'] <= $totalPages){

            $_GET['page'] = intval($_GET['page']);
            $currentPage = $_GET['page'];    
            }else
            $currentPage = 1;

            $depart = ($currentPage - 1) * $postsPerPage;
            $post = $this->postModel->getPostsPage($depart, $postsPerPage);
            $comments = $this->postModel->getcomments();
            $data = [
                'posts' =>$post,
                'comments'=> $comments,
                'totalPages' => $totalPages,
                'currentPage' => $currentPage,
                'depart' => $depart
            ];
            $this->view('pages/index', $data);
        }


        public function about()
        {
            $data = ['title' => 'about'];
            $this->view('pages/index', $data);
        }
    }