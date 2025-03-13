<!--post 1-->
<div id="post">
    <div>
        <?php
          $post_image = "Picture1.png";
          if(file_exists($ROW_USER['profile_image'] ))
            {
                $post_image = $ROW_USER['profile_image'];
            }
        ?>
       
        <img src="<?php  echo  $post_image; ?>" style="width: 75px;margin-right: 4px;border-radius:50%;border:solid 3px bisque">

    </div>
    <div style = "width:100%">
        <div style="font-weight: bold;color: chocolate;font-size: 16px">
             <?php 
             echo "<span style=color:DarkTurquoise>".htmlspecialchars($ROW_USER['first_name']).' '.htmlspecialchars($ROW_USER['last_name'])."</span>"; 
             
             if($ROW['is_profile_image'])
             {
                $pronoun = $ROW_USER['first_name'].' '.$ROW_USER['last_name'];

                echo "<br><span> update $pronoun's profile image</span>";
             }
             if($ROW['is_cover_image'])
             {
                $pronoun = $ROW_USER['first_name'].' '.$ROW_USER['last_name'];

                echo "<br><span> update $pronoun's cover image</span>";
             }            

             ?>
             <br>
           
              <?php echo $ROW['post'] ?>
        </div>
        <br>

        <?php 
            if(file_exists($ROW['image']))
            {
                $post_image=$ROW['image'];
                echo "<img src = '$post_image' style= 'width:50%;'/>";
            }
        ?>
        <br>
        <br>




    </div>    

</div>
