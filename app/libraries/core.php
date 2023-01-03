<?php
    /* created 03/01/2022


    App Core Class
    Creates URL & loads core controller
    URL FORMAT - /controler/method/params
    */

    class Core {
        protected $currentController = 'pages';
        protected $currentMethod = 'index';
        protected $param = [];
        
        public function __construct(){
            $this->getURL();

        }

        public function getURL(){
           echo $_GET['url'];
        }
    }

