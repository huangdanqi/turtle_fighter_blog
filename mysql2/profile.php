<?php

   include("classes/autoload.php");
   $login =new Login();
   $user_data=$login -> check_login($_SESSION['mybook_userid']);
   $USER = $user_data;
   
   $profile = new Profile();
//    print_r($_GET);
   if (isset($_GET['id']) && is_numeric($_GET['id']))
   {
        $profile_data = $profile -> get_profile($_GET['id']);

        if(is_array($profile_data))
        {
            $user_data = $profile_data[0];
        }
   };


    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        include("change_image.php");
        if(isset($_POST['first_name']))
        {

            $settings_class = new Settings();
            $settings_class -> save_settings($_POST,$_SESSION['mybook_userid']);

        }else{
            // var_dump($_FILES);
            $post= new Post();
            $id=$_SESSION['mybook_userid'];
            $result = $post->create_post($id,$_POST,$_FILES);
            if(!empty($result))
            {
                echo "<div style='text-align:center;font-size:12px;color:white;background-color:grey;'>";
                echo "<br>The following errors occured:<br><br>";
                print_r($result);
                echo "</div>";
                // print_r($_POST);
            }else
            {
                header("Location: profile.php");
                die;
            }


        }




    }
    //collect posts
    $post = new Post();
    // $id = $_SESSION['mybook_userid'];
    
    $id = $user_data['userid'];
    $posts = $post->get_posts($id);

    
    //collect friends
    $user = new User();
    // $id = $_SESSION['mybook_userid'];
    $id = $user_data['userid'];
    $friends = $user->get_friends($id);

    //collect image
    $image_class = new Image();


