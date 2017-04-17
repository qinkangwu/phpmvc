<?php
    class CategoryController extends BaseController{
        public function indexAction(){
            $category = new CategoryModel('category');
            $cats = $category->getCats();
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
            $this->helperLoad('input');
            $data['cat_desc'] = deepSpecialChars($_POST['cat_desc']);
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
            $cat_id = $_GET['cat_id']+0;
            $category = new CategoryModel('category');
            $cats = $category->getCats();
            $cat = $category->selectByPk($cat_id);
            require CUR_VIEW_PATH . 'cat_edit.html';
        }
        public function updateAction(){
            $data['cat_name'] = trim($_POST['cat_name']);
            $data['parent_id'] = $_POST['parent_id'];
            $data['unit'] = $_POST['unit'];
            $data['sort_order'] = $_POST['sort_order'];
            $data['is_show'] = $_POST['is_show'];
            $data['cat_desc'] = $_POST['cat_desc'];
            $data['cat_id'] = $_POST['cat_id'];
            if($data['cat_name']===''){
                $this->jump('index.php?p=admin&c=category&a=add','分类名称不能为空',3);
            }
            $category = new CategoryModel('category');
            $ids = $category->getSubIds($data['cat_id']);
            if(in_array($data['parent_id'],$ids)){
                $this->jump("index.php?p=admin&c=category&a=edit&cat_id={$data['cat_id']}",'修改分类失败',2);
                exit;
            }
            if($category->update($data)){
                $this->jump('index.php?p=admin&c=category&a=index','修改分类成功',2);
            }else{
                $this->jump("index.php?p=admin&c=category&a=edit&cat_id={$data['cat_id']}",'修改分类失败',2);
            }

        }
        public function deleteAction(){
            $cat_id = $_GET['cat_id'];
            $category = new CategoryModel('category');
            $ids = $category->getSubIds($cat_id);
            if(count($ids)>1){
                $this->jump("index.php?p=admin&c=category&a=index",'删除分类失败,该分类有后代分类，不能直接删除',2);
                exit;
            }
            if($category->delete($cat_id)){
                $this->jump('index.php?p=admin&c=category&a=index','删除分类成功',2);
            }else{
                $this->jump("index.php?p=admin&c=category&a=index",'删除分类失败',2);
            }
        }

    }
