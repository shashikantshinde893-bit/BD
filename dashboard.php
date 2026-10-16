<?php
session_start(); if(!isset($_SESSION['admin'])){header("Location: login.php");exit;}
require "config/db.php";
$donors=$conn->query("SELECT COUNT(*) c FROM donors")->fetch_assoc()['c'];
$requests=$conn->query("SELECT COUNT(*) c FROM blood_requests")->fetch_assoc()['c'];
$pending=$conn->query("SELECT COUNT(*) c FROM blood_requests WHERE status='Pending'")->fetch_assoc()['c'];
include "includes/header.php";
?>
<h1>Admin Dashboard</h1>
<div class="cards">
<div class="card"><h2>Total Donors</h2><div class="stat"><?php echo $donors; ?></div></div>
<div class="card"><h2>Total Requests</h2><div class="stat"><?php echo $requests; ?></div></div>
<div class="card"><h2>Pending Requests</h2><div class="stat"><?php echo $pending; ?></div></div>
</div>
<div class="form-box">
<h2>Admin Functions</h2>
<a class="btn" href="donors.php">View Donors</a>
<a class="btn" href="requests.php">View Requests</a>
<a class="btn green" href="donor_register.php">Add Donor</a>
</div>
<?php include "includes/footer.php"; ?>