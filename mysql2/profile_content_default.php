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
        </div>
    </div>
</div>    