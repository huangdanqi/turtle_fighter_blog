<div id="post">
    <div>
        <?php
            $image = "images/Picture2.png";
            if($ROW_USER['gender'] == 'Female')
            {
                $image = "images/Picture3.png";
            }
            elseif($ROW_USER['gender'] == 'Secret')
            {
                $image = "images/Picture4.png";
            }
            $image_class = new Image();
            if(file_exists($ROW_USER['profile_image']))
            {
                $corner_image = $image_class -> get_thumb_profile($user_data['profile_image']);
                
            }

        ?>
        <img src="<?php echo $image ?>" style="width: 75px;margin-right: 4px;">

    </div>
    <div style='width:100%'>
        <div style="font-weight: bold;color: chocolate;font-size: 16px;width:'100%'">
             <?php echo $ROW_USER['first_name']." ". $ROW_USER['last_name']; 
            
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
        
    </div>    

</div>
<hr>