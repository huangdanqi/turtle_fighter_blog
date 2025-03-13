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
                        #code...
                    //    $user = new User();
                        #echo "hellow";
                        
                    //    $ROW_USER = $user -> get_user($ROW['userid']);
                        #print_r($ROW_USER);
                        include("user.php");

                    }

                }

                
            ?>
            <!-- <div id="friends">
                <img id="friends_img" src="Picture2.png">
                <br>
                First User
            
            </div> -->
            <!-- <div id="friends">
                <img id="friends_img" src="Picture3.png">
                <br>
                Second User
            
            </div>
            <div id="friends">
                <img id="friends_img" src="Picture4.png">
                <br>
                Third User
            
            </div>    
            <div id="friends">
                <img id="friends_img" src="Picture4.png">
                <br>
                Forth User
            
            </div>                        -->
        </div>
    </div>
    <!--posts area-->
    <div style="background-color: grey;min-height: 400px;flex: 2.5; padding: 20px; padding-right: 0px;">
        <div style="border:solid thin #aaa;padding:10px;background-color: white;">
            <form method="post" enctype="multipart/form-data">

                <textarea name="post" placeholder="Hello,write something *_^, happy,bad,angry,sad,all of it! You are a human, you have all of the emotions! No just happiness!^_*"></textarea>
                <input type="file" name="file" style="color:black">
                <input id="post_button" type="submit" value="Post">
                <br>
                <br>
            </form>
        </div>
    <!--post-->
        <div id="post_bar">

            <?php 

                
                if($posts)
                {
                    foreach($posts as $ROW)
                    {
                        #code...
                        $user = new User();
                        #echo "hellow";
                        
                        $ROW_USER = $user -> get_user($ROW['userid']);
                        #print_r($ROW_USER);
                        include("post.php");

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
           
           
            if( isset($pg['prev_page']))
            {
                echo '<input id="post_button" type="button" value="Prev Page" style="float:left;width:150px">';
            }  
                
            ?>
            </a>
            <!--post 1-->
            <!-- <div id="post">
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
            <hr> -->
                <!--post 2-->
                <!-- <div id="post">
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
            <hr>                   -->
                <!--post 3-->
                <!-- <div id="post">
                <div>
                    <img src="Picture4.png" style="width: 75px;margin-right: 4px;">

                </div>
                <div>
                    <div style="font-weight: bold;color: chocolate;font-size: 16px;"> Third Guy</div>
                    I find that I have the life I want, but the life is not endless, I don't know how to deal with it,I like my life now, but tomorrow will come, as a person, I will worry about it, oh my god!Sometimes I want to end up, it is not because how bad the life is, it is because how good my life is. Sometimes I can not 
                    control myself body movement when I am pushed to do something what I do not want to do.[October 4 2024]
                    <br>
                    <br>
                    <a href="#">like</a> . <a href="#">Comment</a> . <span style="color:coral">February 28 2028</span>
                </div>    

            </div>    
            <hr>  -->


            
        </div>
    </div>
</div>    