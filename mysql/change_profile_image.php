<?php
    session_start();
    include("classes/connect.php");
    include("classes/login.php");
    include("classes/user.php");
    include("classes/post.php");
    include("classes/image.php");

    $login= new Login();
    $user_data = $login -> check_login($_SESSION['mybook_userid']);

    // echo "<pre>";
    // print_r($_GET);
    // echo "</pre>";
    //posting starts here 
    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
       
        if(isset($_FILES['file']['name']) && $_FILES['file']['name'] !="")
        {
            // echo "<pre>";
            // print_r($_FILES);
            // echo "</pre>;";

            // die;
            
            $type = explode("/", $_FILES['file']['type'])[0];
            // print_r( $type);
            if($type == 'image')
            {
                $allowed_size = (1024 * 1024) *5;
                if($_FILES['file']['size'] < $allowed_size)
                {
                    //everything is fine
                    $folder = "uploads/" . $user_data['userid'] . "/";
                    //create folder
                    if(!file_exists($folder))
                    {
                        mkdir($folder,0777,true);
                        
                    }
                    $image = new Image();
                    $filename = $folder. $image->generate_filename(8).".png";
                    move_uploaded_file($_FILES['file']['tmp_name'],$filename);
                    // check for mode
                    if(isset($_GET['change']))
                    {
                        $change=$_GET['change'];
                    }
                    
                    // echo $change;
                    if($change == "cover")
                    {
                        if(file_exists($user_data['cover_image']))
                        {

                            unlink($user_data['cover_image']);
                        }
                        $image -> resize_image($filename,$filename,1500,1500);
                        // 1500,600
                    }else
                    {
                        if(file_exists($user_data['profile_image']))
                        {

                            unlink($user_data['profile_image']);
                        }
                        // 800,800
                        $image -> resize_image($filename,$filename,1500,1500);
                    }
    
                    

                    if(file_exists($filename))
                    {
                        $userid= $user_data["userid"];
                       
                        $change="profile";
                        $change=$_GET['change'];

                        if($change == "cover")
                        {
                            $query = "update users set cover_image = '$filename' where userid ='$userid' limit 1 ";
                            $_POST['is_cover_image']= 1;
                        }else
                        {

                            $query = "update users set profile_image = '$filename' where userid ='$userid' limit 1 ";
                            $_POST['is_profile_image']= 1;
                        }

                        

                        $DB = new Database();
                        $DB -> save($query);

                        //create a post
                        $post = new Post();
                        // $id = $_SESSION['mybook_userid'];
                        
                        $post -> create_post($userid,$_POST,$filename);


                        header(("Location: profile.php"));
                        die;
        
                    }
                    

                }else
                {
                    echo "<div style='text-align:center;font-size:12px;color:white;background-color:grey;'>";
                    echo "<br>The following errors occured:<br><br>";
                    echo "Only images of size 5Mb or lower are allowed!";
                    echo "</div>";   
                }

            }
            else
            {
                echo "<div style='text-align:center;font-size:12px;color:white;background-color:grey;'>";
                echo "<br>The following errors occured:<br><br>";
                echo "Only images are allowed !";
                echo "</div>";                
            }


        }else
        {
            echo "<div style='text-align:center;font-size:12px;color:white;background-color:grey;'>";
            echo "<br>The following errors occured:<br><br>";
            echo "please add a valid image!";
            echo "</div>";
        }
       

    }
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Day_Dream | Change Profile Image</title>
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

            textarea{
                width:98%;
                border:dashed 2px black;
                font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
                font-size: 14px;
                height: 60px;
            }
            #post_button{
                /* float: right; */
                background-color: peru;
                border: none;
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
                <!--friends area-->
                <!-- <div style="background-color: green;flex:1;">
                    <div id="friends_bar">
                        <img src="Picture1.png" id="profile_pic">
                        <br>
                        <a href="profile.php" style="color:chocolate;" >
                            <?php echo $user_data['first_name']." ".$user_data['last_name'];?>
                        </a>


                    </div>
                </div> -->
                <!--posts area-->
                <div style="background-color: grey;flex: 2.5; padding: 20px; padding-right: 0px;">
                    <form method = "post" enctype="multipart/form-data">
                        <div style="border:solid thin #aaa;padding:10px;background-color: navy;">
                            <!-- <textarea placeholder="Hello, this is timeline webpages.^_^"></textarea> -->

                            <br>
                            <br>
                                <div style="text-align:center;">
                                <br>

                                <?php
                                    $chagne = 'profile';
                                    //check for mode
                                    if(isset($_GET['change']) && $_GET['change'] == "cover")
                                    {
                                        $change="cover";
                                        echo "<img src='$user_data[cover_image]' style= 'max-width:500px;'>";
                                    }else
                                    {
                                        echo "<img src='$user_data[profile_image]' style= 'max-width:500px;'>";
                                    }
                                    
                                ?>
                                
                                <br>
                                <br>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
                                &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
                                <input type="file" name="file" >
                                <br>
                                <br>
                                <input id="post_button" type="submit" value="Submit" >
                                </div>
                        </div>
                    </form>
                </div>    
                <!--post-->



                        
                    
                </div>
            </div>    

        </div>
    </body>        

</html>