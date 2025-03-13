<div style="min-height:400px;width:100%;background-color:OliveDrab;text-align:center;">
    <div style="padding:20px">
<?php

    $image_class = new Image();
    $post_class = new Post();
    $user_class = new User();

    $follwers = $post_class->get_likes($user_data['userid'],"user");

    if(is_array($follwers))
    {
        foreach($follwers as $follwer)
        {
            $FRIEND_ROW = $user_class-> get_user($follwer['userid']);
            
            include("user.php");
        }
        
    }else
    {
        echo "No followers were found!";
    }

?>
    </div>
</div>