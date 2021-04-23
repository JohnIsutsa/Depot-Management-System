<?php
// Include config file
require_once "includes/config.php";


session_start();

if (empty($_SESSION['id']) && empty($_SESSION['username'])) {
	header("location: index.php");
}
 
// Define variables and initialize with empty values
$name = $id = $dob = "";
$name_err = $id_err = $dob_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate name
    $input_name = trim($_POST["name"]);
    if(empty($input_name)){
        $name_err = "Please enter a name.";
    } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $name_err = "Please enter a valid name.";
    } else{
        $name = $input_name;
    }
    
    // Validate ID
    $input_id = trim($_POST["id"]);
    if(empty($input_id)){
        $id_err = "Please enter an ID.";     
    } else{
        $id = $input_id;
    }
    
    // Validate salary
    $input_dob = trim($_POST["dob"]);
    if(empty($input_dob)){
        $dob_err = "Please enter the Date of Birth."; }    
    // } elseif(!ctype_digit($input_salary)){
    //     $salary_err = "Please enter a positive integer value.";
    // } 
    else{
        $dob = $input_dob;
    }
    
    // Check input errors before inserting in database
    if(empty($name_err) && empty($address_err) && empty($salary_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO drivers(driver_name, national_id, driver_dob) VALUES ('$name', '$id', '$dob')";
        $result = mysqli_query($link, $sql) or die (mysqli_error($link));

        if(mysqli_affected_rows($link) > 0){
            echo "<script>alert('SUCCESSFULLY ADDED DRIVER');
            window.location.href= 'dashboard.php';</script>";
                     } else{
                        "<script> alert('Error while uploading..try again');</script>";
                     }
        }
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Driver</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link href="common-css/bootstrap.css" rel="stylesheet">

	<link href="common-css/ionicons.css" rel="stylesheet">


	<link href="layout-1/css/styles.css" rel="stylesheet">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
<header>
		<div class="container-fluid position-relative no-side-padding">

			<a href="dashboard.php" class="logo"><!--<img src="images/logo.png" alt="Logo Image">--> <div class="name"> <b>HAKIKA DEPOT MANAGEMENT SYSTEM</b></div></a>
            <ul class="nav navbar-right main-menu" style="float: right;">

				<li><a href="logout.php"><i class="ion-power"></i> Logout</a></li>
			</ul>

		</div><!-- conatiner -->
	</header>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Add Driver</h2>
                    <p>Please use this form to add driver details to the system.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>">
                            <span class="invalid-feedback"><?php echo $name_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>ID Number</label>
                            <input type="text" name="id" class="form-control <?php echo (!empty($id_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $id; ?>">
                            <span class="invalid-feedback"><?php echo $id_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>DOB</label>
                            <input type="date" name="dob" class="form-control <?php echo (!empty($dob_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $dob; ?>">
                            <span class="invalid-feedback"><?php echo $dob_err;?></span>
                        </div>
                        
                        
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="dashboard.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>