<?php
include_once 'databaseconn.php';


$username = mysqli_real_escape_string($conn, $_POST['username']);
$password = mysqli_real_escape_string($conn, $_POST['pw']);
$name = mysqli_real_escape_string($conn, $_POST['name']);
$errorstring = '';

//Error handlers
//Leere Felder
if(empty($username) || empty($password) || empty($name)){
    if(empty($username)){
        $errorstring .= "Missing username \n";
    } 
    if(empty($password)){
        $errorstring .= "Missing password \n";
    } 
    if(empty($name)){
        $errorstring .= "Missing name";
    } 
    echo $errorstring;
}

else{
    //Check inputs
    /*if (!preg_match("/^[a-zA-Z0-9\.]*$", $username)){
        $errorstring .= "Only Letters or Numbers in Username \n";
        echo $errorstring;
        exit();
    }
    if (!preg_match("/^[a-zA-Z]*$", $name)){
        $errorstring .= "Only Letters or Numbers in Username \n";
        echo $errorstring;
        exit();
    }*/
    $sql = "SELECT * FROM user Where username = '$username'";
    $result = mysqli_query($conn, $sql);
    $resultcheck = mysqli_num_rows($result);

    if($resultcheck > 0){
        $errorstring .= "User taken";
        echo $errorstring;
        exit();
    }
    
    else{
        //Hashing the Password
        $hashedpwd = password_hash($password, PASSWORD_DEFAULT);
        //insert the User into Database
        $sql = "INSERT INTO user ('username', 'name', 'password') VALUES ($username, $name, $hashedpwd);";
        $result = $conn->query($sql);

        error_log($result);
        echo 'success';
        exit();
    }
}