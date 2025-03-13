<?php

class Signup
{
    private $error = "";

    public function evaluate($data)
    {
        foreach($data as $key => $value)
        {
            if(empty($value))
            {
                $this->error = $key ." is empty!<br>";
            }
            if($key == 'email')
            {
               
                if(!preg_match("/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/",$value))
                {
                    $this->error = $this->error ." Invalid email address!<br>";
                }
            }
            if($key == 'first_name')
            {
                if(is_numeric($value))
                {
                    $this->error = $this->error ."First name can not be a number!<br>";
                }
            }
            if($key == 'last_name')
            {
                if(is_numeric($value))
                {
                    $this->error = $this->error ." Last name can not be a number<br>";
                }
            }
        
        

        }

       
        

        if($data['password'] != $data['password2'])
        {            
            $this->error = $this->error ." Please retype password,password is not equal to password2 !<br>";
        }
        if($data['encrypt'] == 'Yes')
        {
            $data['password']=hash('sha1',$data['password']);
        }

         // check email is signuped or not
        $check_mail=$data['email'];
        $query ="select userid from users where email = '$check_mail' limit 1";
        $db = new Database();
        $result = $db->read($query);
        if($result)
        {

            $this->error = $this->error ."This email has been signed up, please use another one.<br>";
        }

     

        if($this->error == "")
        {

            $this->create_user($data);
        }else
        {
            return $this->error;
        }


    }

    public function create_user($data)
    {
        $first_name = ucfirst($data['first_name']);
        $last_name =  ucfirst($data['last_name']);
        $gender = $data['gender'];
        $email = $data['email'];
        $password = $data['password'];


        // create these      
        $url_address = strtolower($first_name). "." .strtolower($last_name);
        $userid = $this->create_userid();        
        
        
        $query = "insert into users (userid,first_name,last_name,gender,email,password,url_address) values ('$userid','$first_name','$last_name','$gender','$email','$password','$url_address')";
        
        // return $query;
        $DB = new Database();
        $DB-> save($query);


    }


    private function create_userid()
    {
        $length = rand(4,19);
        $number = "";
        for ($i = 0; $i<$length;$i++)
        {
            $new_rand= rand(0,9);
            $number = $number . $new_rand;
        }
        return $number;
    }
} 


?>