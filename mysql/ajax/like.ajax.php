<?php
    // echo "<pre>";
    // print_r($_SERVER);
    // echo "</pre>";
    // include("classes/autoload.php");


   // $login = new Login();
   // $user_data=$login -> check_login($_SESSION['mybook_userid']);
   if(!isset($_SESSION['mybook_userid']))
   {
        die;
   }
    $query_string = explode("?",$data->link);
    $query_string = end($query_string);
    
    $str = explode("&",$query_string);
    // print_r($str);
    foreach ($str as $value)
    {
        $value = explode("=",$value);
        $_GET[$value[0]] = $value[1];
    }


        $_GET['type']= addslashes($_GET['type']);
        $_GET['id']= addslashes($_GET['id']);

       if(isset($_GET['type']) && isset($_GET['id']))
       {
            $post = new Post();
            if(is_numeric($_GET['id']))
            {
               $allowed[]='post';
               $allowed[]='user';
               $allowed[]='comment';


                if(in_array($_GET['type'],$allowed))
               {               
                $post = new Post();
                $user_class = new User();
                $post-> like_post($_GET['id'],$_GET['type'],$_SESSION['mybook_userid']);
                
                if($_GET['type'] == 'user')
                {   
                    $user_class-> follow_user($_GET['id'],$_GET['type'],$_SESSION['mybook_userid']);
                    
                }
               }

            }
            // read likes
            $likes = $post-> get_likes($_GET['id'],$_GET['type']);
            $likes_count = count($likes);
           
            //creat info
            $likes = array();
            $info ="";
            $i_liked = false;
            if(isset($_SESSION['mybook_userid']))
            {
                //save likes details
                $sql = "select likes from likes where type = 'post' && contentid = '$_GET[id]' limit 1";
                $DB = new Database();
            
                $result=$DB -> read($sql);
                if(is_array($result))
                {
                    $likes =json_decode($result[0]['likes'],true);
                    // print_r($likes);
            
                    $user_ids = array_column($likes,"userid");
            
                    if(in_array($_SESSION['mybook_userid'],$user_ids)) 
                    {
                        $i_liked =true;
                    }
                }
            }
            
            $like_count = count($likes);
            if( $like_count>0)
            {
            //    $info.= "<a id='info_$_GET[id]' href = 'likes.php?type=post&id=$_GET[id]' style='color:azure'>";
                if($like_count == 1)
                {
                    if($i_liked)
                    {
                        $info.= "<br><br> You liked this post!";
                    }else
                    {
                        $info.= "<br><br> 1 person liked this post!";
                    }
                    
                }else{
                    if($i_liked)
                    {
                        $text = "others";
                        if($like_count-1 == 1)
                        {
                            $text = "other";
                            $info.= "<br><br> You and ".($like_count -1) ." ".$text." liked this post!";
                        }
                        else{
                            $info.= "<br><br> You and ".($like_count -1) ." ".$text." liked this post!";
                        }

                       
                    }else
                    {
                        $info.= "<br><br> You and ".$like_count ." other liked this post!";
                    }
                    
                }
                
                // $info.= "</a>";
                
            }
            else
            {
                $info="";
            }
        



            //create info 
            $obj =(object)[];
            $obj-> likes = count($likes);
            $obj-> action = "like_post";
            $obj-> info = $info;
            $obj-> id = "info_$_GET[id]";
            // print_r($obj);

            echo json_encode($obj);
       }

    
    //    echo " $return_to";   
    //    print_r($_SERVER['HTTP_REFERER']) ;
    //    echo "<pre>";
    //    print_r($_SERVER) ;
    //    echo "</pre>";e

 


?>