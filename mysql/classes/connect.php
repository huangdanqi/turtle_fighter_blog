<?php

class Database
{
    private $host =  "localhost";
    private $username = "root";
    private $password = "";
    private $db ="mybook_db";

    
    function connect(){
        $connection = mysqli_connect($this->host,$this->username,$this->password,$this->db);
        return $connection;
        
    }

    function read($query){
        $conn = $this->connect();
        $result = mysqli_query($conn,$query);
        if(!$result)
        {
         return false;
        }else
        {
            $data = false;   
            while($row = mysqli_fetch_assoc($result))
            {
                $data[] = $row;
                // echo "<pre>";
                // print_r($row);
                // echo "</pre>";
            
            }
            return $data;
            

        }

    }
    function save($query){
        $conn =$this->connect();
        $result = mysqli_query($conn,$query);
        if(!$result)
        {
         return false;
        }else
        {
         return true;

        }
        
    }
    function write($query){
        $conn =$this->connect();
        $result = mysqli_query($conn,$query);
        if(!$result)
        {
         return false;
        }else
        {
         return true;

        }
        
    }


}

// $DB = new Database();
// $query = "select * from users";
// $data =$DB->read($query);

// echo "<pre>";
// print_r($data);
// echo "</pre>";






// $first_name= 'eathorne';
// $last_name ='choongo';
#$query = "insert into users (first_name,last_name) values ('$first_name','$last_name')";
#echo $query;

#mysqli_query($connection,$query);

// $query = "select * from users ";

// $result =mysqli_query($connection,$query);

// while($row = mysqli_fetch_assoc($result))
// {
//     echo "<pre>";
//     print_r($row);
//     echo "</pre>";

// }



// echo mysqli_error($connection);


?>