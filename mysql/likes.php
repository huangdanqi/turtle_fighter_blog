<?php
    
    include("classes/autoload.php");
    // include("classes/login.php");
    // include("classes/user.php");
    // include("classes/post.php");
    // include("classes/image.php");

    $login= new Login();
    $user_data = $login -> check_login($_SESSION['mybook_userid']);
    if (!empty($_GET))
    {
         $profile = new Profile();
         $profile_data = $profile -> get_profile($_GET['id']);
 
         if(is_array($profile_data))
         {
             $user_data = $profile_data[0];
         }
    };

    $Post = new Post();
    $likes = false;


    $ERROR ="";
    if(isset($_GET['id']) && isset(($_GET['type'])))
    {
        
        $likes = $Post-> get_likes($_GET['id'],$_GET['type']);



    }else{
        $ERROR="No information was found!";
    }

?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Day_Dream | People who like</title>
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
                /* margin-top: -200px; */
                border-radius: 50%;
                border:solid 2px black;
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
                /* min-height: 400px; */
                margin: 20px;
                color:chocolate;
                padding: 8px;
                text-align: center;
                font-size:20px

        
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
        <!-- <div id="blue_bar">
           <div style="width:800px;margin:auto;font-size: 30px;">
                <a href="index.php" style="text-decoration:none;color:bisque">Turtle_Blog</a> &nbsp &nbsp
                <input type="text" id="search_box" placeholder="Search for people">
                <img src="Picture1.png" style="width:50px;float: right;">

           </div>
        <div>   -->
            <br><br>
        <!--cover area-->  
        <div style="width:800px;margin:auto; min-height: 400px;">

 
           <!--below cover area-->
            <div style="display: flex;">

                <!--posts area-->
                <div style="background-color: grey;flex: 2.5; padding: 20px; padding-right: 0px;">
                    <div style="border:solid thin #aaa;padding:10px;background-color: white;color:navy">
                        
                        <h2>People who like</h2>
                        <?php

                            $User = new User();
                            $image_class=new Image();


                            if (is_array($likes))
                            {
                                foreach($likes as $row)
                                {
                                    $FRIEND_ROW =$User->get_user($row['userid']);
                                    include("user.php");
                                    // print_r($row);
                                }
                            }

                        ?>
                        <br style ="clear:both">

                        <br>
                    </div>
                <!--post-->
 


                        
                    </div>
                </div>
            </div>    

        </div>
    </body>        

</html>