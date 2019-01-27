<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();


foreach ($_GET as $key => $value) {
    $value = intval($value);
    if (array_key_exists($key, $_SESSION)) {
        $_SESSION[$key] += $value;
    }
    else {
        $_SESSION[$key] = $value;
    }

    if ($_SESSION[$key] < 0) {
        $_SESSION[$key] = 0;
    }
}

?>