<?php
    /* created 03/01/2022


    App Core Class
    Creates URL & loads core controller
    URL FORMAT - /controler/method/params
    */

    class Core {
        protected $currentController = 'Pages';
        protected $currentMethod = 'index';
        protected $param = [];
        
        public function __construct(){
            //print_r($this->getURL());
            $url = $this->getUrl();
            if(!empty($this->getURL())){
                // look in controllers for first value
                if(file_exists('../app/controller/'.ucwords($url[0]).'.php')){
                    // if exists, set as current controller
                    $this->currentController = ucwords($url[0]);
                    // unset [0] index
                    unset($url[0]);
                }
            }
            // require the controller
            require_once '../app/controller/'.$this->currentController.'.php';
            // instanciente controller class
            $this->currentController = new $this->currentController;
            // check for second part of URL 
            if(isset($url[1])){
                 
                if(method_exists($this->currentController, $url[1])){
                    $this->currentMethod = $url[1];

                    //unset $url[1]
                    unset($url[1]);
                    
                }
                //get Params if has some if not still empty
                $this->param = $url ? array_values($url) : [];

                //call a callback with array of params
                call_user_func_array([$this->currentController,$this->currentMethod], $this->param);

            }

        }
        // function to get URL,Filter and add to array each word 
        public function getURL(){
           if(isset($_GET['url'])){ 
                $url = rtrim($_GET['url'], '/'); // split url and '/'
                $url = filter_var($url,FILTER_SANITIZE_URL); //clear url of any diferent character
                $url = explode('/', $url);
                return $url;
           }
        }
    }

