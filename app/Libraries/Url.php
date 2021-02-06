<?php

    class Url {
        protected $curControl = 'Pages';
        protected $curMethod = 'index';
        protected $params = [];

        public function __construct()
        {
            $url = $this->getUrl();
            if($url)
            {
                if (file_exists('../app/Controllers/' . ucwords($url[0]). '.php'))
                {
                    $this->curControl = ucwords($url[0]);
                    unset($url[0]);
                }
            }

            require_once '../app/Controllers/'. $this->curControl. '.php';
            $this->curControl = new $this->curControl;

            if (isset($url[1]))
            {
                if (method_exists($this->curControl, $url[1]))
                {
                    $this->curMethod = $url[1];
                    unset($url[1]);
                }
                else
                    die("<h1>page not found !!!<h1>");
            }

            $this->params = $url ? array_values($url) : [];

            call_user_func_array([$this->curControl, $this->curMethod], $this->params);
        }
        
        public function getUrl() {
            if (isset($_GET['url']))
            {
                $url = rtrim($_GET['url'], '/');
                $url = filter_var($url, FILTER_SANITIZE_URL);
                $url = explode('/', $url);
                return $url;
            }
        }
    }