// print_r($user_data);   
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Day_Dream | profile</title>
        <link rel="icon"  type="image/x-icon" href="snowman.ico">
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
                border:solid 2px white;
            }
            #menu-buttons{
                /* background-color: black; */
                width: 100px;
                display: inline-block;
                margin: 2px;


            }
            #textbox{
                width: 100%;
                height: 20px;
                border-radius:5px;
                border:none;
                padding:4px;
                font-size:14px;
                border:solid thin #grey;
                margin:10px;
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
                /* width:50px; */
                cursor: pointer;
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
        <!-- <div id="blue_bar">
           <div style="width:800px;margin:auto;font-size: 30px;">
                <a href="index.php" style="text-decoration:none;color:bisque">Turtle_Blog</a>
                
                
                &nbsp &nbsp
                <input type="text" id="search_box" placeholder="Search for people">
                <img src="Picture1.png" style="width:50px;float: right;">
                <a href="logout.php" >
                <span style="font-size:16px;float:right buttom ;margin:10px;background-color:azure">Logout </span>
                </a>
           </div>
        <div>   -->
        <!--change profile image area-->
        <div id="change_profile_image" style="display:none;position:absolute;width:100%;height:100%;background-color:#000000aa;"> 
                <!--posts area-->
            <div style="max-width:600px;margin:auto;background-color: grey;flex: 2.5; padding: 20px; padding-right: 0px;">
                <form method = "post" action="profile.php?change=profile" enctype="multipart/form-data">
                    <div style="border:solid thin #aaa;padding:10px;background-color: navy;">
                        <!-- <textarea placeholder="Hello, this is timeline webpages.^_^"></textarea> -->

                        <br>
                        <br>
                            <div style="text-align:center;">
                            <br>

                            <?php

                                    echo "<img src='$user_data[profile_image]' style= 'max-width:500px;'>";
                                
                                
                            ?>
                            
                            <br>
                            <br>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
                            &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
                            <input type="file" name="file" >
                            <br>
                            <br>
                            <input id="post_button" type="submit" style="width:120px;" value="Submit" >
                            </div>
                    </div>
                </form>
            </div>    
        </div>  
        <!--change cover image area-->
        <div id="change_cover_image" style="display:none;position:absolute;width:100%;height:100%;background-color:#000000aa;"> 
                <!--posts area-->
            <div style="max-width:600px;margin:auto;background-color: grey;flex: 2.5; padding: 20px; padding-right: 0px;">
                <form method = "post" action="profile.php?change=cover" enctype="multipart/form-data">
                    <div style="border:solid thin #aaa;padding:10px;background-color: navy;">
                        <!-- <textarea placeholder="Hello, this is timeline webpages.^_^"></textarea> -->

                        <br>
                        <br>
                            <div style="text-align:center;">
                            <br>

                            <?php
                                

                                    echo "<img src='$user_data[cover_image]' style= 'max-width:500px;'>";
                           
                                
                            ?>
                            
                            <br>
                            <br>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
                            &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
                            <input type="file" name="file" >
                            <br>
                            <br>
                            <input id="post_button" type="submit" style="width:120px;" value="Submit" >
                            </div>
                    </div>
                </form>
            </div>    
        </div>           
        
        <!--cover area-->  
        <div style="width:800px;margin:auto; min-height: 400px;">
            <div style="background-color:navy;text-align: center; color:bisque;margin-top: 20px;">
            <?php
                $image = "";
                if(file_exists($user_data['cover_image']))
                {
                    $image_cover = $image_class -> get_thumb_cover($user_data['cover_image']);
                    
                }
                else
                {
                    $image_cover = "cover.png";
                }
            ?>
                <img src="<?php echo $image_cover ?>" style="width:100%;">
                <span>
                    <?php

                       
                        $image = "images/Picture1.png";
                        if($user_data['gender'] == 'Female')
                        {
                            
                            $image = "images/Picture2.png";
                        }
                        elseif($user_data['gender'] == 'Secret')
                        {
                           
                            $image = "images/Picture3.png";
                        }
                        if(file_exists($user_data['profile_image']))
                        {
                            
                            
                            $image= $image_class-> get_thumb_profile($user_data['profile_image']);
                        }


                    ?>

                    <img id="profile_pic" src="<?php echo $image  ?>" >
                    
                    <?php
                        $mylikes = "";
                        if( $user_data['likes']>0)
                        {
                               $mylikes = " [" .$user_data['likes']." Follower(s)]";
                        }


                    ?>

                    
                    <br>
                    <a onclick="show_change_profile_image(event)" href="change_profile_image.php?change=cover" style="text-decoration:none;color:azure;font-size:11px;">Change Cover</a>|
                    <a onclick="show_change_cover_image(event)" href="change_profile_image.php?change=profile" style="text-decoration:none;color:azure;font-size:11px;">Change Profile Image</a>
                    <br>
                   
                    <a href="like.php?type=user&id=<?php echo $user_data['userid'] ?>" >
                        
                      <input id="post_button" type="submit" value="Follow <?php echo $mylikes?> " style="background-color:#cd3f3f;padding:2px;margin-right:10px;float:clear">
                    </a>
                    <br>

                    
                    
                </span>
                <br>

                <!-- <div style="font-size: 20px;">Dan Qi Huang </div> -->
                <div style="font-size: 28px;">
                    <a href="profile.php?id=<?php echo $user_data['userid']?>">
                    <?php echo $user_data['first_name']." ". $user_data['last_name']  ?> 
                    </a>
                </div>
                <br>

                <a href="index.php?id=<?php echo $user_data['userid']?>" style="color:peru;text-decoration:none"><div id="menu-buttons">Timeline</div></a>
                <a href="profile.php?section=about&id=<?php echo $user_data['userid']?>" style="text-decoration:none"><div id="menu-buttons">About </div> </a>
                <a href="profile.php?section=followers&id=<?php echo $user_data['userid']?>" style="text-decoration:none"><div id="menu-buttons">Followers</div> </a>
                <a href="profile.php?section=following&id=<?php echo $user_data['userid']?>" style="text-decoration:none"><div id="menu-buttons">Following</div> </a>
                <a href="profile.php?section=photos&id=<?php echo $user_data['userid']?>" style="text-decoration:none"><div id="menu-buttons">Photos</div>  </a>
                <?php
                    if($user_data['userid'] == $_SESSION['mybook_userid'])
                    {
                        echo '<a href="profile.php?section=settings&id='.$user_data['userid'].' style="text-decoration:none"><div id="menu-buttons">Settings</div>  </a>';
                    }
                    
                ?>
                <a href="profile.php?section=default&id=<?php echo $user_data['userid']?>" style="text-decoration:none"><div id="menu-buttons">Home</div> </a>
            </div>    
           <!--below cover area-->
           <?php
                $section = "default";
                if(isset($_GET['section']))
                {
                    $section =$_GET['section'];
                }
                if($section == "default")
                {
                    include("profile_content_default.php");
                }elseif($section == "photos")
                {
                    include("profile_content_photos.php");
                }elseif($section == "followers")
                {
                    include("profile_content_followers.php");
                }elseif($section == "following")
                {
                    include("profile_content_following.php");
                }elseif($section == "about")
                {
                    include("profile_content_about.php");
                }elseif($section == "settings")
                {
                    include("profile_content_settings.php");
                }

                
           ?>


        

        </div>
    </body>        

</html>
<script type ="text/javascript">
    function show_change_profile_image(event)
    {
        event.preventDefault();
        var profile_image =document.getElementById("change_profile_image");
        profile_image.style.display = "block";


    }

    function  hide_change_profile_image()
    {
        var profile_image =document.getElementById("change_profile_image");
        profile_image.style.display = "none";
    }

    function show_change_cover_image(event)
    {
        event.preventDefault();
        var cover_image =document.getElementById("change_cover_image");
        cover_image.style.display = "block";


    }

    function  hide_change_cover_image()
    {
        var cover_image =document.getElementById("change_cover_image");
        cover_image.style.display = "none";
    }

    window.onkeydown = function(key){
        if(key.keyCode==27)
        {
            //esc key was pressed
            hide_change_profile_image();
            hide_change_cover_image();
        }
    };

</script>  