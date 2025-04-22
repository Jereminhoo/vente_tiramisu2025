<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION["admin"]) || $_SESSION["admin"] !== true) {
    header("Location: ../../index_.php?page=login.php");
    exit;
}
