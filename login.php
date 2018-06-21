<?php

$username = $_POST['username'];
$password = $_POST['password'];

$link = mysqli_connect('localhost', 'root', '', 'db_todo')