<?php

    class Signup
    {
        private $error = "";



        public function evaluate($data)
        {
            foreach ( $data as $key => $value){
                # code ...
                if(empty($value))
                {
                    $this->error =$this->error. $key ." is empty!<br>";
                }
                if($key == "email")
                {
                    if(!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$value)){
                        $this->error = $this->error . "invalid email address!<br>";
                    }
                    $query = "select * from users where email ='$value' limit 1";


                    $DB = new Database();
                    $result = $DB->read($query);
                    #echo
                    #print_r($result); 
                    
        
                    if($result)
                    {
                        $this->error = $this->error . "This email account is already registered, please use a different email account!";
                    }
                      

                }
                if($key == "first_name")
                {
                    if(is_numeric($value) )
                    {
                      $this->error=$this->error."first name can not be a number<br>";
                    }

                }
                if($key == "last_name")
                {
                    if(is_numeric($value))
                    {
                        $this->error=$this->error."last_name can not be a number<br>";
                    }
                    if(strstr($value," "))
                    {
                      $this->error = $this->error. "Last name can not have spaces<br>";
                    }

                }
                if($key == "password")
                {
                    $verify=$data["password2"];
                    if( $value != $verify)
                    {
                        echo "Please retype password2, it doesn't equal to password.";
                    }
                }

            }

            if($this->error == "")
            {
                //no error
                
                $this->create_user($data);
            }else
            {
                return $this->error;
            }
        }
        public function create_user($data)
        {
            $first_name = ucfirst($data['first_name']);
            $last_name =ucfirst($data['last_name']) ;
            $gender = $data['gender'];
            $email = $data['email'];
            $password = $data['password'];

            
            $email = addslashes($data['email']);
            $password =addslashes( $data['password']);


         
            $query = "select * from users where email ='$email' limit 1";


            $DB = new Database();
            $result = $DB->read($query);
            #echo
            #print_r($result); 
            


            


            // create these 
                $url_address = strtolower($first_name) . '.'. strtolower($last_name);
                $userid= $this->create_userid();
                
            
                $query = "insert into users 
                (userid,first_name,last_name,gender,email,password,url_address) 
                values 
                ('$userid','$first_name','$last_name','$gender','$email','$password','$url_address')";


                $DB = new Database();
                $DB->save($query);
                return $query;

        }

        // private function create_url(){

        // }

        private function create_userid(){
            $length = rand(4,19);
            $number = "";
            for($i=0;$i<$length;$i++){
                #code....
                $new_rand = rand(0,9);
                $number = $number . $new_rand;
            
            }
            return $number;
        }
    }
?>