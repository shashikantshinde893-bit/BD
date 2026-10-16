<?php
require "config/db.php";
$q=$conn->query("SELECT * FROM donors ORDER BY id DESC");
include "includes/header.php";
?>
<div class="table-box"><h2>Registered Donors</h2>
<table><tr><th>Name</th><th>Age</th><th>Gender</th><th>Blood</th><th>Phone</th><th>City</th><th>Certificate</th></tr>
<?php while($r=$q->fetch_assoc()): ?>
<tr>
  <td><?php echo htmlspecialchars($r['name']); ?></td>
  <td><?php echo $r['age']; ?></td>
  <td><?php echo $r['gender']; ?></td>
  <td><span class="badge"><?php echo $r['blood_group']; ?></span></td>
  <td><?php echo htmlspecialchars($r['phone']); ?></td>
  <td><?php echo htmlspecialchars($r['city']); ?></td>
  <td>
    <!-- Fixed link here -->
    <a class="btn" href="certificates/certificate_pdf.php?id=<?= $r['id'] ?>">
       🎓 Download
    </a>
  </td>
</tr>
<?php endwhile; ?>
</table></div>
<?php include "includes/footer.php"; ?>