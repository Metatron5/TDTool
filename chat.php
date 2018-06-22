<?php 
session_start(); 
include_once 'databaseconn.php';

echo $_SESSION['username'];
?>