<?php
    /*
     * Base controler
     * loads the models and Views
     */
    
    class Controller {
        // load model
        public function model($model){
            //require model file
            require_once  '../app/models/' .$model. '.php';
            //intantiate model
            return new $model(); 
        }
        // load view 
        public function view ($view, $data = []){
        // check if the view exists
            if(file_exists('../app/views/'.$view.'.php')){
                require_once '../app/views/'.$view.'.php';

            }else{
                die('view does not exist.');
            }

        }
    }


