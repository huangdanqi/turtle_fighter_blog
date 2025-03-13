<div id="friends" style="display:inline-block;">

        <?php
            $image = "images/Picture1.png";
           
            if($FRIEND_ROW['gender'] == 'Female')
            {
                $image = "images/Picture2.png";
            }
            elseif($FRIEND_ROW['gender'] == 'Secret')
            {
                $image = "images/Picture3.png";
            }
            if(file_exists($FRIEND_ROW['profile_image']))
            {
                
                $image= $image_class-> get_thumb_profile($FRIEND_ROW['profile_image']);
            }

        ?>
    <p style="text-align:center">
    <a href="profile.php?id=<?php echo $FRIEND_ROW['userid']; ?>">    
        <img id="friends_img" src="<?php echo $image ?>">
        <br>
        <?php echo $FRIEND_ROW['first_name']." ".$FRIEND_ROW['last_name']; ?>
    </a>    
    <p>

</div>