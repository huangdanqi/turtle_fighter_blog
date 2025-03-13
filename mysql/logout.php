<?php
session_start();
if(isset($_SESSION['mybook_userid']))
    $_SEESSION['mybook_userid']= NULL;
    unset($_SESSION['mybook_userid']);
    header("Location: login.php");
    die;
?>