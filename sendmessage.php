<?php
session_start();

include_once 'databaseconn.php';

$message = mysqli_real_escape_string($conn, $_POST['message']);
$msg = '';

$sql = "SELECT id FROM user WHERE username = '" . $_SESSION['username'] . "'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
print_r($row);

$userid = $row["id"];

// Error handlers
// Leere Felder
if (empty($message)) {
	$msg .= "Missing username \n";
} 
else {    
    //Check if Username is avaiable

    // Insert user into database
    $sql = "INSERT INTO message (user_id, message) VALUES (?, ?);";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $userid, $message);

    
    if ($stmt->execute() === true) {
        $msg = 'success';
    } else {
        $msg = 'failed';
        error_log('Error: ' . $sql . "\n" . $conn->error);
    }
    
}

die($msg);

