<?php
    class AttributeModel extends Model{
        public function getPageAttrs($type_id,$offset,$pagesize){
            if($type_id == 0){
                $sql = "select * from {$this->table} as a inner join {$GLOBALS['config']['prefix']}goods_type as b on a.type_id=b.type_id order by attr_id desc limit {$offset},{$pagesize}";
            }else{
                $sql = "select * from {$this->table} as a inner join {$GLOBALS['config']['prefix']}goods_type as b on a.type_id=b.type_id 
                  where a.type_id={$type_id}
                  order by attr_id desc limit {$offset},{$pagesize}
                ";
            }
            return $this->db->getAll($sql);
        }
    }
