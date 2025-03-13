<?php 
    class Post
    {
        private $error="";
        // echo "Hello world!";
        public function create_post($userid,$data,$files)
        {
            // print_r($data['post']);
            // print_r(empty($data['post']));
            if(!empty($data['post']) || !empty($files['file']['name']) || isset($data['is_profile_image']) || isset($data['is_cover_image']) )
            {
                $myimage = "";
                $has_image = 0;
                $is_cover_image= 0;
                $is_profile_image= 0;

                if(isset($data['is_profile_image']) || isset($data['is_cover_image']))
                {
                 $myimage = $files;
                 $has_image = 1;
                 $is_cover_image=1;

                 if(isset(($data['is_cover_image'])))
                 {
                    $is_cover_image= 1 ;
                 }
                 if(isset($data['is_profile_image']))
                 {
                    $is_profile_image = 1;
                 }

                
                }else
                {

                    
                    if(!empty($files['file']['name']))
                    {
                        // $image_class=new Image();
                        $folder = "uploads/" .$userid . "/";
                        //create folder
                        if(!file_exists($folder))
                        {
                            mkdir($folder,0777,true);
                            file_put_contents($folder."index.php","");

                        }
                        $image_class  = new Image();
                        $myimage = $folder. $image_class->generate_filename(8).".png";
                        move_uploaded_file($_FILES['file']['tmp_name'],$myimage);

                        $image_class -> resize_image($myimage,$myimage,1500,1500);


                        // $myimage = "";
                        $has_image= 1;
                    }
                }
                $post = "";
                if(isset($data['post']))
                {
                    $post = addslashes($data['post']);
                }
                
                $postid = $this->create_postid();
                $parent = 0;
                $DB = new Database();

                if(isset($data['parent']) && is_numeric($data['parent']))
                {
                    $parent = $data['parent'];
                    $sql = "update posts set comments = comments + 1 where postid = '$parent' limit 1";
                    $DB -> save($sql);

                }
                $query = "insert into posts (userid,postid,post,image,has_image,is_cover_image,is_profile_image,parent) values ('$userid','$postid','$post','$myimage','$has_image','$is_cover_image','$is_profile_image','$parent')";
                $DB -> save($query);

            }else
            {
                // echo "Hello world! 2";
                $this->error .= "Please type something to post!<br>";
            }

            return $this->error;
        }

        public function edit_posts($data,$files)
        {
            // print_r($data['post']);
            // print_r(empty($data['post']));
            if(!empty($data['post']) || !empty($files['file']['name']))
            {
                $myimage = "";
                $has_image = 0;
          
                if(!empty($files['file']['name']))
                {
                    // $image_class=new Image();
                    $folder = "uploads/" .$userid . "/";
                    //create folder
                    if(!file_exists($folder))
                    {
                        mkdir($folder,0777,true);
                        file_put_contents($folder."index.php","");

                    }
                    $image_class  = new Image();
                    $myimage = $folder. $image_class->generate_filename(8).".png";
                    move_uploaded_file($_FILES['file']['tmp_name'],$myimage);

                    $image_class -> resize_image($myimage,$myimage,1500,1500);


                    // $myimage = "";
                    $has_image= 1;
                }
            
                $post = "";
                if(isset($data['post']))
                {
                    $post = addslashes($data['post']);
                }
                
                $postid = addslashes($data['postid']);
                if($has_image)
                {
                    $query = "update posts set post = '$post' , image = '$myimage' where postid = '$postid' limit 1 ";
                }else
                {
                    $query = "update posts set post = '$post' where postid = '$postid' limit 1 ";
                }

                
                $DB = new Database();
                $DB -> save($query);

            }else
            {
                // echo "Hello world! 2";
                $this->error .= "Please type something to post!<br>";
            }

            return $this->error;
        }

        public function get_posts($id)
        {
            $page_number = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $page_number = ($page_number < 1) ? 1 : $page_number;

            $limit = 10;
            $offset = ($page_number - 1) * $limit;
            
            $query = "select * from posts where parent = 0 and userid = '$id' order by id desc limit $limit offset $offset";
            $DB = new Database();
            $result= $DB-> read($query);
            if($result)
            {
                return $result;
            }else
            {
                return false;
            }
        }
        public function get_comments($id)
        {
            $page_number = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $page_number = ($page_number < 1) ? 1 : $page_number;

            $limit = 10;
            $offset = ($page_number - 1) * $limit;            
            $query = "select * from posts where parent = '$id' order by id asc $limit offset $offset ";
            $DB = new Database();
            $result= $DB-> read($query);
            if($result)
            {
                return $result;
            }else
            {
                return false;
            }
        }

        public function get_one_posts($postid)
        {
            
            if(!is_numeric($postid))
            {
                return false;
            }
            $query = "select * from posts where postid = '$postid' limit 1";
            $DB = new Database();
            $result= $DB-> read($query);
            if($result)
            {
                return $result[0];
            }else
            {
                return false;
            }
        }
        public function delete_posts($postid, $mybook_userid)
        {
           
            if(!is_numeric($postid))
            {
                return false;
            }
            $DB = new Database();
            $sql = "select parent from posts where postid = '$postid' limit 1 ";
            $result = $DB-> read($query);

            if(is_array($result))
            {
                if($result[0]['parent'] >0)
                {
                    $parent = $result[0]['parent'];
                    $sql = "update posts set comments = comments - 1 where postid = '$parent' limit 1";
                    $DB-> save($sql);

                }
            }


            $query = "delete from posts where postid = '$postid' limit 1";
            
            

        }
        public function i_own_posts($postid, $mybook_userid)
        {
           
            if(!is_numeric($postid))
            {
                return false;
            }
            $query = "select * from posts where postid = '$postid' limit 1";
            $DB = new Database();
            $result =$DB-> read($query);

            if(is_array($result))
            {
                // print_r($result);
                if($result[0]['userid'] == $mybook_userid)
                    {
                        return true;
                    }
            }
            return false;

        }
     
        public function get_likes($id,$type,)
        {   $DB = new Database();
            if(is_numeric($id))
                {
                    
                    //save likes details
                    $sql = "select likes from likes where type = '$type' && contentid = '$id' limit 1";
                    
                    $result=$DB -> read($sql);
                    if(is_array($result))
                    {
                        $likes =json_decode($result[0]['likes'],true);
                        return $likes;

                    }
                }
                return false;
        }


        public function create_postid()
        {
            $length = rand(4,19);
            $number = "";
            for ($i=0;$i<$length;$i++)
                {
                    #code...
                    $new_rand = rand(0,9);
                    $number = $number . $new_rand;
                }
            return $number;
        }

        public function like_post($id,$type,$mybook_userid)
        {

      
            //save likes details
            $sql = "select likes from likes where type = '$type' && contentid = '$id' limit 1";
            $DB = new Database();
           
            
            $result=$DB -> read($sql);
            // echo "ddd";
            // print_r($result);
            // $result=$result[0];
            // print_r($result['likes']);
            // echo "sdd";
            $judge=$result[0]['likes'];
            if($judge)
            {
                $likes =json_decode($result[0]['likes'],true);
                // print_r($result);
                // echo "aaa";
        
                $user_ids = array_column($likes,"userid");
        
                if(!in_array($mybook_userid,$user_ids))
                {
                    $arr["userid"]= $mybook_userid;
                    $arr["date"]=date("Y-m-d H:i:s");
                    $likes[] = $arr;
                    
                    $likes_string = json_encode($likes);
                    $sql= "update likes set likes = '$likes_string' where type='$type' && contentid = '$id' limit 1";
                    $DB->save($sql);
                    //increment the posts table
                    $sql = "update {$type}s set likes = likes + 1 where {$type}id ='$id' limit 1";
                    $DB = new Database();
                    $DB ->save($sql);
                    // echo "aaa";
        
        
        
                }else{
                    // echo"ccc";
                    $key = array_search($mybook_userid,$user_ids);
                    unset($likes[$key]);
                    $likes_string = json_encode($likes);
                    // print_r($likes_string);
                    $sql= "update likes set likes = '$likes_string' where type='$type' && contentid = '$id' limit 1";
                    $re_2=$DB->save($sql);
                    // print_r($re_2);


                    //minus the posts table
                    $DB = new Database();
                    $sql ="select * from {$type}s where {$type}id ='$id'";
                  
                    $result_a=$DB -> read($sql);
                    $likes_num =  $result_a[0]['likes'];
                    // print_r($result_a);
                    // print_r($likes_num);

                    if($likes_num>0)
                    {
                        $sql = "update {$type}s set likes = likes - 1 where {$type}id ='$id' limit 1";
                    
                        $DB ->save($sql);
                    }
                    

                    // die;


                }
                // $arr["userid"]= $mybook_userid;
                // $arr["date"]=date("Y-m-d H:i:s");
                
                // $likes = json_encode($arr);
                // $sql= "insert into likes (type,contentid,likes) values ('$type','$id','$likes')";
                // $DB->save($sql);
            }else
            {
                $arr["userid"]= $mybook_userid;
                $arr["date"]=date("Y-m-d H:i:s");
        
                $arr2[] = $arr;
               
                
                $likes = json_encode($arr2);
                $sql= "insert into likes (type,contentid,likes) values ('$type','$id','$likes')";
                $DB->save($sql);

                //increment the posts table
                $sql = "update {$type}s set likes = likes + 1 where {$type}id ='$id' limit 1";
                $DB = new Database();
                $DB ->save($sql);
            }
        
        
           
            
        
        }




    }

    //collect posts
    // $post = new Post();
    // $id = $_SESSION['mybook_userid'];
    // $posts = $post->get_posts($id,$_POST);
