<?php
    class IndexController extends Controller{
        public function indexAction(){
            //echo '后台首页';
            require CUR_VIEW_PATH.'index.html';
        }
        public function topAction(){
            require CUR_VIEW_PATH.'top.html';
        }
        public function menuAction(){
            require CUR_VIEW_PATH.'menu.html';
        }
        public function dragAction(){
            require CUR_VIEW_PATH.'drag.html';
        }
        public function mainAction(){
            require CUR_VIEW_PATH.'main.html';
        }
        public function codeAction(){
            $this->libLoad('Captcha');
            $captcha = new Captcha();
            $captcha->generateCode();
        }
    }