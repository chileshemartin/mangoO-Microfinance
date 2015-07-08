<!DOCTYPE HTML>
<?PHP
	include 'functions.php';
	check_logon();
	connect();
?>

<html>
	<!-- HTML HEAD -->
	<?PHP htmlHead('Loan Search',1); ?>
	
	<body>
		<!-- MENU HEADER & TABS -->
		<?PHP 
		include 'menu_header.php';
		menu_Tabs(3);
		?>
		<!-- MENU MAIN -->
		<div id="menu_main">
			<a href="loan_search.php" id="item_selected">Search</a>
			<a href="loans_act.php">Active Loans</a>
			<a href="loans_pend.php">Pending Loans</a>
		</div>
					
		<!-- CONTENT: Loan Search -->
		<div class="content_center">
	
			<form action="loans_result.php" method="post">
				<p class="heading_narrow">Search Loan by Number</p>
				<input type="text" name="loan_no" placeholder="Loan Number" />
				<input type="submit" value="Search Loan" />
			</form>
			
			<form action="loans_result.php" method="post" style="margin-top:4.5em;">
				<p class="heading_narrow">Search Loan by Status</p>
				<select name="loan_status">
					<option value="1">Pending</option>
					<option value="2">Approved</option>
					<option value="3">Refused</option>
					<option value="4">Abandoned</option>
					<option value="5">Cleared</option>
				</select>
				<input type="submit" value="Search Loan" />
			</form>
			
		</div>
	
	</body>
</html>