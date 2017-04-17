<?php
    class TypeModel extends Model{
        public function getTypes(){
            $sql = "select * from {$this->table}";
            return $this->db->getAll($sql);
        }
        public function getPageTypes($offset,$pagesize){
            $sql = "select * from {$this->table} order by type_id desc limit {$offset},{$pagesize}";
            return $this->db->getAll($sql);
        }
    }
