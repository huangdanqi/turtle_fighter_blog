<?php
    
    // unset($_SESSION['turtle_fighter_userid']);
    include("classes/autoload.php");

   

//$_SESSION['turtle_fighter_userid'];

$login = new Login();
$user_data =$login -> check_login($_SESSION['turtle_fighter_userid']);
$log_user_data =$user_data;
if(isset($_GET['id']) && is_numeric($_GET['id']))
{
    $profile = new Profile();
    $profile_data = $profile ->get_profile($_GET['id']);
    if(is_array($profile_data))
    {
        $user_data = $profile_data[0];
    }
    
}




// print_r($user_data);
// posting starts here;
if($_SERVER['REQUEST_METHOD'] == "POST")
{
    $post = new Post();
   
    $result = $post -> create_post($_SESSION['turtle_fighter_userid'],$_POST,$_FILES,$_GET['id']);
    if($result =="")
    {

        if(isset($_GET['id']) && is_numeric($_GET['id']))
        {
            
            $friends_profile="profile.php?id=".$_GET['id'];
            header("Location:$friends_profile");
            die;

        

        }else
        {
            header("Location:profile.php");
            die;
        }



    }else
    {
        echo "<div style='text-align:center;font-size:16px;color:navy;background-color:#d2b48c;'>";
        echo "<br><span style='font-size:32px'>Oh,the following errors occured :<br>&#128034&#127877&#128034</span><br>";
        echo $result;
        echo "</div>";        
    }
}

//collect posts
$post = new Post();
$id = $user_data['userid'];
$posts = $post -> get_posts($id);


//collect friends
$user =  new User();
$id = $user_data['userid'];
$friends = $user-> get_friends($id);



?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Day_Dream | profile</title>
        <link rel="icon"  type="image/x-icon" href="s.ico">
    <head>
        <style>
            #blue_bar{
             height: 50px;
             background-color: #800020;
             color: bisque;
            }
            #search_box{
                width:400px;
                height:20px;
                border-radius: 5px;
                border:none;
                padding: 4px;
                font-size: 14px;
                background-image: url(search.png);
                background-size:24px 24px;
                background-repeat: no-repeat;
                background-position:right ;
                
            }
            #profile_pic{
                width:150px;
                margin-top: -200px;
                border-radius: 50%;
                border:solid 3px bisque;
            }
            #menu-buttons{
                /* background-color: black; */
                width: 100px;
                display: inline-block;
                margin: 2px;


            }
            #friends_img{
                width:75px;
                float: left;
                margin:8px;

            }

            #friends_bar{
                background-color:azure;
                min-height: 400px;
                margin: 20px;
                color:indianred;
                padding: 8px;
            }
            #friends{
                clear: both;
                font-size:12px;
                font-weight: bold;
                color: chocolate;
            }
            textarea{
                width:98%;
                border:dashed 2px black;
                font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
                font-size: 14px;
                height: 60px;
            }
            #post_button{
                float: right;
                background-color: peru;
                border: none;
                font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
                color:bisque;
                padding: 4px;
                font-size: 14px;
                border-radius: 2px;
                width:50px;
            }
            #post_bar{
                margin-top:20px;
                background-color:indigo;
                padding: 10px;
            }
            #post{
                padding: 4px;
                font-size: 13px;
                display: flex;
                margin-bottom: 20px;
            }
            a{
                color: hotpink;
            }

        </style>
    <body style="font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif; background-color:peru;" >
        <!--top bar-->
         <?php
            include("header.php");
         ?>
        <!--cover area-->  
        <div style="width:800px;margin:auto; min-height: 400px;">
            <div style="background-color:navy;text-align: center; color:bisque;margin-top: 20px;">
                <?php
                    $cover_image = "profile_2.png";
                    
                    if(file_exists($user_data['cover_image'] ))
                    {
                        $cover_image = $user_data['cover_image'];
                    }
                ?>               
                <img src="<?php echo $cover_image?>" style="width:100%;">
                <?php
                    $image = "Picture1.png";
                    
                    if(file_exists($user_data['profile_image'] ))
                    {
                        $image = $user_data['profile_image'];
                    }
                    

                ?>
                <img id="profile_pic" src="<?php echo $image?>" >
                <br>
                
                <div style="font-size: 20px;">
                    <?php echo $user_data['first_name'] ." ". $user_data['last_name'] ?>
                    <br>
                    <?php 
                        if( $log_user_data['userid']==$user_data['userid'])
                        {
                            echo '<a href="change_profile_image.php" style="text-decoration:none"><span style="font-size:12px;color:azure;">Change Cover/Profile Image</span></a>';
                        }
                        else
                        {
                            echo '<br>';
                        }
                    ?>
                    
                
                </div>
                <br>
                <a href= "index.php"><div id="menu-buttons">Timeline</div></a>
                <div id="menu-buttons">About </div>
                <div id="menu-buttons">Friends</div> 
                <div id="menu-buttons">Photos</div> 
                <div id="menu-buttons">Settings</div>
            </div>    
           <!--below cover area-->
            <div style="display: flex;">
                <!--friends area-->
                <div style="background-color: green; min-height: 400px;flex:1;">
                    <div id="friends_bar">
                        Friends<br>
                        <?php
                           
                            if($friends)
                            {
                                foreach($friends as $FRIEND_ROW)
                                {
                                    include("user.php");
                                }
                            }
                        ?>
                    </div>
                </div>
                <!--posts area-->
                <div style="background-color: grey;min-height: 400px;flex: 2.5; padding: 20px; padding-right: 0px;">
                    <div style="border:solid thin #aaa;padding:10px;background-color: white;">

                        <form method="post" enctype="multipart/form-data" >
                            <textarea name="post" placeholder="Hello,write something *_^, happy things ,bad things ,angry things,all of it! You are a human, you have all of the emotions! No just happiness!^_*"></textarea>
                            <input type= "file" name ="file" style="color:black;">
                            <input id="post_button" type="submit" value="Post">
                            <br>
                        </form>
                        <br>
                    </div>
                <!--post-->
                    <div id="post_bar">

                   

                    <?php
                    if($posts)
                    {
                        
                        foreach($posts as $ROW)
                        {
                            $user = new User();
                            $ROW_USER = $user->get_user($ROW['userid']);
                            include("post.php");

                            echo'<a href="#">like</a> . <a href="#">Comment</a> 
                            <span style="color:coral">
                                <?php echo htmlspecialchars($ROW[date]); ?>
                            </span>';

                            if( $log_user_data['userid']==$ROW['userid'])
                            {
                               echo' <span style ="color:#999;float:right">
                    
                            

                               
                                 <a href="delete.php?id=<?php echo $ROW[postid]?>">
                                Delete
                                 
                                 </a>
                             </span>';
                             
                            }
                            echo '<hr>';
                          
                    
                        }
                    }
                        
                    ?>

                        
                    </div>
                </div>
            </div>    

        </div>
    </body>        

</html>