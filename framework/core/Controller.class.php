<?php
    //核心控制器
    class Controller{
        public function __construct(){

        }

        public function jump($url,$message,$wait = 3){
            if($wait == 0){
                header("Location:$url");
            }else{
                require CUR_VIEW_PATH . 'message.html';
            }
            exit;
        }
        public function libLoad($lib){
            require LIB_PATH."{$lib}.class.php";
        }
        public function helperLoad($helper){
            require HELPER_PATH."{$helper}.class.php";
        }
    }
