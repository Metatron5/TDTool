<?php

session_start();
include_once 'databaseconn.php';

$sql = "SELECT username, message, timestamp FROM message INNER JOIN user ON message.user_id = user.id;";
$result = mysqli_query($conn, $sql);
$resultcheck = mysqli_num_rows($result);

//Check if there are messages
if ($resultcheck == 0) {
    echo 'no message existing';
}

else{
    //making JSON
    $out = '[';

    while($row = mysqli_fetch_assoc($result))
    {
        $out .= '{"username": "'.$row['username'].'", "message": "'. $row['message'].'", "timestamp": "'. $row['timestamp']. '"},';
    }

    $out = substr($out, 0, -1);
    $out .= ']';

    echo $out;
}