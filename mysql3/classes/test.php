
<?php


class Database
{
    private $host = "localhost";
    private $username = "root";
    private $password ="";
    private $db = "turtle_fighter";
    
    function connect()
    {
        $connection = mysqli_connect($this->host,$this->username,$this->password,$this->db);
        return $connection;
    }

    function read($query)
    {
        $conn = $this->connect();
        $result = mysqli_query($conn,$query);
        if(!$result)
        {
            return false;
        }else
        {
           $data=false;
            while($row = mysqli_fetch_assoc($result))
           {
                $data[] = $row;
               
           }

                return $data;
        }



    }

    function save($query)
    {
        $conn = $this->connect();
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



class Database_2
{
    private $host = "localhost";
    private $username = "root";
    private $password ="";
    private $db = "mybook_db";
    
    function connect()
    {
        $connection = mysqli_connect($this->host,$this->username,$this->password,$this->db);
        return $connection;
    }

    function read($query)
    {
        $conn = $this->connect();
        $result = mysqli_query($conn ,$query);
        print_r($result);
        $data=false;
        while($row = mysqli_fetch_assoc($result))
        {
            $data[]=$row;
            print_r($row);
        }
        echo "data<br>";
        print_r($data);
       
    }

}

$db = new Database_2();
$query = "SELECT * FROM users";
$result =$db->read($query);
print_r($result);
$error = mysqli_connect_error();
echo 'ddd';
print_r($error);
##47
?>