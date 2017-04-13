<?php
    class CategoryModel extends Model{
        public function getCats(){
            $sql = "SELECT * FROM {$this->table}";
            $res = $this->tree($this->db->getAll($sql));
            return $res;
        }
        public function tree($arr,$pid = 0,$level = 0){
            static $res = array();
            foreach ($arr as $v){
                if($v['parent_id']==$pid){
                    $v['level'] = $level;
                    $res[]=$v;
                    $this->tree($arr,$v['cat_id'],$level+1);
                }
            }
            return $res;
        }
        public function getSubIds($cat_id){
            $sql = "SELECT * FROM {$this->table}";
            $cats = $this->db->getAll($sql);
            $cats = $this->tree($cats,$cat_id);
            $res = array();
            foreach ($cats as $cat) {
                $res[] = $cat['cat_id'];
            }
            $res[] = $cat_id;
            return $res;
        }
    }
