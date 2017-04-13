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
    }
