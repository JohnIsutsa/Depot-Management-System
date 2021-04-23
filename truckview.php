<?php 
	include 'includes/config.php';
    session_start();

	if (empty($_SESSION['id']) && empty($_SESSION['username'])) {
		header("location: index.php");
	}

	$limit = isset($_POST["limit-records"]) ? $_POST["limit-records"] : 5000;
	$page = isset($_GET['page']) ? $_GET['page'] : 1;
	$start = ($page - 1) * $limit;
	$result = $link->query("SELECT * FROM trucks LIMIT $start, $limit");
	$drivers = $result->fetch_all(MYSQLI_ASSOC);

	$result1 = $link->query("SELECT count(truck_id) AS id FROM trucks");
	$custCount = $result1->fetch_all(MYSQLI_ASSOC);
	$total = $custCount[0]['id'];
	$pages = ceil( $total / $limit );

	$Previous = $page - 1;
	$Next = $page + 1;

    if(isset($_POST['search'])){

        $valueToSearch = $_POST['valueToSearch'];

        // search data in all table columns

        $query = "SELECT * FROM `trucks` 
            WHERE CONCAT(`truck_id`,`reg_no`,`truck_name`, `depot_name`) LIKE '%".$valueToSearch."%'";

        $search_result = mysqli_query( $link, $query) or die(mysqli_error($link));
        } else {

        $query = "SELECT * FROM `trucks`";

        $search_result = mysqli_query( $link, $query) or die(mysqli_error($link));

        //echo("Something is wrong");

    }

 ?>
<!DOCTYPE html>
<html>
<head>
	<title>View Trucks </title>
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
	<!-- <link rel="stylesheet" type="text/css" href="../library/css/bootstrap.min.css"/>
	<script type="text/javascript" src="../library/js/jquery-3.2.1.min.js"></script> -->
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

	<div class="container well">
    <br>
		<h3 class="text-center">Truck Details</h3>
		<div class="row">
			<div class="col-md-10">
				<nav aria-label="Page navigation">
					<ul class="pagination">
				    <li>
				      <a <?php if ($Previous == 0) { ?>
                          href="truckview.php"
                     <?php } else { ?> href="rtruckview.php?page=<?= $Previous; ?>" <?php } ?> aria-label="Previous">
				        <span aria-hidden="true">&laquo; Previous</span>
				      </a>
				    </li>
				    <?php for($i = 1; $i<= $pages; $i++) : ?>
				    	<li><a href="truckview.php?page=<?= $i; ?>"><?= $i; ?></a></li>
				    <?php endfor; ?>
				    <li>
				      <a href="truckview.php?page=<?= $Next; ?>" aria-label="Next">
				        <span aria-hidden="true">Next &raquo;</span>
				      </a>
				    </li>
				  </ul>
				</nav>
			</div>
			<div class="text-center" style="margin-top: 20px; " class="col-md-2">
				<form method="post" action="#">
						<select name="limit-records" id="limit-records">
							<option disabled="disabled" selected="selected">---Limit Records---</option>
							<?php foreach([10,100,500,1000,5000] as $limit): ?>
								<option <?php if( isset($_POST["limit-records"]) && $_POST["limit-records"] == $limit) echo "selected" ?> value="<?= $limit; ?>"><?= $limit; ?></option>
							<?php endforeach; ?>
						</select>
					</form>
			</div>
            
		</div>

        <button id="exportButton" onclick="exportTableToExcel('table', 'truck-data')" style="color: white; background-color: green;" class="btn btn-lg clearfix"><span class="fa fa-file-excel-o"></span> Export to Excel</button>

        <br> <br> 
		<div style="height: 600px; overflow-y: auto;">
            <form action="truckview.php" method="post">

                <input type="text" name="valueToSearch" placeholder="Value To Search"><br><br>

                <input type="submit" name="search" value="Filter"><br><br>

    

                    <table id="table" class="table table-striped table-bordered">

                    <tr>

                        <th>Id</th>

                        <th>RegNo</th>

                        <th>Description</th>

                        <th>Depot</th>

                        
                    </tr>

                    <!-- // fetch the data from the MySQL database by using the mysqli_fetch_array() function

                    by using the loop. The loop continues to work until the search reach at its

                    limit -->

                    <?php while($row = mysqli_fetch_array($search_result)):?>

                    <tr>

                    <td><?php echo $row['truck_id'];?></td>

                    <td><?php echo $row['reg_no'];?></td>

                    <td><?php echo $row['truck_name'];?></td>

                    <td><?php echo $row['depot_name'];?></td>

                    
                    </tr>

                    <?php endwhile;?>

                    </table>

            </form>
        </div>


<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script type="text/javascript" src="http://www.shieldui.com/shared/components/latest/js/shieldui-all.min.js"></script>
<script type="text/javascript" src="http://www.shieldui.com/shared/components/latest/js/jszip.min.js"></script>
        
<script type="text/javascript">
	$(document).ready(function(){
		$("#limit-records").change(function(){
			$('form').submit();
		})
	})
</script>
<script type="text/javascript">
    
    function exportTableToExcel(tableID, filename = ''){
    var downloadLink;
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tableID);
    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
    
    // Specify file name
    filename = filename?filename+'.xls':'excel_data.xls';
    
    // Create download link element
    downloadLink = document.createElement("a");
    
    document.body.appendChild(downloadLink);
    
    if(navigator.msSaveOrOpenBlob){
        var blob = new Blob(['\ufeff', tableHTML], {
            type: dataType
        });
        navigator.msSaveOrOpenBlob( blob, filename);
    }else{
        // Create a link to the file
        downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
    
        // Setting the file name
        downloadLink.download = filename;
        
        //triggering the function
        downloadLink.click();
    }
}
</script>
</body>
</html>