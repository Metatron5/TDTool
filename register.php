<?php
include_once 'databaseconn.php';

$username = mysqli_real_escape_string($conn, $_POST['username']);
$password = mysqli_real_escape_string($conn, $_POST['pw']);
$name = mysqli_real_escape_string($conn, $_POST['name']);
$msg = '';

// Error handlers
// Leere Felder
if (empty($username) || empty($password) || empty($name)) {
	if (empty($username)) {
		$msg .= "Missing username \n";
    }
    
    if (empty($password)) {
    	$msg .= "Missing password \n";
    }
    
    if (empty($name)) {
    	$msg .= "Missing name";
    }
} else {
    // Check inputs
    /*
    if (!preg_match("/^[a-zA-Z0-9\.]*$", $username)) {
        $msg .= "Only letters or numbers in username \n";
        echo $msg;
        exit();
    }
    
    if (!preg_match("/^[a-zA-Z]*$", $name)) {
        $msg .= "Only letters or numbers in username \n";
        echo $msg;
        exit();
    }
    */
	
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
        $sql = "INSERT INTO user (username, name, password) VALUES (?, ?, ?);";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $username, $name, $password);

        
        if ($stmt->execute() === true) {
        	$msg = 'success';
        } else {
        	$msg = 'failed';
        	error_log('Error: ' . $sql . "\n" . $conn->error);
        }
    }
}

die($msg);

