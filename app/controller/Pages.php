<?php
    class Pages extends Controller{
        private $postModel;

        public function __construct(){
          
        }
            
        public function index(){
            $this->view('pages/index');
        }

        public function about(){
            $this->view('pages/about');

        }
    }