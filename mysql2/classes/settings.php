<?php
    Class Settings
    {
        public function get_settings($id)
        {
            $DB = new Database();
            $sql = "select * from users where userid = $id limit 1";
            $row = $DB->read($sql);

            if(is_array($row))
            {
                return $row[0];
            }
        }
        public function save_settings($data,$id)
        {
            $DB = new Database();
            $password = $data['password'];
            if(strlen($password)<30)
            {
                if($data['password'] == $data['password2'])
                {
                    $data['password']=$data['password'];
                    // $data['password']= hash("sha1",$password);
                    #$password;
                }else{
                    unset($data['password']);
                }
                unset($data['password2']);

                $sql = "update users set ";
                foreach($data as $key => $value)
                {
                    #code ..
                    $sql .= $key . "='" .$value . "',";

                }
                    $sql = trim($sql,",");
                    $sql .= " where userid = '$id' limit 1";
                    echo $sql;
                    // $sql 
                    $DB -> save($sql);
                
            }
        }

    }
?>