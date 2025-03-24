<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: ../index_.php?page=accueil.php");
    exit();
}
