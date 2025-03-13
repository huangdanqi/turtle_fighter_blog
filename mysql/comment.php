<div id="post">
    <div>
        <?php
            $image = "images/Picture1.png";
            
            if($ROW_USER['gender'] == 'Female')
            {
               
                $image = "images/Picture2.png";
            }
            elseif($ROW_USER['gender'] == 'Secret')
            {
            
                $image = "images/Picture3.png";
            }
            if(file_exists($ROW_USER['profile_image']))
            {
                
                $image = $image_class -> get_thumb_profile($user_data['profile_image']);
                
            }

        ?>
        <img src="<?php echo $image ?>" style="width: 75px;margin-right: 4px;">

    </div>
    <div style='width:100%'>
        <div style="font-weight: bold;color: chocolate;font-size: 16px;width:'100%'">
             <?php 
             echo "<a href='profile.php?id=$ROW[userid]'>";
             echo  htmlspecialchars( $ROW_USER['first_name'])." ". htmlspecialchars($ROW_USER['last_name']); 
             echo  "</a>";
             
                if($ROW['is_profile_image'])
                {
                    $pronoun = "his";
                    if($ROW_USER['gender'] == "Female")
                    {
                        $pronoun ="her";
                    }elseif($ROW_USER['gender'] == "Secret")
                    {
                        $pronoun =$ROW_USER['first_name']." ". $ROW_USER['last_name']."'s";
                    }
                
                    echo "<br>
                    
                          &nbsp &nbsp &nbsp<span style='color:orange'>updated $pronoun profile image </span>";
                }
                
                if($ROW['is_cover_image'])
                {
                    $pronoun = "his";
                    if($ROW_USER['gender'] == "Female")
                    {
                        $pronoun ="her";
                    }elseif($ROW_USER['gender'] == "Secret")
                    {
                        $pronoun =$ROW_USER['first_name']." ". $ROW_USER['last_name']."'s";
                    }
                
                    echo "<br> 
                    
                          &nbsp &nbsp &nbsp<span style='color:orange'>updated $pronoun cover image </span>";
                }
                
            

            ?>
        </div>
        <?php echo htmlspecialchars($ROW['post']); ?>
        <br>
        <br>
        <?php
            if(file_exists($ROW['image']))
            {
                $post_image = $image_class-> get_thumb_post($ROW['image']);
                echo "<img src='$post_image' style='width:10%;' />";
            }
        ?>
        <br>
        <br>
        <?php 
            $likes = "";
            if($ROW['likes'] >0)
            {
                $likes = "[&nbsp".$ROW['likes']."&nbsp]";
            }else
            {
                $likes = "";
            }
           
    
        ?>
        <a href="like.php?type=post&id=<?php echo $ROW['postid'] ?>">like &nbsp<?php echo $likes ?></a> . 
        <a href="single_post.php?id=<?php echo $ROW['postid']?>">Comment</a> . 
        <span style="color:coral;">
           <?php echo $COMMENT['date'];?>
        </span>
        <?php
            
           
            if($COMMENT['has_image'])
            {
               
                echo "<a href='image_view.php?id=$ROW[postid]' >";
                echo ".View Full Image.";
                echo "</a>";

            }
        ?>


        <span style="color:gray; float:right">

            <?php
                $post = new Post();

                if($post->i_own_posts($ROW['postid'],$_SESSION['mybook_userid']))
                {
                    echo "
                    <a href='edit.php?id=$ROW[postid]'>
                        Edit 
                    </a>
                        . 
                    <a href='delete.php?id= $ROW[postid]'>
                        Delete
                    </a> ";
                }


            ?>


        </span>
        <span style="text-align:left">
        <?php
            $i_liked = false;
            if(isset($_SESSION['mybook_userid']))
            {
                //save likes details
                $sql = "select likes from likes where type = 'post' && contentid = '$ROW[postid]' limit 1";
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
            if($ROW['likes']>0)
            {
               echo "<a href = 'likes.php?type=post&id=$ROW[postid]' style='color:azure'>";
                if($ROW['likes'] == 1)
                {
                    if($i_liked)
                    {
                        echo "<br><br> You liked this post!";
                    }else
                    {
                        echo "<br><br> 1 person liked this post!";
                    }
                    
                }else{
                    if($i_liked)
                    {
                        $text = "others";
                        if($ROW['likes']-1 == 1)
                        {
                            $text = "other";
                            echo "<br><br> You and ".($ROW['likes'] -1) ." ".$text." liked this post!";
                        }
                        else{
                            echo "<br><br> You and ".($ROW['likes'] -1) ." ".$text." liked this post!";
                        }

                       
                    }else
                    {
                        echo "<br><br> You and ".$ROW['likes'] ." other liked this post!";
                    }
                    
                }

                echo "</a>";
                
            }
        ?>
        </span>
    </div>    

</div>
<hr>