<?php
	//Debugging
	//ini_set('display_errors', 1);
	//error_reporting(E_ALL);

	include('login.php'); // Includes Login Script
	
	if(isset($_POST["add"])){
		
		// Variables
		$loserForRound = $_POST['daLoser'];
		$playersForRound = $_POST['currPlayers'];
		$currPlayersLen = count($playersForRound);
		
		// SQL statements
		for($i=0; $i < $currPlayersLen; $i++)
		{
			$sqlAddRoundToPlayers = "UPDATE Durak SET numRounds = numRounds + 1 WHERE name='" .$playersForRound[$i]. "'";
			$sqlAddRoundToHistory = "UPDATE DurakFullHistory SET numRounds = numRounds + 1 WHERE name='" .$playersForRound[$i]. "'";
			
			if($conn->query($sqlAddRoundToPlayers) == TRUE){
				if($conn->query($sqlAddRoundToHistory) == TRUE){
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
		}

		$sqlAddOneToLoser = "UPDATE Durak SET numLosses = numLosses + 1 WHERE name='" .$loserForRound. "'";
		$sqlAddOneToHistoryLoser = "UPDATE DurakFullHistory SET numLosses = numLosses + 1 WHERE name='" .$loserForRound. "'";
		
		if ($conn->query($sqlAddOneToLoser) == TRUE){
			if ($conn->query($sqlAddOneToHistoryLoser) == TRUE){
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
	}
	
	if(isset($_POST["clear"])){
		$currWeek = date("Y-m-d");
		$loserName = $_POST['daLoser'];
		$loserPercent = $_POST['percentage'];
		
		$sqlStoreWeekly = "INSERT INTO DurakPastWeek (week, loser, percentage) VALUES ('".$currWeek."','".$loserName."','".$loserPercent."')";
		$sqlPurgeDurak = "UPDATE Durak SET numLosses = 0, numRounds = 0";
		
		if ($conn->query($sqlStoreWeekly) == TRUE){
			if ($conn->query($sqlPurgeDurak) == TRUE){
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
	}
?>