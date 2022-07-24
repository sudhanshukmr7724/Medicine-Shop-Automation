<!DOCTYPE html>
<html>

<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="nav2.css">
<link rel="stylesheet" type="text/css" href="table1.css">
<title>
Reports
</title>
</head>

<body>

		<div class="sidenav">
		<h2 style="font-family:Arial; color:white; text-align:center;"> MSA </h2>
			<a href="adminmainpage.php">Dashboard</a>
			<button class="dropdown-btn">Inventory
			<i class="down"></i>
			</button>
			<div class="dropdown-container">
				<a href="inventory-add.php">Add New Medicine</a>
				<a href="inventory-view.php">List Of Medicines</a>
			</div>
			<button class="dropdown-btn">Vendors
			<i class="down"></i>
			</button>
			<div class="dropdown-container">
				<a href="supplier-add.php">Add New Vendor</a>
				<a href="supplier-view.php">List Of Vendors</a>
			</div>
			<button class="dropdown-btn">Stock Purchase
			<i class="down"></i>
			</button>
			<div class="dropdown-container">
				<a href="purchase-add.php">Add New Purchase</a>
				<a href="purchase-view.php">Manage Purchases</a>
			</div>
			<button class="dropdown-btn">Employees
			<i class="down"></i>
			</button>
			<div class="dropdown-container">
				<a href="employee-add.php">Add New Employee</a>
				<a href="employee-view.php">Manage Employees</a>
			</div>
			<button class="dropdown-btn">Customers
			<i class="down"></i>
			</button>
			<div class="dropdown-container">
				<a href="customer-add.php">Add New Customer</a>
				<a href="customer-view.php">Manage Customers</a>
			</div>
			<a href="sales-view.php">View Sales Invoice Details</a>
			<a href="salesitems-view.php">View Sold Products Details</a>
			<a href="pos1.php">Add New Sale</a>
			<button class="dropdown-btn">Reports
			<i class="down"></i>
			</button>
			<div class="dropdown-container">
				<a href="stockreport.php">Medicines - Low Stock</a>
				<a href="expiryreport.php">Medicines - Expired</a>
				<a href="salesreport.php">Transactions Reports</a>
			</div>
	</div>

	<div class="topnav">
		<a href="logout.php">Logout</a>
	</div>

	<center>
	<div class="head">
	<h2> MEDICINES LOW ON STOCK</h2>
	</div>
	</center>

	<table align="right" id="table1" style="margin-right:100px;">
		<tr>
			<th>MED ID</th>
			<th>Medicine Name</th>
			<th>Quantity Required</th>
			<th>Threshold Quantity</th>
			<th>Category</th>
			<th>Price</th>
			<th>Vendor Address</th>
		</tr>

	<?php
	include "config.php";

	$sql = "SELECT meds.vendor_address, sales_items.med_id , meds.med_name,meds.med_qty,ROUND(SUM(sales_items.sale_qty)/7) as threshold,meds.category,meds.med_price,meds.location_rack FROM sales_items
	INNER JOIN meds ON meds.med_id=sales_items.med_id
	WHERE sales_items.s_date >= curdate() - INTERVAL DAYOFWEEK(curdate())+6 DAY
	GROUP BY sales_items.med_id";

	$result = $conn->query($sql);


	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {

			if($row["threshold"]<=$row["med_qty"]) continue;

		echo "<tr>";
			echo "<td>" . $row["med_id"]. "</td>";
			echo "<td>" . $row["med_name"] . "</td>";
		echo "<td style='color:red;'>" .$row["threshold"] - $row["med_qty"]. "</td>";
		echo "<td style='color:red;'>" . $row["threshold"] . "</td>";
		echo "<td>" . $row["category"]. "</td>";
		echo "<td>" . $row["med_price"] . "</td>";
		echo "<td>" . $row["vendor_address"]. "</td>";
		echo "</tr>";
		}
	echo "</table>";
	}
	$conn->close();
	?>
</body>

<script>

		var dropdown = document.getElementsByClassName("dropdown-btn");
		var i;

			for (i = 0; i < dropdown.length; i++) {
			  dropdown[i].addEventListener("click", function() {
			  this.classList.toggle("active");
			  var dropdownContent = this.nextElementSibling;
			  if (dropdownContent.style.display === "block") {
			  dropdownContent.style.display = "none";
			  } else {
			  dropdownContent.style.display = "block";
			  }
			  });
			}

</script>

</html>
