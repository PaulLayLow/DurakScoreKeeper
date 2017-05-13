<!-- Login to database -->
<?php
	//Debugging
	//ini_set('display_errors', 1);
	//error_reporting(E_ALL);
	session_start();
	include('login.php'); // Includes Login Script
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<!--Import Google Icon Font-->
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/css/materialize.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
		<!--Import materialize.css-->
		<link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
		
		<!-- Script for datepicker -->
		<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.96.1/js/materialize.min.js"></script>
		<script type="text/javascript" src="https://cdn.rawgit.com/zenorocha/clipboard.js/master/dist/clipboard.min.js"></script>
		
		<!-- Custom CSS -->
		<link rel="stylesheet" type="text/css" href="custom.css">
		
		<!-- Notify if datbase was updated -->
		<script>
		function showToast(message, duration){
			<?php echo 'var msg = "'.json_encode($_SESSION["updatedBool"]).'";'; ?>
			if (msg == "true"){
				Materialize.toast(message, duration);  
			}
		}
		</script>
		
		<!-- Check All Checkboxes -->
		<script language="JavaScript">
			function toggle(source) {
				checkboxes = document.getElementsByName('currPlayers[]');
				for(var i=0, n=checkboxes.length;i<n;i++) {
					checkboxes[i].checked = source.checked;
				}
			}
		</script>
		
		<style>
		nav {
			height: 150px;
			line-height: 150px;
		}
		</style>
		
		<!--Let browser know website is optimized for mobile-->
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<title>Durak</title>
	</head>
	
	<body onpageshow="showToast('Updated Successfully', 3000)"> <!-- deleteSession() -->
		<nav class="blue darken-2">
			<div class="nav-wrapper">
				<a href="#" class="brand-logo center"><img class="responsive-img" src="pictures/durak.png" width="200" height="200"></a>
				<ul id="nav-mobile" class="right hide-on-med-and-down">
				</ul>
				<form>
					<div class="input-field s4">
					  <input type="search" id="searchInput" onkeyup="searchInventory()" required>
					  <label for="search"><i class="material-icons">search</i></label>
					  <i class="material-icons" onclick="resetForm('searchInput')">close</i>
					</div>
				</form>
			</div>
		</nav>
		
		<br />
		<br />
		
		<!-- Sort everything into tabs because page is getting damn long --> 
		<div class="row">
			<div class="col s12">
			  <ul class="tabs">
				<li class="tab col s3"><a class="active" href="#currWeek">Current Week</a></li>
				<li class="tab col s3"><a href="#pastDurak">Past Durak</a></li>
				<li class="tab col s3"><a href="#totalDurak">Total Durak</a></li>
				<li class="tab col s3"><a href="#theoStats">Theoretical Stats</a></li>
			  </ul>
			</div>
			
			<!-- Main table which shows current stats for that week -->
			<div id="currWeek" class="col s12">
				<form action='updateTable.php' name='updateTable' method='post'>
				<table class="striped responsive-table" id="mainTable">
					<thead>
						<tr>
							<th></th>
							<th data-field="playing">All Playing? &nbsp &nbsp <input type='checkbox' onClick="toggle(this)" id="check"/><label for="check"></label></th>
							<th data-field="loser">Who Lost?</th>
							<th data-field="name">Name</th>
							<th data-field="losses">Total Losses</th>
							<th data-field="rounds">Total Rounds</th>
							<th data-field="ratio">Calculated Ratio</th>
						</tr>
					</thead>	

					<tbody>	
						<!-- Grab all records -->
						<?php
							$sql = "SELECT * FROM Durak"; //name, numLosses, numRounds
							$result = $conn->query($sql);
							
							if ($result->num_rows > 0) {
								// output data of each row
								while($row = $result->fetch_assoc()) {
									echo "<tr><td></td>";
									echo "<td><input type='checkbox' name='currPlayers[]' value='". $row["name"]."' id='". $row["name"]."'/><label for='". $row["name"]."'></label></td>";
									echo "<td><input name='daLoser' type='radio' id='". $row["name"]."rd' value='". $row["name"]."'/><label for='". $row["name"]."rd'></label> </td>";
									echo "<td>" . $row["name"]. "<input type='hidden' name='playerName' value='". $row["name"]."' /></td>";
									echo "<td>" . $row["numLosses"]. "<input type='hidden' name='totalLosses' value='". $row["numLosses"]."' /></td>";
									echo "<td>" . $row["numRounds"]. "<input type='hidden' name='totalRounds' value='". $row["numRounds"]."' /></td>";
									$percent = $row["numLosses"]/$row["numRounds"];
									$percent_friendly = number_format( $percent * 100, 2 ) . '%';
									echo "<td>" . $percent_friendly. "<input type='hidden' name='calcRatio' value='". $percent_friendly."' /></td></tr>";
								}
							} 
							else {
								echo "<form><tr>";
								echo "<td>0 results</td>";
								echo "</tr></form>";
							}
						?>
					</tbody>
				</table>
				<button class='btn waves-effect waves-light' style="left: 1%;" type='submit' name='add'><i class='material-icons'>send</i></button> &nbsp &nbsp &nbsp &nbsp <span class="orange-text text-accent-4">Add a loser</span>
				<br />
				<p></p>
				</form>
				
				<!-- Following forms are hidden until buttons are pressed -->
				<!-- At end of week, start a new round (purge table), but keep history of that week -->
				<div id='hideDivEndOfWeek' style='display:none;' class="center-align">
					<form action='updateTable.php' name='deleteTable' method='post'>
						<tr>
							<td>
								<div style='display:inline;' class='col s1'>
									<div class='input-field inline'>
										<select name='daLoser'>
											<option value="" disabled selected>Name</option>
											<?php 
												$sql = "SELECT name FROM Durak";
												$result = $conn->query($sql);
												if ($result->num_rows > 0) {
													while($row = $result->fetch_assoc()) {									
														echo "<option value='" . $row['name'] . "'>" . $row['name'] . "</option>";
													}
												}
												else {
													echo "<option value='noPlayer'> No Players Detected </option>";
												}									
											?>
										</select>
									</div>
								</div>
							</td>
							<td>
								<div style='display:inline;' class='col s1'>
									<div class='input-field inline'>
										<input name='percentage' type='text' placeholder='Percent'>
									</div>
								</div>
							</td>
							<td>
								<div style='display:inline;'>
									<button class='btn waves-effect waves-light' type='submit' name='clear'>
										Start new round
										<i class='material-icons right'>
											send
										</i>
									</button>
								</div>
							</td>
						</tr>
					</form>
				</div>
				<button class="btn waves-effect waves-light" style="left: 1%;" onclick="showHiddenDivEndOfWeek()"><i class="material-icons">loop</i></button> &nbsp &nbsp &nbsp &nbsp <span class="orange-text text-accent-4">End of week</span>
				
				<br />
				
				<!-- Adding new player -->
				<div id='hideDiv' style='display:none;' class="center-align">
					<form action='insertTable.php' name='insertTable' method='post'>
						<tr>
							<td>
								<div style='display:inline;' class='col s1'>
									<div class='input-field inline'>
										<input name='playerName' type='text' placeholder='Name'>
									</div>
								</div>
							</td>
							<td>
								<div style='display:inline;' class='col s1'>
									<div class='input-field inline'>
										<input name='totalLosses' type='text' placeholder='Losses'>
									</div>
								</div>
							</td>
							<td>
								<div style='display:inline;' class='col s1'>
									<div class='input-field inline'>
										<input name='totalRounds' type='text' placeholder='Rounds'>
									</div>
								</div>
							</td>
							<td>
								<div style='display:inline;'>
									<button class='btn waves-effect waves-light' type='submit' name='action'>
										New
										<i class='material-icons right'>
											send
										</i>
									</button>
								</div>
							</td>
						</tr>
					</form>
				</div>
				<br />
				<button class="btn waves-effect waves-light" style="left: 1%;" onclick="showHiddenDiv()"><i class="material-icons">add</i></button> &nbsp &nbsp &nbsp &nbsp <span class="orange-text text-accent-4">Add a new player</span>
			</div>
			
			<!-- Show who lost the previous weeks -->
			<div id="pastDurak" class="col s12">
				<table class="striped responsive-table" id="pastLoser">
					<thead>
						<tr>
							<th data-field="title"><span class="orange-text text-accent-4">Past Losers</span></th>
							<th data-field="date">Date</th>
							<th data-field="name">Name</th>
							<th data-field="ratio">Percentage</th>
						</tr>
					</thead>	

					<tbody>	
						<!-- Grab all records -->
						<?php
							$sql = "SELECT * FROM DurakPastWeek"; //week, loser, percentage
							$result = $conn->query($sql);
							
							if ($result->num_rows > 0) {
								// output data of each row
								while($row = $result->fetch_assoc()) {
									echo "<tr><td></td>";
									echo "<td>". $row["week"]."</td>";
									echo "<td>" . $row["loser"]. "</td>";
									echo "<td>" . $row["percentage"]. "</td></tr>";
								}
							} 
							else {
								echo "<tr>";
								echo "<td>0 results</td>";
								echo "</tr>";
							}
						?>
					</tbody>
				</table>
			</div>
			
			<!-- Show all history of stats -->
			<div id="totalDurak" class="col s12">
				<table class="striped responsive-table" id="fullHistory">
					<thead>
						<tr>
							<th data-field="title"><span class="orange-text text-accent-4">Total History</span></th>
							<th data-field="name">Name</th>
							<th data-field="numLosses">Total Losses</th>
							<th data-field="numRounds">Total Rounds</th>
							<th data-field="ratio">Ratio</th>
						</tr>
					</thead>	

					<tbody>	
						<!-- Grab all records -->
						<?php
							$sql = "SELECT * FROM DurakFullHistory"; //week, loser, percentage
							$result = $conn->query($sql);
							
							if ($result->num_rows > 0) {
								// output data of each row
								while($row = $result->fetch_assoc()) {
									echo "<tr><td></td>";
									echo "<td>" . $row["name"]. "</td>";
									echo "<td>" . $row["numLosses"]. "</td>";
									echo "<td>" . $row["numRounds"]. "</td>";
									$percent = $row["numLosses"]/$row["numRounds"];
									$percent_friendly = number_format( $percent * 100, 2 ) . '%';
									echo "<td>" . $percent_friendly. "<input type='hidden' name='calcRatio' value='". $percent_friendly."' /></td></tr>";
								}
							} 
							else {
								echo "<tr>";
								echo "<td>0 results</td>";
								echo "</tr>";
							}
						?>
					</tbody>
				</table>
			</div>
			
			<!-- Theoretical Calculator - Will find ratio "if" chosen person loses -->
			<div id="theoStats" class="col s12">
				<table class="striped responsive-table" id="theoreticalCalc">
					<thead>
						<tr>
							<th data-field="title"><span class="orange-text text-accent-4">Theoretical Stats</span></th>
							<th data-field="lost">Who "Lost"?</th>
							<th data-field="name">Name</th>
							<th data-field="numLosses">Losses</th>
							<th data-field="numRounds">Rounds</th>
							<th data-field="ratio">Ratio</th>
						</tr>
					</thead>	

					<tbody>	
						<!-- Grab all records -->
						<?php						
							$sql = "SELECT * FROM Durak"; //name, numLosses, numRounds
							$result = $conn->query($sql);
							
							if ($result->num_rows > 0) {
								// output data of each row
								while($row = $result->fetch_assoc()) {
									echo "<tr><td></td>";
									echo "<td><input class='updateTheo' name='theoLoser' type='radio' id='". $row["name"]."rdt' value='". $row["name"]."'/><label for='". $row["name"]."rdt'></label> </td>";
									if($num === 1) { 
										echo 'checked'; 
									}
									
									echo "<td>" . $row["name"]. "<input type='hidden' name='theoPlayerName' value='". $row["name"]."' /></td>";
									
									$theoLoses = $row["numLosses"];
									echo "<td>" . $theoLoses. "<input type='hidden' name='theoLosses' value='". $row["numLosses"]."' /></td>";
									
									$theoRoundsVar = $row["numRounds"] + 1;
									echo "<td>" . $theoRoundsVar. "<input type='hidden' name='theoRounds' value='". $row["numRounds"]."' /></td>";
									
									
									$percent = $row["numLosses"]/$theoRoundsVar;
									$percent_friendly = number_format( $percent * 100, 2 ) . '%';
									echo "<td>" . $percent_friendly. "<input type='hidden' name='theoRatio' value='". $percent_friendly."' /></td></tr>";
								}
							} 
							else {
								echo "<form><tr>";
								echo "<td>0 results</td>";
								echo "</tr></form>";
							}
						?>
					</tbody>
				</table>			
			</div>
		</div>

		<script>
		// Only used if implementing with an account
		function deleteSession(){
			<?php
				// remove all session variables
				session_unset(); 
				// destroy the session 
				session_destroy(); 
			?>
		}
		</script>
		
		<!--Import jQuery before materialize.js-->
		<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
		<script type="text/javascript" src="js/materialize.min.js"></script>
		<script type="text/javascript" src="custom.js"></script>
		<?php 
			$conn->close();	
		?>
	</body>
</html>
