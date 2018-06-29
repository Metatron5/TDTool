<?php
session_start();

//Logout session
if (session_status() === PHP_SESSION_ACTIVE) {
    session_unset();
    if (ini_get('session.use_cookies')) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time()-86400,
            $params["path"],
            $params["domain"],
            $params["secure"],
            $params["httponly"]
        );
    }
    session_destroy(); 
}

echo 'true';