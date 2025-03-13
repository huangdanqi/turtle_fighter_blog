<?php
    session_start();
    
    unset($_SESSION['turtle_fighter_userid']);
    // echo $_SESSION['turtle_fighter_userid'];
    header('Location: login.php');
    die;
?>