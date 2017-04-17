<?php
    class BrandController extends BaseController {
        public function indexAction(){
            require CUR_VIEW_PATH . 'brand_list.html';
        }
        public function addAction(){
            require CUR_VIEW_PATH . 'brand_add.html';
        }
        public function editAction(){
            require CUR_VIEW_PATH . 'brand_edit.html';
        }
        public function insertAction(){

        }
        public function updateAction(){

        }
        public function deleteAction(){

        }
    }