<?php
    class CategoryController extends Controller{
        public function indexAction(){
            require CUR_VIEW_PATH . 'cat_list.html';
        }
        public function addAction(){
            $category = new CategoryModel('category');
            $cats = $category->getCats();
            require CUR_VIEW_PATH . 'cat_add.html';
        }
        public function insertAction(){
            $data['cat_name'] = trim($_POST['cat_name']);
            $data['parent_id'] = $_POST['parent_id'];
            $data['unit'] = $_POST['unit'];
            $data['sort_order'] = $_POST['sort_order'];
            $data['is_show'] = $_POST['is_show'];
            $data['cat_desc'] = $_POST['cat_desc'];
            if($data['cat_name']===''){
                $this->jump('index.php?p=admin&c=category&a=add','分类名称不能为空',3);
            }
            $category = new CategoryModel('category');
            if($category->insert($data)){
                $this->jump('index.php?p=admin&c=category&a=index','添加分类成功',2);
            }else{
                $this->jump('index.php?p=admin&c=category&a=index','添加分类失败',2);
            }
        }
        public function editAction(){
            require CUR_VIEW_PATH . 'cat_edit.html';
        }
        public function updateAction(){

        }
        public function deleteAction(){

        }

    }
