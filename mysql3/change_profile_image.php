<?php
    session_start();
    // unset($_SESSION['turtle_fighter_userid']);
    include("classes/connect.php");
    include("classes/login.php");
    include("classes/user.php");
    include("classes/post.php");
    include("classes/image.php");
   

//$_SESSION['turtle_fighter_userid'];

    $login = new Login();
    $user_data =$login -> check_login($_SESSION['turtle_fighter_userid']);
    $log_user_data=$user_data ;

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {

        if(isset($_FILES['file']['name']) && $_FILES['file']['name']!="" )
        {
            // print_r($_FILES);
            // die;
            // print_r(explode(" ", $str));\


            $check = explode("/", $_FILES['file']['type']);
            if ($check[0] == 'image')
            {
                
                $allow_size = 1024 * 1024 * 28;
                if( $_FILES['file']['size'] < $allow_size)
                {
                    // everthing is fine
                    $folder = "uploads/". $user_data['userid'] . "/";

                    //create folder 
                    if(!file_exists($folder))
                    {
                        mkdir($folder,0777);

                    }
                    $image = New Image();

                    $filename =$folder. $image -> generate_filename(15).".png";
                    move_uploaded_file($_FILES['file']['tmp_name'],$filename);
                    
                    //check for mode;

                    if(isset($_POST['change']))
                    {
                        $change=$_POST['change'];
                    }
                    
                    if($change == 'Cover_image')
                    {
                        $image ->crop_image($filename,$filename,1500,600);
                    }else
                    {
                        $image ->crop_image($filename,$filename,800,800);
                    }
                    if(file_exists($filename))
                    {
                        $userid = $user_data['userid'];
                        $_POST['is_profile_image'] = 0;
                        $change = "Profile_image";
                        if(isset($_POST['change']))
                        {
                            $change=$_POST['change'];
                        }

                        if($change == 'Cover_image')
                        {
                            $query = "update users set cover_image = '$filename' where userid = $user_data[userid]";
                            $_POST['is_cover_image'] = 1;
                        }else
                        {

                            $query = "update users set profile_image = '$filename' where userid = $user_data[userid]";
                            $_POST['is_profile_image'] = 1;
                        }
                        
                        $DB = new Database();
                        $DB-> save($query);

                         //create a post
                        $post = new Post(); 
                        $_POST['is_profile_image'] = 1;

                        $post -> create_post($userid,$_POST,$filename);
                        header("Location: profile.php");
                    }
                }else
                {
                    echo "<div style='text-align:center;font-size:16px;color:navy;background-color:#d2b48c;'>";
                    echo "<br><span style='font-size:32px'>Oh,the following errors occured :<br>&#128034&#127877&#128034</span><br>";
                    echo "Only images of size 28Mb or lower are allowed !";
                    echo "</div>";   
                    
                }

                
                

            }else
            {
                echo "<div style='text-align:center;font-size:16px;color:navy;background-color:#d2b48c;'>";
                echo "<br><span style='font-size:32px'>Oh,the following errors occured :<br>&#128034&#127877&#128034</span><br>";
                echo "Only images of Jpeg type are allowed!";
                echo "</div>";   
                
            }

            

        }else
        {
            echo "<div style='text-align:center;font-size:16px;color:navy;background-color:#d2b48c;'>";
            echo "<br><span style='font-size:32px'>Oh,the following errors occured :<br>&#128034&#127877&#128034</span><br>";
            echo "Please add a valid image!";
            echo "</div>";   
        }

    }
    // print_r($user_data);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Day_Dream | Change Profile Image</title>
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
            #post_button{
                /* float: right; */
                background-color: peru;
                border: 2px solid navy;
                font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
                color:bisque;
                padding: 4px;
                font-size: 14px;
                border-radius: 2px;
                /* width:50px; */
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
            <?php include("header.php") ?>
        <div>  
            <br><br>
        <!--cover area-->  
        <div style="width:800px;margin:auto; min-height: 400px;">
 
           <!--below cover area-->
            <div style="display: flex;">
                <!--friends area-->

                <!--posts area-->
                <div style="background-color: grey;flex: 2.5; padding: 20px;">
                    <form method="post" enctype="multipart/form-data">
                        
                        <div style="border:solid thin #aaa;padding:10px;background-color: white;color:navy">
                            <fieldset>
                                <legend>Please select which image you want to. ^_^</legend>
                                <div>
                                <input type="radio" name="change" value="Profile_image" />
                                <label >Profile_image</label>

                                <input type="radio"  name="change" value="Cover_image" />
                                <label >Cover_image</label>


                                </div>
                                <br>
                                <div>
                                <input type="file" name="file" style="color:black;">

                                    <br>
                                    <br>
                                    <input id="post_button" type="submit" value="Change">
                                    <br>
                                    <br>
                                </div>
                            </fieldset>        
                            

                        </div>
                    </form>    
                <!--post-->
 

                </div>
            </div>    

        </div>
    </body>        

</html>