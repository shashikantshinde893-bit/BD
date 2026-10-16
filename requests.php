<?php
require "config/db.php";
$q=$conn->query("SELECT * FROM blood_requests ORDER BY id DESC");
include "includes/header.php";
?>
<div class="table-box"><h2>Blood Requests</h2>
<table><tr><th>Patient</th><th>Hospital</th><th>Blood</th><th>Units</th><th>Contact</th><th>City</th><th>Date</th><th>Status</th></tr>
<?php while($r=$q->fetch_assoc()): ?>
<tr><td><?php echo htmlspecialchars($r['patient_name']); ?></td><td><?php echo htmlspecialchars($r['hospital']); ?></td><td><?php echo $r['blood_group']; ?></td><td><?php echo $r['units']; ?></td><td><?php echo htmlspecialchars($r['contact']); ?></td><td><?php echo htmlspecialchars($r['city']); ?></td><td><?php echo $r['required_date']; ?></td><td><?php echo $r['status']; ?></td></tr>
<?php endwhile; ?>
</table></div>
<?php include "includes/footer.php"; ?>