<?php
require "config/db.php";
$msg="";
if($_SERVER["REQUEST_METHOD"]==="POST"){
    $stmt=$conn->prepare("INSERT INTO donors(name,age,gender,blood_group,phone,email,city,last_donation_date) VALUES(?,?,?,?,?,?,?,?)");
    $stmt->bind_param("sissssss",$_POST['name'],$_POST['age'],$_POST['gender'],$_POST['blood_group'],$_POST['phone'],$_POST['email'],$_POST['city'],$_POST['last_donation_date']);
    if($stmt->execute()) $msg="Donor registered successfully.";
    else $msg="Error: ".$stmt->error;
}
include "includes/header.php";
?>
<div class="form-box">
<h2>Donor Registration</h2>
<?php if($msg): ?><div class="alert success"><?php echo htmlspecialchars($msg); ?></div><?php endif; ?>
<form method="post">
<div class="form-grid">
<div><label>Name</label><input name="name" required></div>
<div><label>Age</label><input type="number" name="age" min="18" required></div>
<div><label>Gender</label><select name="gender" required><option>Male</option><option>Female</option><option>Other</option></select></div>
<div><label>Blood Group</label><select name="blood_group" required><?php foreach(['A+','A-','B+','B-','AB+','AB-','O+','O-'] as $b) echo "<option>$b</option>"; ?></select></div>
<div><label>Phone</label><input name="phone" required></div>
<div><label>Email</label><input type="email" name="email"></div>
<div><label>City</label><input name="city"></div>
<div><label>Last Donation Date</label><input type="date" name="last_donation_date"></div>
</div>
<button class="btn" type="submit">Register Donor</button>
</form></div>
<?php include "includes/footer.php"; ?>