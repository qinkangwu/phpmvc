<?php
    class LoginController extends Controller {
        public function indexAction(){
            require CUR_VIEW_PATH . 'login.html';
        }
        public function signinAction(){
            $username = trim($_POST['username']);
            $password = trim($_POST['password']);
            $username = addslashes($username);
            $code = trim($_POST['captcha']);
            if(strtolower($code) !== $_SESSION['captcha']){
                $this->jump('index.php?p=admin&c=login&a=index','验证码错误',2);
                exit;
            }
            if($username === '' || $password === ''){
                $this->jump('index.php?p=admin&c=login&a=index','用户名密码不能为空',2);
                exit;
            }
            $adminModel = new AdminModel('Admin');
            $user = $adminModel->checkUser($username,$password);
            if(!empty($user)){
                //登录成功
                $_SESSION['admin'] = $user;
                $this->jump('index.php?p=admin&c=index&a=index','',0);
            }else{
                //登录失败
                $this->jump('index.php?p=admin&c=login&a=index','用户名或密码错误',2);
                exit;
            }
        }
        public function logoutAction(){
            unset($_SESSION['admin']);
            session_destroy();
            $this->jump('index.php?p=admin&c=login&a=index','退出登录成功',2);
        }

        public function codeAction(){
            $this->libLoad('Captcha');
            $captcha = new Captcha();
            $captcha->generateCode();
            $_SESSION['captcha'] = $captcha->getCode();
        }
    }
