<?php
session_start();

if (isset($_SESSION['username'])) {
    session_destroy();
    header("location: index.php");
    exit();
} else {
    header("location: login.php");
}