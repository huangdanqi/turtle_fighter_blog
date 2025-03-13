<?php
    $corner_image = "Picture1.png";

    if(file_exists($log_user_data ['profile_image'] ))
    {
        $corner_image = $log_user_data ['profile_image'];
    }
    
?>

<!--top bar-->
<div id="blue_bar">
    <div style="width:800px;margin:auto;font-size: 30px;">
        
        <a href="profile.php" style="color:bisque;font-size: 20px">Turtle_Blog_Home 
        &nbsp  
        <span style="font-size: 10px;color:azure"> [ <?php echo $log_user_data['first_name'] ." ". $log_user_data['last_name'] ?> ] </span> 
        
        </a>

 
        &nbsp &nbsp
        <input type="text" id="search_box" placeholder="Search for people">  
        
        <img src="<?php echo $corner_image ?>" style="width:50px;float: right;">

        <a href = "logout.php">
        <span style="font-size:13px; float:right;margin:13px;color:PaleGreen"> Logout</span>
        
        </a>
        
    </div>
<div>  