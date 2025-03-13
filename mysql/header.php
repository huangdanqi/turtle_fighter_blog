
<?php
    $corner_image="Picture1.png";
    if(isset($USER))
    {   
        if(file_exists($USER['profile_image']))
        {
            // $conner_image= $user_data['profile_image'];
            $image_class = new Image();
            $corner_image = $image_class -> get_thumb_profile($USER['profile_image']);
        }
        else
        {
            if($USER['gender'] == 'Female')
            {
                $corner_image = "Picture2.png";
            }
            elseif($USER['gender'] == 'Secret')
            {
                $corner_image = "Picture3.png";
            }

        }
    }



?>
<div id="blue_bar">
    <form method="get" action="search.php">
        <div style="width:800px;margin:auto;font-size: 30px;">
            <a href="index.php" style="text-decoration:none;color:bisque">Turtle_Blog</a>
            
            
            &nbsp &nbsp
            <input type="text" id="search_box" name='find' placeholder="Search for people">
            
            <a href = "profile.php">
            <img src="<?php  echo  $corner_image ?>" style="width:50px;float: right;">
            </a>
            <a href="logout.php" >
            <span style="font-size:16px;float:right buttom ;margin:10px;background-color:azure">Logout </span>
            </a>
        </div>
    </form>   
<div>  