?>


<?php
// public function like_post($id,$type,$mybook_userid)
// {
//    if ($type == "post")
//    {
//     //increment the posts table
//     $sql = "update posts set likes = likes + 1 where postid ='$id' limit 1";
//     $DB ->save($sql);

//     //save likes details
//     $sql = "select likes from likes where type = 'post' && contentid = '$id' limit 1";
//     $result=$DB -> read($sql);
//     if(is_array($result))
//     {
//         $likes =json_decode($result['likes'],true);

//         $user_ids = array_column($likes,"userid");

//         if(!in_array($mybook_userid,$user_ids))
//         {
//             $arr["userid"]= $mybook_userid;
//             $arr["date"]=date("Y-m-d H:i:s");
//             $likes[] = $arr;
            
//             $likes_string = json_encode($likes);
//             $sql= "update likes set likes = '$like_string' where type='post' && contentid = '$id' limit 1";
//             $DB->save($sql);



//         }
//         // $arr["userid"]= $mybook_userid;
//         // $arr["date"]=date("Y-m-d H:i:s");
        
//         // $likes = json_encode($arr);
//         // $sql= "insert into likes (type,contentid,likes) values ('$type','$id','$likes')";
//         // $DB->save($sql);
//     }else
//     {
//         $arr["userid"]= $mybook_userid;
//         $arr["date"]=date("Y-m-d H:i:s");

//         $arr2[] = $arr;
       
        
//         $likes = json_encode($arr2);
//         $sql= "insert into likes (type,contentid,likes) values ('$type','$id','$likes')";
//         $DB->save($sql);
//     }


//    }
    

// }

?>