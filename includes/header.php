<?php
if (session_status() === PHP_SESSION_NONE) session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Blood Donation Management System</title>
<link rel="stylesheet" href="assets/style.css">
</head>
<body>
<nav class="navbar">
    <div class="brand">🩸 Blood Donation System</div>
    <div class="navlinks">
        <a href="index.php">Home</a>
        <a href="donors.php">Donors</a>
        <a href="requests.php">Blood Requests</a>
        <?php if(isset($_SESSION['admin'])): ?>
            <a href="dashboard.php">Dashboard</a>
            <a href="logout.php">Logout</a>
        <?php else: ?>
            <a href="login.php">Admin Login</a>
        <?php endif; ?>
    </div>
</nav>
<div class="container">
