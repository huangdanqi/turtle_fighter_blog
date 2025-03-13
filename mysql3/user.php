
<div id="friends">

         <?php
          $friends_image = "Picture1.png";
          if(file_exists($FRIEND_ROW['profile_image'] ))
            {
                $friends_image = $FRIEND_ROW['profile_image'];
            }
        ?>
    
    <a href ="profile.php?id=<?php echo $FRIEND_ROW['userid'];?>" style="color:navy;text-decoration:none;">
        <img id="friends_img" src="<?php echo $friends_image; ?>" >


        <br>
        <?php echo $FRIEND_ROW['first_name'] .'<br> '. $FRIEND_ROW['last_name'] ; ?>
    </a>
</div>