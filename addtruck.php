<?php
// Include config file
require_once "includes/config.php";

session_start();

if (empty($_SESSION['id']) && empty($_SESSION['username'])) {
	header("location: index.php");
}
 
// Define variables and initialize with empty values
$name = $desc = $depot = "";
$name_err = $desc_err = $depot_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate name
    $input_name = trim($_POST["name"]);
    if(empty($input_name)){
        $name_err = "Please enter a registration number";
    } else{
        $name = $input_name;
    }
    
    // Validate ID
    $input_desc = trim($_POST["desc"]);
    if(empty($input_desc)){
        $desc_err = "Please enter a Description.";     
    } else{
        $desc = $input_desc;
    }
    
    // Validate salary
    $input_depot = trim($_POST["depot"]);
    if(empty($input_depot)){
        $depot_err = "Please enter the Depot."; }    
    else{
        $depot = $input_depot;
    }
    
    // Check input errors before inserting in database
    if(empty($name_err) && empty($desc_err) && empty($depot_err)){
        // Prepare an insert statement
        $sql1 = "SELECT depot_name FROM depots WHERE depot_id = '$depot'";
        $result1 = mysqli_query($link, $sql1) or die(mysqli_error($link));
        $row = mysqli_fetch_array($result1);
        $depotName = $row["depot_name"]; 

        $sql = "INSERT INTO trucks(reg_no, truck_name,depot_name, depot_id) VALUES ('$name', '$desc','$depotName', '$depot')";
        $result = mysqli_query($link, $sql) or die (mysqli_error($link));

        if(mysqli_affected_rows($link) > 0){
            echo "<script>alert('SUCCESSFULLY ADDED TRUCK');
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
    <title>Add Truck</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <link href="common-css/bootstrap.css" rel="stylesheet">

	<link href="common-css/ionicons.css" rel="stylesheet">


	<link href="layout-1/css/styles.css" rel="stylesheet">

	<link href="layout-1/css/responsive.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="http://www.shieldui.com/shared/components/latest/css/light/all.min.css" />
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
                    <h2 class="mt-5">Add Truck</h2>
                    <p>Add truck details to the system.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label>Registration Number</label>
                            <input type="text" name="name" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>">
                            <span class="invalid-feedback"><?php echo $name_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Truck Description</label>
                            <input type="text" name="desc" class="form-control <?php echo (!empty($desc_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $desc; ?>">
                            <span class="invalid-feedback"><?php echo $id_err;?></span>
                        </div>

                        <!--Depot Code-->
                        <?php  
                        $query = "SELECT depot_id, depot_name FROM depots";
                        $result = mysqli_query($link, $query) or die(mysqli_error($link));
                        ?>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Depot</label>
                            <select class="form-control" id="exampleFormControlSelect1" name="depot">
                            <?php 
                                while($rows = $result->fetch_assoc()) 
                                    {
                                        $depot_id = $rows['depot_id'];
                                        $depot_name = $rows['depot_name'];

                                        echo "<option value='$depot_id'>$depot_name</option>";
          			                } ?>
                            </select>
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