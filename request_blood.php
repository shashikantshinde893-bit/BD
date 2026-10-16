<?php
require "config/db.php";
$msg="";
if($_SERVER["REQUEST_METHOD"]==="POST"){
    $stmt=$conn->prepare("INSERT INTO blood_requests(patient_name,hospital,blood_group,units,contact,city,required_date) VALUES(?,?,?,?,?,?,?)");
    $stmt->bind_param("sssisss",$_POST['patient_name'],$_POST['hospital'],$_POST['blood_group'],$_POST['units'],$_POST['contact'],$_POST['city'],$_POST['required_date']);
    if($stmt->execute()) $msg="Blood request submitted successfully.";
    else $msg="Error: ".$stmt->error;
}
include "includes/header.php";
?>
<div class="form-box">
<h2>Request Blood</h2>
<?php if($msg): ?><div class="alert success"><?php echo htmlspecialchars($msg); ?></div><?php endif; ?>
<form method="post">
<div class="form-grid">
<div><label>Patient Name</label><input name="patient_name" required></div>
<div><label>Hospital</label><input name="hospital" required></div>
<div><label>Blood Group</label><select name="blood_group" required><?php foreach(['A+','A-','B+','B-','AB+','AB-','O+','O-'] as $b) echo "<option>$b</option>"; ?></select></div>
<div><label>Units Required</label><input type="number" name="units" min="1" required></div>
<div><label>Contact</label><input name="contact" required></div>
<div><label>City</label><input name="city"></div>
<div><label>Required Date</label><input type="date" name="required_date"></div>
</div>
<button class="btn" type="submit">Submit Request</button>
</form></div>
<?php include "includes/footer.php"; ?>