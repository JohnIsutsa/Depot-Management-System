<?php
    include 'config.php'; 

    $username = $pass = $repass = "";
    $username_err = $pass_err = $repass_err = "";
    if (isset($_POST['signup'])) {

        $input_name = trim($_POST["username"]);
        if(empty($input_name)){
            $username_err = "Please enter a username";
        } else{
            $username = $input_name;
        }
        
        // Validate Password
        $input_pass = trim($_POST["password"]);
        if(empty($input_pass)){
            $pass_err = "Please enter a password.";     
        } else{
            $pass = $input_pass;
        }

        // Validate Password
        $input_repass = trim($_POST["repassword"]);
        if(empty($input_repass)){
            $repass_err = "Please enter password again.";     
        } else{
            $repass = $input_repass;
        }

        if ($_POST['password'] !== $_POST['repassword']) 
        {
            $repass_err = "Passwords do not match.";
        }
        else {
              
              $checkusername = "SELECT * FROM admins WHERE username = '$username'";
              $run_check = mysqli_query($link , $checkusername) or die(mysqli_error($link));
              $countusername = mysqli_num_rows($run_check); 
              if ($countusername > 0 ) {
            echo  "<script>alert('Username Already Taken.); </script>";
        }
        
          else {
              
              $password = password_hash("$pass" , PASSWORD_DEFAULT);
              
              
              $query = "INSERT INTO admins(username, password) VALUES ('$username', '$password')";
              $result = mysqli_query($link , $query) or die(mysqli_error($link));
              if (mysqli_affected_rows($link) > 0) { 
                echo "<script>alert('SUCCESSFULLY ADDED ADMIN);
                window.location.href='dashboard.html';</script>";
        }
        else {
          echo "<script>alert('Error Occured. Try again.');</script>";
        }
        }
        }
        }
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>HAKIKA DEPOT MANAGEMENT SYSTEM</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<style>
body {
	color: #fff;
	background: #d47677;
}
.heading {
   text-align: center;
  
}
.form-control {
	min-height: 41px;
	background: #fff;
	box-shadow: none !important;
	border-color: #e3e3e3;
}
.form-control:focus {
	border-color: #70c5c0;
}
.form-control, .btn {        
	border-radius: 2px;
}
.login-form {
	width: 350px;
	margin: 0 auto;
	padding: 100px 0 30px;		
}
.login-form form {
	color: #7a7a7a;
	border-radius: 2px;
	margin-bottom: 15px;
	font-size: 13px;
	background: #ececec;
	box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
	padding: 30px;	
	position: relative;	
}
.login-form h2 {
	font-size: 22px;
	margin: 35px 0 25px;
}
.login-form .avatar {
	position: absolute;
	margin: 0 auto;
	left: 0;
	right: 0;
	top: -50px;
	width: 95px;
	height: 95px;
	border-radius: 50%;
	z-index: 9;
	background: #70c5c0;
	padding: 15px;
	box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
}
.login-form .avatar img {
	width: 100%;
}	
.login-form input[type="checkbox"] {
	position: relative;
	top: 1px;
}
.login-form .btn, .login-form .btn:active {        
	font-size: 16px;
	font-weight: bold;
	background: #70c5c0 !important;
	border: none;
	margin-bottom: 20px;
}
.login-form .btn:hover, .login-form .btn:focus {
	background: #50b8b3 !important;
}    
.login-form a {
	color: #fff;
	text-decoration: underline;
}
.login-form a:hover {
	text-decoration: none;
}
.login-form form a {
	color: #7a7a7a;
	text-decoration: none;
}
.login-form form a:hover {
	text-decoration: underline;
}
.login-form .bottom-action {
	font-size: 14px;
}
</style>
</head>
<body>
<h1 class="heading">HAKIKA DEPOT MANAGEMENT SYSTEM</h1>
<div class="login-form">
    
    <form method="post">
		
        <h2 class="text-center">Create Admin</h2>   
        <div class="form-group">
        	<input type="text" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" name="username" placeholder="Username" required="required">
            <span class="invalid-feedback"><?php echo $username_err;?></span>
        </div>
		<div class="form-group">
            <input type="password" class="form-control <?php echo (!empty($pass_err)) ? 'is-invalid' : ''; ?>" name="password" placeholder="Password" required="required">
            <span class="invalid-feedback"><?php echo $pass_err;?></span>
        </div>
        <div class="form-group">
            <input type="password" class="form-control <?php echo (!empty($repass_err)) ? 'is-invalid' : ''; ?>" name="repassword" placeholder="Confirm Password" required="required">
            <span class="invalid-feedback"><?php echo $repass_err;?></span>
        </div>        
        <div class="form-group">
            <button type="submit" name="signup"class="btn btn-primary btn-lg btn-block">Sign Up</button>
        </div>
		
    </form>
    <p class="text-center small">Already have an account? <a href="../index.php">Log in here!</a></p>
</div>
</body>
</html>