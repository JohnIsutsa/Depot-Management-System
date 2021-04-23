<?php
// Include config file
require_once "includes/config.php";
session_start();

if (empty($_SESSION['id']) && empty($_SESSION['username'])) {
	header("location: index.php");
}
 
// Define variables and initialize with empty values
$driverID = $date = $from = $to = $description = $operation = $containerNumber = $containerSize = $shippingLine = "";
$driverID_err = $date_err = $from_err = $to_err = $description_err = $operation_err = $containerNumber_err = $containerSize_err
= $containerSize_err = $shippingLine_err =  "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate ID
    $input_driver = trim($_POST["driverID"]);
    if(empty($input_driver)){
        $_err = "Please enter an ID";
    } 
    //elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
      //  $driverID_err = "Please enter a valid name.";
    //}
     else{
        $driverID = $input_driver;
    }

    // Validate Date
    $input_date = trim($_POST["date"]);
    if(empty($input_date)){
        $date_err = "Please enter the Date."; }    
    // } elseif(!ctype_digit($input_salary)){
    //     $salary_err = "Please enter a positive integer value.";
    // } 
    else{
        $date = $input_date;
    }
    
    $input_from = trim($_POST["from"]);
    if(empty($input_from)){
        $from_err = "Please enter From Destination";     
    } else{
        $from = $input_from;
    }

    $input_to = trim($_POST["to"]);
    if(empty($input_to)){
        $to_err = "Please enter To Destination";     
    } else{
        $to = $input_to;
    }

    $input_desc = trim($_POST["description"]);
    if(empty($input_desc)){
        $description_err = "Please enter Cargo Description";     
    } else{
        $description = $input_desc;
    }
    
    $input_op = trim($_POST["operation"]);
    if(empty($input_op)){
        $operation_err = "Please enter Operation";     
    } else{
        $operation = $input_op;
    }

    $input_container = trim($_POST["containerNumber"]);
    if(empty($input_container)){
        $containerNumber_err = "Please enter Container Number";     
    } else{
        $containerNumber = $input_container;
    }
    
    //container size
    $input_size = trim($_POST["containerSize"]);
    $containerSize = $input_size;

    $input_line = trim($_POST["shippingLine"]);
    if(empty($input_line)){
        $shippingLine_err = "Please enter Shipping Line";     
    } else{
        $shippingLine = $input_line;
    }
    
    
    // Check input errors before inserting in database
    if(empty($date_err) && empty($from_err) && empty($to_err) && empty($description_err) && empty($containerNumber_err) && empty($shippingLine_err)){
        // Prepare an insert statement
        $sql1 = "SELECT driver_name FROM drivers WHERE driver_id = '$driverID'"; 
        $result1 = mysqli_query($link, $sql1) or die(mysqli_error($link));
        $row = mysqli_fetch_array($result1); 
        $driver_name = $row["driver_name"]; 

        $sql2 = "SELECT national_id FROM drivers WHERE driver_id = '$driverID'"; 
        $result2 = mysqli_query($link, $sql2) or die(mysqli_error($link));
        $row = mysqli_fetch_array($result2); 
        $nationalID = $row["national_id"];
       

        $sql = "INSERT INTO driver_trips(driver_name, national_id, trip_date, trip_from, trip_destination, cargo_description, trip_operation, container_number, 
            container_size, shipping_line, driver_id) VALUES 
            ('$driver_name','$nationalID', '$date', '$from', '$to', '$description', '$operation', '$containerNumber', '$containerSize', '$shippingLine', '$driverID')";
        $result = mysqli_query($link, $sql) or die (mysqli_error($link));

        if(mysqli_affected_rows($link) > 0){
            echo "<script>alert('SUCCESSFULLY RECORDED TRIP');
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
    <title>Add Trip</title>
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
                    <h2 class="mt-5">Add Trip</h2>
                    <p>Add trip details to the system.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <?php  
                        $query = "SELECT driver_id, national_id FROM drivers";
                        $result = mysqli_query($link, $query) or die(mysqli_error($link));
                    ?>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Driver ID</label>
                            <select class="form-control" id="exampleFormControlSelect1" name="driverID">
                            <?php 
                                while($rows = $result->fetch_assoc()) 
                                    {
                                        $driver_id = $rows['driver_id'];
                                        $national_id = $rows['national_id'];

                                        echo "<option value='$driver_id'>$national_id</option>";
          			                } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Date</label>
                            <input type="date" name="date" class="form-control <?php echo (!empty($date_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $date; ?>">
                            <span class="invalid-feedback"><?php echo $dob_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>From</label>
                            <input type="text" name="from" class="form-control <?php echo (!empty($from_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $from; ?>">
                            <span class="invalid-feedback"><?php echo $name_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>To</label>
                            <input type="text" name="to" class="form-control <?php echo (!empty($to_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $to; ?>">
                            <span class="invalid-feedback"><?php echo $id_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Cargo description</label>
                            <textarea name="description" class="form-control <?php echo (!empty($description_err)) ? 'is-invalid' : ''; ?>"><?php echo $description; ?></textarea>
                            <span class="invalid-feedback"><?php echo $address_err;?></span>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Trip Operation</label>
                            <select class="form-control" id="exampleFormControlSelect1" name="operation">
                                <option value="Repartition">Repartition</option>
                                <option value="Removal">Removal</option>
                                <option value="Transfer">Transfer</option>
                                <option value="Collection">Collection</option>
                                <option value="Return">Return</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Container Number</label>
                            <input type="text" name="containerNumber" class="form-control <?php echo (!empty($containerNumber_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $containerNumber; ?>">
                            <span class="invalid-feedback"><?php echo $id_err;?></span>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Container Size</label>
                            <select class="form-control" id="exampleFormControlSelect1" name="containerSize">
                                <option value="20 ft dry shipping container">20 ft dry shipping container</option>
                                <option value="40 ft dry shipping container">40 ft dry shipping container</option>
                                <option value="40 ft dry high cube shipping container">40 ft dry high cube shipping container</option>
                                <option value="20 ft flat rack shipping container">20 ft flat rack shipping container</option>
                                <option value="20 ft ventilated shipping container">20 ft ventilated shipping container</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Shipping Line</label>
                            <input type="text" name="shippingLine" class="form-control <?php echo (!empty($shippingLine_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $shippingLine; ?>">
                            <span class="invalid-feedback"><?php echo $id_err;?></span>
                        </div>


                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="dashboard.php" class="btn btn-secondary ml-2">Cancel</a>

                        <br>
                        <br>
                        <br>

                    
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>