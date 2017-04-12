<?php
    class CategoryModel extends Model{
        public function getCats(){
            $sql = "SELECT * FROM {$this->table}";
            return $this->db->getAll($sql);
        }
    }
