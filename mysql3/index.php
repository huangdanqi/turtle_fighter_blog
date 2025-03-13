<?php
    
    // unset($_SESSION['turtle_fighter_userid']);
    include("classes/autoload.php");

   

//$_SESSION['turtle_fighter_userid'];

    $login = new Login();
    $user_data =$login -> check_login($_SESSION['turtle_fighter_userid']);
    $log_user_data =$user_data;
    // print_r($user_data);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Day_Dream | timeline</title>
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
                <!--friends area-->
                <div style="background-color: green;flex:1;">
                    <div id="friends_bar">
                        <img src="Picture1.png" id="profile_pic">
                        <br>
                        <?php echo $user_data['first_name']."<br> ".$user_data['last_name'] ?>
                    </div>
                </div>
                <!--posts area-->
                <div style="background-color: grey;flex: 2.5; padding: 20px; padding-right: 0px;">
                    <div style="border:solid thin #aaa;padding:10px;background-color: white;">
                        <textarea placeholder="Hello, this is timeline webpages.^_^"></textarea>
                        <input id="post_button" type="submit" value="Post">
                        <br>
                        <br>
                    </div>
                <!--post-->
                    <div id="post_bar">
                        <!--post 1-->
                        <div id="post">
                            <div>
                                <img src="Picture2.png" style="width: 75px;margin-right: 4px;">

                            </div>
                            <div>
                                <div style="font-weight: bold;color: chocolate;font-size: 16px;"> First Guy</div>
                                What is Lorem Ipsum? <br>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.https://www.lipsum.com/
                                <br>
                                <br>
                                <a href="#">like</a> . <a href="#">Comment</a> . <span style="color:coral">February 28 2028</span>
                            </div>    

                        </div>
                        <hr>
                         <!--post 2-->
                         <div id="post">
                            <div>
                                <img src="Picture3.png" style="width: 75px;margin-right: 4px;">

                            </div>
                            <div>
                                <div style="font-weight: bold;color: chocolate;font-size: 16px;"> Second Guy</div>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc venenatis magna dolor, sed lacinia ante molestie id. Suspendisse potenti. Proin ut nibh bibendum, vulputate mauris at, rhoncus est. Sed purus tellus, mollis id eros et, vehicula commodo odio. Pellentesque luctus vestibulum mattis. Praesent a ante id libero tristique suscipit. Donec vitae ex dui. Maecenas convallis fringilla turpis sit amet iaculis. Curabitur tortor diam, fringilla eget maximus in, tristique mollis velit. Etiam mollis lectus euismod commodo porttitor. Etiam varius sapien vel nisl ultrices, et molestie neque imperdiet. In vitae consequat nisl, ac sodales neque. Vivamus quis fermentum felis, sit amet ornare lectus.
                                <br>
                                <br>
                                <a href="#">like</a> . <a href="#">Comment</a> . <span style="color:coral">February 28 2028</span>
                            </div>    

                        </div>     
                        <hr>                  
                         <!--post 3-->
                         <div id="post">
                            <div>
                                <img src="Picture4.png" style="width: 75px;margin-right: 4px;">

                            </div>
                            <div>
                                <div style="font-weight: bold;color: chocolate;font-size: 16px;"> Third Guy</div>
                                Praesent sed nunc a leo hendrerit auctor ac eu est. Nam in vulputate enim. Morbi semper egestas enim, nec consectetur elit aliquam in. Donec consectetur, lectus vel egestas ultrices, dolor odio cursus nunc, eu laoreet nibh tellus euismod lectus. Fusce sagittis placerat quam. Praesent laoreet efficitur pellentesque. Donec eget lobortis arcu. Integer imperdiet magna non diam cursus, vitae consequat erat tristique. Nam pellentesque tellus ut est feugiat, a vehicula mauris semper. Curabitur id tellus at eros maximus blandit.
                                <br>
                                <br>
                                <a href="#">like</a> . <a href="#">Comment</a> . <span style="color:coral">February 28 2028</span>
                            </div>    

                        </div>    
                        <hr> 


                        
                    </div>
                </div>
            </div>    

        </div>
    </body>        

</html>