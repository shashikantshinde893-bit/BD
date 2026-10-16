<?php
require "config/db.php";
$totalDonors = $conn->query("SELECT COUNT(*) c FROM donors")->fetch_assoc()['c'];
$totalRequests = $conn->query("SELECT COUNT(*) c FROM blood_requests WHERE status='Pending'")->fetch_assoc()['c'];
include "includes/header.php";
?>
<div class="hero">
<h1>Blood Donation Management System</h1>
<p>Donate blood, save lives. Manage donors and blood requests easily.</p>
<a class="btn" href="donor_register.php">Become a Donor</a>
<a class="btn secondary" href="request_blood.php">Request Blood</a>
</div>
<div class="cards">
<div class="card"><h2>Registered Donors</h2><div class="stat"><?php echo $totalDonors; ?></div></div>
<div class="card"><h2>Pending Requests</h2><div class="stat"><?php echo $totalRequests; ?></div></div>
<div class="card"><h2>Available Blood Groups</h2><p>A+, A-, B+, B-, AB+, AB-, O+, O-</p></div>
</div>
<?php include "includes/footer.php"; ?>