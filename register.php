<?php
include_once 'databaseconn.php';

$username = mysqli_real_escape_string($conn, $_POST['username']);
$password = mysqli_real_escape_string($conn, $_POST['pw']);
$firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
$lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
$msg = '';

// Error handlers
// Leere Felder
if (empty($username) || empty($password) || empty($firstname)|| empty($lastname)) {
	if (empty($username)) {
		$msg .= "Missing username \n";
    }
    
    if (empty($password)) {
    	$msg .= "Missing password \n";
    }
    
    if (empty($firstname)) {
    	$msg .= "Missing firstname";
    }
    
    if (empty($lastname)) {
    	$msg .= "Missing lastname";
    }
} else {
    // Check inputs
    if (!preg_match("/^[a-zA-Z0-9\.\-\_]+$/", $username)) {
        $msg .= "Only letters or numbers in username \n";
        echo $msg;
        exit();
    }
    
    if (!preg_match("/^[a-zA-Z]+$/", $firstname)) {
        $msg .= "Only letters or numbers in firstname \n";
        echo $msg;
        exit();
    }
    
    if (!preg_match("/^[a-zA-Z]+$/", $lastname)) {
        $msg .= "Only letters or numbers in lastname \n";
        echo $msg;
        exit();
    }
    
    //Check if Username is avaiable
    $sql = "SELECT *
			FROM user
			WHERE username = '" . $username . "'";
    
    $result = mysqli_query($conn, $sql);
    $resultcheck = mysqli_num_rows($result);

    if ($resultcheck > 0) {
    	$msg .= "User taken";
    } else {
        // Hash the password
        $hashedpwd = password_hash($password, PASSWORD_DEFAULT);

        // Insert user into database
        $sql = "INSERT INTO user (username, firstname, lastname, password) VALUES (?, ?, ?, ?);";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $username, $firstname, $lastname, $hashedpwd);

        
        if ($stmt->execute() === true) {
        	$msg = 'success';
        } else {
        	$msg = 'failed';
        	error_log('Error: ' . $sql . "\n" . $conn->error);
        }
    }
}

die($msg);

