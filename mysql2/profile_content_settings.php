<div style="min-height:400px;width:100%;background-color:OliveDrab;text-align:center;">
    <div style="padding:20px;max-width:350px;display:inline-block;">
    <form method = "post" enctype="multipart/form-data">
<?php
    $settings_class = new Settings();

    $settings = $settings_class -> get_settings($_SESSION['mybook_userid']);

    if(is_array($settings))
    {
        echo "<input type='text' id='textbox'  value='".htmlspecialchars($settings['first_name'])."' name='first_name' placeholder = 'First Name'/>";
        echo "<input type='text' id='textbox'  value='".htmlspecialchars($settings['last_name'])."' name='last_name' placeholder = 'Last Name'/>";
        echo "<select type='text' id='textbox' value='".htmlspecialchars($settings['gender'])."' name='email' style='height:30px;width:100%' >
                
                <option>$settings[gender]</option>
                <option>Secret</option>
                <option>Male</option>
                <option>Female</option>
    
     
                </select>";
        echo "<input type='text' id='textbox'  value='".htmlspecialchars($settings['email'])."' name='email' placeholder = 'Email'/>";
        echo "<input type='password' id='textbox' value='".htmlspecialchars($settings['password'])."' name='password' placeholder = 'Password' />";
        echo "<input type='password' id='textbox' value='".htmlspecialchars($settings['password'])."' name='password2' placeholder = 'Password' />";
        echo "About me:<br>
                <textarea id='textbox' style='height:200px;' name='about'>".htmlspecialchars($settings['about'])."</textarea>";
        echo '<input id="post_button" type = "submit" value="Save">';


    }


?>
    </from>
    </div>
</div>