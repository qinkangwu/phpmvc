<?php
    class TypeController extends BaseController{
        public function indexAction(){
            $typeModel = new TypeModel('goods_type');
            //$types = $typeModel->getTypes();
            $pagesizeNum = $GLOBALS['config']['pagesize'];
            $current = isset($_GET['page'])?$_GET['page']:1;
            $offset = ($current - 1)*$pagesizeNum;
            $types = $typeModel->getPageTypes($offset,$pagesizeNum);
            $this->libLoad('Page');
            $where = "";
            $total = $typeModel->total($where);
            $page = new Page($total,$pagesizeNum,$current,'index.php',array('p'=>'admin','c'=>'type','a'=>'index'));
            $pageInfo = $page->showPage();
            require CUR_VIEW_PATH.'goods_type_list.html';
        }
        public function addAction(){
            require CUR_VIEW_PATH.'goods_type_add.html';
        }
        public function insertAction(){
            $data['type_name'] = trim($_POST['type_name']);
            if($data['type_name'] == ''){
                $this->jump('index.php?p=admin&c=type&a=add','名称不能为空',2);
                exit;
            }
            $this->helperLoad('input');
            $data = deepSpecialChars($data);
            $data = deepSlashes($data);
            $typeModel = new TypeModel('goods_type');
            $res = $typeModel->insert($data);
            if($res){
                $this->jump('index.php?p=admin&c=type&a=index','插入成功',2);
            }else{
                $this->jump('index.php?p=admin&c=type&a=add','插入失败',0);
            }

        }
        public function updateAction(){

        }
        public function deleteAction(){

        }
        public function editAction(){
            require CUR_VIEW_PATH.'goods_type_edit.html';
        }
    }
