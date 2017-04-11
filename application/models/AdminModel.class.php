<?php
    class AdminModel extends Model{
        public function getAdmin(){
            $sql = "select * from {$this->table}";
            return $this->db->getAll($sql);
        }
    }
