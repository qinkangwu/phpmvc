<?php
    //核心启动类
    class Framework{
        //run
        public static function run(){
            header('content-type:text/html;charset=utf-8');
            self::init();
            self::autoload();
            self::dispatcher();
        }
        //初始化
        private static function init(){
            //定义工作目录
            define("DS",DIRECTORY_SEPARATOR);
            define("ROOT",getcwd() . DS);
            define("APP_PATH",ROOT.'application'.DS);
            define("FRAMEWORK_PATH",ROOT.'framework'.DS);
            define("PUBLIC_PATH",ROOT.'public'.DS);
            define("CONFIG_PATH",APP_PATH.'config'.DS);
            define("CONTROLLER_PATH",APP_PATH.'controllers'.DS);
            define("MODEL_PATH",APP_PATH.'models'.DS);
            define("VIEW_PATH",APP_PATH.'views'.DS);
            define("CORE_PATH",FRAMEWORK_PATH.'core'.DS);
            define("DATABASE_PATH",FRAMEWORK_PATH.'database'.DS);
            define("HELPER_PATH",FRAMEWORK_PATH.'helpers'.DS);
            define("LIB_PATH",FRAMEWORK_PATH.'lib'.DS);
            define("UPLOAD_PATH",PUBLIC_PATH.'upload'.DS);
            define("PLATFORM",isset($_GET['p'])?$_GET['p']:"admin");
            define("CONTROLLER",isset($_GET['c'])?ucfirst($_GET['c']):"Index");
            define("ACTION",isset($_GET['a'])?$_GET['a']:"index");
            define("CUR_CONTROLLER_PATH",CONTROLLER_PATH.PLATFORM.DS);
            define("CUR_VIEW_PATH",VIEW_PATH.PLATFORM.DS);
            require CORE_PATH.'Controller.class.php';
            require CORE_PATH.'Model.class.php';
            require DATABASE_PATH.'Mysql.class.php';
            $GLOBALS["config"] = require CONFIG_PATH.'config.php';
        }

        //路由分发
        private static function dispatcher(){
            $controller_name = CONTROLLER.'Controller';
            $action_name = ACTION.'Action';
            $controller = new $controller_name();
            $controller->$action_name();
        }
        //自动载入
        private static function autoload(){
            spl_autoload_register('self::load');
        }
        public static function load($className){
            //echo $className.'<br>';
            if(substr($className,-10)=='Controller'){
                require CUR_CONTROLLER_PATH."{$className}.class.php";
            }else if(substr($className,-5)=='Model'){
                require MODEL_PATH."{$className}.class.php";
            }
        }
    }

