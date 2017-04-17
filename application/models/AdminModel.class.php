<?php
    class AdminModel extends Model{
        public function getAdmin(){
            $sql = "select * from {$this->table}";
            return $this->db->getAll($sql);
        }
        public function checkUser($username,$password){
            //$password = md5($password);
            $sql = "select * from {$this->table}
                where admin_name='{$username}' and admin_password='{$password}'
                limit 1;
            ";
            return $this->db->getRow($sql);

        }
    }
