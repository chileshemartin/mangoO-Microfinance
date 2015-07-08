<!DOCTYPE HTML>
<?PHP
	include 'functions.php';
	check_logon();
	connect();
	
	$rep_year = date("Y",time());
	$rep_month = date("m",time());
		
	//Make array for exporting data
	$_SESSION['rep_export'] = array();
	$_SESSION['rep_exp_title'] = $rep_year.'-'.$rep_month.'_cust-active';
	
	//Select active customers from CUSTOMER
	$sql_custact = "SELECT * FROM customer WHERE cust_active = 1";
	$query_custact = mysql_query($sql_custact);
	check_sql ($query_custact);
?>
	
<html>
	<?PHP htmlHead('Active Customers',1) ?>	
	
	<body>
		<!-- MENU HEADER & TABS -->
		<?PHP 
		include 'menu_header.php';
		menu_Tabs(2);
		?>
		
		<!-- MENU MAIN -->
		<div id="menu_main">
			<a href="cust_search.php">Search</a>
			<a href="cust_new.php">New Customer</a>
			<a href="cust_act.php" id="item_selected">Active Customers</a>
			<a href="cust_inact.php">Inactive Customers</a>
		</div>
		
		<!-- Export Button -->
		<form class="export" action="rep_export.php" method="post">
			<input type="submit" name="export_rep" value="Export Active Customers" />
		</form>	
		
		<!-- TABLE: Active Customers -->
		<table id="tb_table">				
			<colgroup>
				<col width="8%" />	
				<col width="17%" />
				<col width="8%" />
				<col width="8%" />
				<col width="17%" />
				<col width="17%" />
				<col width="17%" />
				<col width="8%" />
			</colgroup>
			<tr>
				<th class="title" colspan="8">Active Customers</th>
			</tr>
			<tr>
				<th>Cust. No.</th>
				<th>Name</th>					
				<th>Gender</th> 
				<th>DoB</th> 
				<th>Occupation</th>
				<th>Place of Residence</th> 
				<th>Phone No.</th>
				<th>Memb. since</th>
			</tr>
			<?PHP		
			$color = 0;
			while ($row_custact = mysql_fetch_assoc($query_custact)){					
				
				//Set value for $gender
				if ($row_custact['cust_sex'] == 1) $gender = "Male";
				elseif ($row_custact['cust_sex'] == 2) $gender = "Female";
				else $gender = "Institution";
				
				tr_colored($color);	//Alternating row colors
				echo '<td>
								<a href="customer.php?cust='.$row_custact['cust_id'].'">'.$row_custact['cust_id'].'/'.date("Y",$row_custact['cust_since']).'</a>
							</td>
							<td>'.$row_custact['cust_name'].'</td>
							<td>'.$gender.'</td>
							<td>'.date("d.m.Y",$row_custact['cust_dob']).'</td>
							<td>'.$row_custact['cust_occup'].'</td>
							<td>'.$row_custact['cust_address'].'</td>
							<td>'.$row_custact['cust_phone'].'</td>
							<td>'.date("d.m.Y",$row_custact['cust_since']).'</td>
						</tr>';
				
				array_push($_SESSION['rep_export'], array("Cust. No." => $row_custact['cust_id'], "Customer Name" => $row_custact['cust_name'], "DoB" => date("d.m.Y",$row_custact['cust_dob']), "Gender" => $gender, "Occupation" => $row_custact['cust_occup'], "Place of Residence" => $row_custact['cust_address'], "Phone No." => $row_custact['cust_phone'], "Member since" => date("d.m.Y",$row_custact['cust_since'])));
			}
			?>
		</table>
	</body>
</html>