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

        public function saveImage(){
		if(isset($_POST['imgBase64']) && isset($_POST['emoticon']))
        {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $upload_dir = "../public/img/";
            $img = $_POST['imgBase64'];
            $emo = $_POST['emoticon'];
            $img = str_replace('data:image/png;base64,', '', $img);
            $img = str_replace(' ', '+', $img);
            $d = base64_decode($img);
            $file = $upload_dir.mktime().'.png';
            file_put_contents($file, $d);

            list($srcWidth, $srcHeight) = getimagesize($emo);
            $src = imagecreatefrompng($emo);
            $dest = imagecreatefrompng($file);
            imagecopy($dest, $src, 11,11, 0, 0, $srcWidth, $srcHeight);
            imagepng($dest, $file, 9);
            move_uploaded_file($dest, $file);

            $data =[
                'user_id'  => $_SESSION['user_id'],
                'path' => $file,
            ];
            if($this->postModel->save($data)){
                
            }else
                return false;	  
                }
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