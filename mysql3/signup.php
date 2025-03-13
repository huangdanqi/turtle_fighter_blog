<?php
    include("classes/connect.php");
    include("classes/signup.php");

    $first_name = "";
    $last_name =  "";
    $gender = "";
    $email = "";
    $encrypt = "";


    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $signup = new Signup();
        $result = $signup -> evaluate($_POST);
        if($result !='')
        {
            echo "<div style='text-align:center;font-size:16px;color:navy;background-color:#d2b48c;'>";
            echo "<br><span style='font-size:32px'>Oh,the following errors occured :<br>&#128034&#127877&#128034</span><br>";
            echo $result;
            echo "</div>";
        }else
        {
            header("Location: login.php");
            die;
        }
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $gender = $_POST['gender'];
        $email = $_POST['email'];
        $encrypt = $_POST['encrypt'];

    }

?>



<html>
    <head>
        <title>Day_Dream | Sign up</title>
        <link rel="icon" href="s.ico" type="image/x-icon">
    </head>
    <style>
        #bar
        {
            height:100px;
            background-color: #800020;
            color:bisque;
            border-radius: 4px;
            padding: 4px;
        }

        #signup_button
        {
            background-color:chocolate;
            /* width: 70px; */
            text-align: center;
            padding: 4px;
            float: right;
        }
        #bar2{
            background-color: #800020;
            width: 800px;
            /* height: 400px; */
            margin: auto;
            margin-top:130px;
            padding: 10px;
            padding-top: 50px;
            text-align: center;
            font-weight: bold;
            font-size: 20px;

        }
        #text{
            height: 40px;
            width:300px;
            border-radius: 4px;
            border:solid 1px #ccc;
            font-size: 14px;
        }
        #button{
            width: 300px;
            height: 40px;
            border-radius: 4px;
            font-weight:bold;
            border: none;
            background-color: bisque;
        }
    </style>

    <body style="font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;background-color: peru;">
        
        <div id="bar">
            <div style="font-size: 40px;" >
                Turtle Blog
            </div>

            <div id="signup_button" >
                <a href="login.php" style="text-decoration:none;color:#fefefa">
                &#128035; Log in &#128035;
                </a>
            </div>
        <div id='bar2' >
            Sign up to Turtle Blog<br><br>
            <form method="post" action="">
                <input value="<?php echo $first_name ?>"name="first_name" type="text" id="text" placeholder="First name"><br><br>
                <input value="<?php echo $last_name ?>" name="last_name" type="text" id="text" placeholder="Last name"><br><br>
                <span style="font-weight: normal;"> Gender:</span><br>
                <select  id="text" name="gender">
                    <option><?php echo $gender?></option>
                    <option>Secret</option>
                    <option>Male</option>
                    <option>Female</option>
                    
                </select>    
                <br><br>
                <input  value="<?php echo $email ?>" name="email" type="text" id="text" placeholder="Email"><br><br>
                <input  name="password" type="password" id="text" placeholder="Password"><br><br>
                <input  name="password2" type="password" id="text" placeholder="Retype Password"><br><br>
                <span style="font-size:12px;font-weight: normal;"> Whether the password is encrypted or not, 
                    <br>that is, whether the password is visible to the database administrator.^_^</span>
                <br>
                <br>
                <select  id="text" name="encrypt">
                    <option><?php echo $encrypt?></option>
                    <option>Yes</option>
                    <option>No</option>
                    
                    
                </select>  
                <br>
                <br>
                <input  name="submit"  type="submit" id="button" value="Sign up">
                <br>
                <br>
                <br>
            </form>
        </div>
        
    </body>

</html>