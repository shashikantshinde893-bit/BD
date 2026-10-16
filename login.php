<?php
session_start(); require "config/db.php";
$error="";
if($_SERVER["REQUEST_METHOD"]==="POST"){
    $stmt=$conn->prepare("SELECT * FROM admins WHERE username=?");
    $stmt->bind_param("s",$_POST['username']); $stmt->execute();
    $user=$stmt->get_result()->fetch_assoc();

    // MD5 comparison instead of password_verify()
    if($user && md5($_POST['password']) === $user['password']){
        $_SESSION['admin']=$user['username']; header("Location: dashboard.php"); exit;
    } else $error="Invalid username or password.";
}
include "includes/header.php";
?>
<div class="login form-box"><h2>Admin Login</h2>
<?php if($error): ?><div class="alert"><?php echo $error; ?></div><?php endif; ?>
<form method="post">
<label>Username</label><input name="username" required>
<label>Password</label><input type="password" name="password" required>
<button class="btn" type="submit">Login</button>
</form>
<p><b>Demo login:</b> admin / password</p>
</div>
<?php include "includes/footer.php"; ?>