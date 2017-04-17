<?php
    class AttributeController extends BaseController{
        public function indexAction(){
            $typeModel = new TypeModel('goods_type');
            $types = $typeModel->getTypes();
            $type_id = isset($_GET['type_id'])?$_GET['type_id']:0;
            $attrModel = new AttributeModel('attribute');
            $pagesizeNum = $GLOBALS['config']['pagesize'];
            $current = isset($_GET['page'])?$_GET['page']:1;
            $offset = ($current - 1)*$pagesizeNum;
            $attrs = $attrModel->getPageAttrs($type_id,$offset,$pagesizeNum);
            $this->libLoad('Page');
            if($type_id == 0){
                $where = "";
            }else{
                $where = "type_id={$type_id}";
            };
            $total = $attrModel->total($where);
            $page = new Page($total,$pagesizeNum,$current,'index.php',array('p'=>'admin','c'=>'attribute','a'=>'index','type_id'=>$type_id));
            $pageInfo = $page->showPage();
            require CUR_VIEW_PATH . 'attribute_list.html';
        }
        public function addAction(){
            $typeModel = new TypeModel('goods_type');
            $types = $typeModel->getTypes();
            require CUR_VIEW_PATH . 'attribute_add.html';
        }
        public function insertAction(){
            $data['attr_name'] = trim($_POST['attr_name']);
            $data['attr_type'] = $_POST['attr_type'];
            $data['attr_input_type'] = $_POST['attr_input_type'];
            $data['type_id'] = $_POST['type_id'];
            $data['attr_value'] = isset($_POST['attr_value'])?$_POST['attr_value']:"";
            if($data['attr_name'] === ""){
                $this->jump('index.php?p=admin&c=attribute&a=add','属性名不能为空',2);
            }
            if($data['type_id'] == 0){
                $this->jump('index.php?p=admin&c=attribute&a=add','属性是否可选不能为空',2);
            }
            $this->helperLoad('input');
            $data = deepSpecialChars($data);
            $data = deepSlashes($data);
            $attrModel = new AttributeModel('attribute');
            if($attrModel->insert($data)){
                $this->jump("index.php?p=admin&c=attribute&a=index&type_id={$data['type_id']}",'添加属性成功',2);
            }else{
                $this->jump('index.php?p=admin&c=attribute&a=add','添加属性失败',2);
            }
        }
        public function editAction(){
            require CUR_VIEW_PATH . 'attribute_edit.html';
        }
        public function updateAction(){

        }
        public function deleteAction(){

        }
    }
