<?php

if(isset($_GET['change']) && ($_GET['change'] == "profile" || $_GET['change'] == "cover"))
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