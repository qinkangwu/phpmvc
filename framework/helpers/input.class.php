<?php
    function deepSpecialChars($data){
        if(empty($data)){
            return $data;
        }
        return is_array($data)? array_map('deepSpecialChars',$data) : htmlspecialchars($data);
    }
    function deepSlashes($data){
        if(empty($data)){
            return $data;
        }
        return is_array($data)? array_map('deepSlashes',$data) : addslashes($data);
    }