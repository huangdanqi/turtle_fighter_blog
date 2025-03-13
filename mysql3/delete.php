<?php
    // session_start();
    // unset($_SESSION['turtle_fighter_userid']);
    include("classes/autoload.php");

   

//$_SESSION['turtle_fighter_userid'];

    $login = new Login();
    $user_data =$login -> check_login($_SESSION['turtle_fighter_userid']);
    // print_r($user_data);
    $ERROR = "";
    if(isset($_GET['id']))
    {
        $postid = $_GET['id'];
        $Post = new Post();
        $ROW = $Post -> get_one_post($postid);
        if(!$ROW)
        {
            $ERROR = "No such post was found!";
        }




    }else
    {
        $ERROR = "No such post was found!";
    }
    if(isset($_POST['postid']))
    {      
        // print_r($_POST['postid']);
        $postid = $_POST['postid'];
        $Post = new Post();
        $result = $Post -> delete_post($postid);
       
        if($result)
        {
            header("Location:profile.php"); 
        }


    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Day_Dream | Delete</title>
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
        <div id="blue_bar">
            <?php
                include("header.php");
            ?>
        <div>  
            <br><br>
        <!--cover area-->  
        <div style="width:800px;margin:auto; min-height: 400px;">
 
           <!--below cover area-->
            <div style="display: flex;">

                <!--posts area-->
                <div style="background-color: grey;flex: 2.5; padding: 20px; ">
                    <div style="border:solid thin #aaa;padding:10px;background-color: white;">
                        
                        <h2 style="color:navy">Delete Post</h2><br>
                        <form method = "post">
                            <span style="color:black;">Are you sure you want to delete this post?<span><br>
                            <hr>
                                <?php
                                    $user = new User();
                                    $ROW_USER = $user -> get_user($ROW['userid']);
                                    include("post_delete.php");
                                ?>
                            
                            <input id="post_button" type="hidden" name="postid" value="<?php echo $ROW['postid']?>">
                            <input id="post_button" type="submit" value="Delete">
                            <br>
                        </form>
                        
                    </div>

                </div>
            </div>    

        </div>
    </body>        

</html>