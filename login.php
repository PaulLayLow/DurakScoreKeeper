<?php
					session_start();
					$error='';
					
					//Name of server and credentials
					$host = ""; 
					$user = "";
					$pass = "";
					$db = "";

					//Connection code
					$conn = new mysqli($host, $user, $pass, $db);
					if ($conn->connect_error) {
						die("Connection failed: " . $conn->connect_error);
					} 
?>