<?php

    class Controller {

        public function model($model)
        {
            require_once '../app/Models/' .$model. '.php';
            
            return new $model();
        }
        
        public function view($view, $data = [])
        {
            if (file_exists('../app/Views/' .$view. '.php'))
                require_once '../app/Views/' .$view. '.php';
            else
                die('View not found !!');
        }


    }