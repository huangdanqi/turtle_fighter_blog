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
    //posting starts here 
    if($_SERVER['REQUEST_METHOD'] == "POST")
    {


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
                header("Location: single_post.php?id=$_GET[id]");
                die;
            }


        




    }
    $Post = new Post();
    $ROW = false;


    $ERROR ="";
    if(isset($_GET['id']) )
    {
        
        $ROW = $Post-> get_one_posts($_GET['id']);
       




    }else{
        $ERROR="No post was found!";
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


                            if (is_array($ROW))
                            {
                                
                                $ROW_USER = $User-> get_user($ROW['userid']);
                                include('post.php');
                            }

                        ?>
                        <br style ="clear:both">
                            <div style="border:solid thin #aaa;padding:10px;background-color: white;">
                                <form method="post" enctype="multipart/form-data">

                                    <textarea name="post" placeholder="Hello,write something *_^, happy,bad,angry,sad,all of it! You are a human, you have all of the emotions! No just happiness!^_*"></textarea>
                                    <input type="hidden" name="parent" value="<?php echo $ROW['postid'] ?>" style="color:black">
                                    <input type="file" name="file" style="color:black">
                                    <input id="post_button" type="submit" value="Post">
                                    <br>
                                    <br>
                                </form>
                            </div>
                            <?php 
                                
                                $comments =$Post -> get_comments($ROW['postid']);

                                if(is_array($comments))
                                {
                                    foreach ($comments as $COMMENT)
                                    {
                                        $ROW_USER = $User -> get_user($ROW['userid']);
                                        include("comment.php");
                                    }
                                }
                            // get current url
                            $pg = pagination_link();                                
                            
                            ?>

                            <a href="<?php echo $pg['next_page'] ?>"> 
                            <input id="post_button" type="button" value="Next Page" style="float:right;width:150px">
                            </a>
                            <a href="<?php echo $pg['prev_page'] ?>"> 
                            <?php  
                            if($page_number>1)
                            {
                                echo '<input id="post_button" type="button" value="Prev Page" style="float:left;width:150px">';
                            }                           
                            ?>


                        <br>
                    </div>
                <!--post-->
 


                        
                    </div>
                </div>
            </div>    

        </div>
    </body>        

</html>