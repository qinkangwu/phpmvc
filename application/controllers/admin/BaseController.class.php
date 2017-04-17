<?php
    class BaseController extends Controller {
        public function __construct(){
            parent::__construct();
            $this->checkLogin();
        }

        public function checkLogin(){
            if(!isset($_SESSION['admin'])){
                $this->jump('index.php?p=admin&c=login&a=index','未登录，请先登录',2);
            }
        }
    }
