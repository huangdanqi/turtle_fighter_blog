<?php
    class Login
    {
        private $error="";
        public function evaluate($data)
        {

            $email = addslashes($data['email']);
            $password =addslashes( $data['password']);


         
            $query = "select * from users where email ='$email' limit 1";


            $DB = new Database();
            $result = $DB->read($query);
            #echo
            #print_r($result); 
            

            if($result)
            {
                $row=$result[0];
                if($password == $row['password'])
                {
                    //create a session data
                    $_SESSION['mybook_userid'] =$row['userid'];

                }else
                {
                    $this->error .= "wrong password<br>";
                   
                }
            }else
            {
                $this->error .= "No such email was found<br>";
            }
            
            return $this->error;
            
        }  
        
        public function check_login($id)
        {
            if( is_numeric($id))
            {
                $query = "select * from users where userid = '$id' limit 1";
                $DB = new Database();
                $result =$DB->read($query);
                if($result)
                {
                    $user_data = $result[0];
                    return $user_data;
                }else
                {
                    header("Location:login.php");
                    die;
                }

            }
            else
            {
                header("Location:login.php");
                die;
            }
        

        }       

    }
?>