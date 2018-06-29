<?php

session_start();

$username = $_SESSION['username'];

if(empty($username)) {
    echo 'false';
}
else {
    echo 'true';
}