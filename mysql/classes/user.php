<?php
    class User
    {
        public function get_data($id)
        {
            $query = "select * from users where userid = '$id' limit 1";
            $DB = new Database();
            $result = $DB-> read($query);

            if($result)
            {
                $row = $result[0];
                return $row;
            }else
            {
                return false;
            }

        }
        public function get_user($id)
        {
            // echo "$id";
            $query = "select * from users where userid = '$id' limit 1";
            $DB = new Database();
            $result = $DB -> read($query);
            // print_r($result);
            if($result)
            {
                $result=$result[0];
                return $result;
            }else
            {
                return false;
            }
        
        }
        public function get_friends($id)
        {
            // echo "$id";
            // echo "hello";
            $query = "select * from users where userid != '$id' ";
            $DB = new Database();
            $result = $DB -> read($query);
            // print_r($result);
            if($result)
            {
                $result=$result;
                return $result;
            }else
            {
                return false;
            }
        
        }

        public function get_following($id,$type,)
        {   $DB = new Database();
            if(is_numeric($id))
                {
                    
                    //save following details
                    $sql = "select following from likes where type = '$type' && contentid = '$id' ";
                    // echo "$type";
                    // echo "$id";
                    
                    $result=$DB -> read($sql);
                    // print_r($result);
                    if(is_array($result))
                    {
                        $following =json_decode($result[0]['following'],true);
                        return $following;

                    }
                }
                return false;
        }

        public function follow_user($id,$type,$mybook_userid)
        {

      
            //save likes details
            $sql = "select following from likes where type = '$type' && contentid = '$mybook_userid' limit 1";
            $DB = new Database();
            $result=$DB -> read($sql);
            // echo "ddd";
            
            // if(is_array($result))
            if($result[0]['following'])
            {
                $likes =json_decode($result[0]['following'],true);
               
                print_r($likes);
        
                $user_ids = array_column($likes,"userid");
        
                if(!in_array($mybook_userid,$user_ids))
                {
                    $arr["userid"]= $id;
                    $arr["date"]=date("Y-m-d H:i:s");
                    $likes[] = $arr;
                    
                    $likes_string = json_encode($likes);
                    $sql= "update likes set following = '$likes_string' where type='$type' && contentid = '$mybook_userid' limit 1";
                    $DB->save($sql);

                    // echo "aaa";
        
        
        
                }else{
                    // echo"ccc";
                    $key = array_search($id,$user_ids);
                    unset($likes[$key]);
                    $likes_string = json_encode($likes);
                    
                    $sql= "update likes set following = '$likes_string' where type='$type' && contentid = '$mybook_userid' limit 1";
                    $re_2=$DB->save($sql);



                }

            }else
            {
                $arr["userid"]= $id;
                $arr["date"]=date("Y-m-d H:i:s");
        
                $arr2[] = $arr;
               
                
                $following = json_encode($arr2);
                $sql= "insert into likes (type,contentid,following) values ('$type','$mybook_userid','$following')";
                $DB->save($sql);


            }
        
        
           
            
        
        }        

    }

?>