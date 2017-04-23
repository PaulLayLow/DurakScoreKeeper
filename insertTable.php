<?php
	//ini_set('display_errors', 1);
	//error_reporting(E_ALL);
	
	include('login.php'); // Includes Login Script
	
	$sql = "INSERT INTO Durak (name, numLosses, numRounds) VALUES ('".$_POST['playerName']."','".$_POST['totalLosses']."','".$_POST['totalRounds']."')";
	$sqlFullHistory = "INSERT INTO DurakFullHistory (name, numLosses, numRounds) VALUES ('".$_POST['playerName']."','".$_POST['totalLosses']."','".$_POST['totalRounds']."')";
	var_dump($sql);
	
	if($conn->query($sql) == TRUE){
		if($conn->query($sqlFullHistory) == TRUE){
			$_SESSION["updatedBool"] = True;
			echo "success!";
			echo "<p><a href='index.php'> Back To Homepage</a>";
		}
		else {
			$_SESSION["updatedBool"] = False;
			echo "failed!";
			echo "<p><a href='index.php'> Back To Homepage</a>";
		}
	}
	else {
		$_SESSION["updatedBool"] = False;
		echo "failed!";
		echo "<p><a href='index.php'> Back To Homepage</a>";
	}
	$conn->close();
	header("location: index.php");
?>