<?php
	//ini_set('display_errors', 1);
	//error_reporting(E_ALL);
	
	include('login.php'); // Includes Login Script
	
	$sql = "DELETE FROM Durak WHERE name='".$_POST['playerName']."'"; // AND id='".$_POST['foodName']."'
	var_dump($sql);
	
	if($conn->query($sql) == TRUE){
		$_SESSION["updatedBool"] = True;
		echo "success!";
		echo "<p><a href='index.php'> Back To Homepage</a>";
	}
	else {
		$_SESSION["updatedBool"] = False;
		echo "failed!";
		echo "<p><a href='index.php'> Back To Homepage</a>";
	}
	$conn->close();
	header("location: index.php");
?>