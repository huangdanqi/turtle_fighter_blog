<?php
    session_start();
    
    include("classes/connect.php");
    include("classes/login.php");

    $email = "";
    $password="";
    

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $login = new Login();
        $result= $login -> evaluate($_POST);
        
        
        // print_r($result);
        if($result !='')
        {
            echo "<div style='text-align:center;font-size:28px;color:grey;background-color:#d2b48c;'>";
            echo "<br>The following errors occured:<br><br>";
            print_r($result);
            echo "</div>";
        }else
        {
            header("Location: profile.php");
            echo "hhh";
            die;
        }

        $email = $_POST['email'];
        $password=$_POST['password'];
        print_r($_POST);
        
        // echo "<pre>";
        // print_r($_POST);
        //echo "</pre>";


    }

    
?>
<html>
    <head>
        <title>Day_Dream | Log in</title>
        <link rel="icon" type="image/x-icon" href="sn.ico">
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
                <a href="signup.php" style="text-decoration:none;color:white;">
                &#127873; Sign up&#127873;
                </a>
            </div>
        <div id='bar2' >
            <form method= 'post' action="" >
                Log in to Turtle Blog<br><br>
                <input value="<?php echo $email?>"  name="email" type="text" id="text" placeholder="Email"><br><br>
                <input value="<?php echo $password?>"  name="password" type="password" id="text" placeholder="Password"><br><br>
                <input type="submit" id="button" value="Log in">
                <br>
                <br>
                <br>
            </form>

        </div>
        
    </body>

</html>