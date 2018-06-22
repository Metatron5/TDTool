<?php
include_once 'databaseconn.php';
session_start();

$username = mysqli_real_escape_string($conn, $_POST['username']);
$password = mysqli_real_escape_string($conn, $_POST['pw']);
$msg = "";

//Check if empty
if(empty($username) || empty($password)){
    if (empty($username)) {
		$msg .= "Missing username \n";
    }
    
    if (empty($password)) {
    	$msg .= "Missing password \n";
    }
    echo $msg;
}

else{
    //Check if Username exists
    $sql = "SELECT *
			FROM user
			WHERE username = '" . $username . "'";
    
    $result = mysqli_query($conn, $sql);
    $resultcheck = mysqli_num_rows($result);

    if ($resultcheck == 0) {
        $msg .= "no User found";
        echo $msg;
        exit();
    } 
    else {
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);

        if(password_verify($password, $row["password"])){
            $_SESSION['username'] = $row["username"];
            echo 'true';
            exit();
        }
        else{
            $msg .= "Password incorrect";
            echo $msg;
            exit();
        }
    }
}