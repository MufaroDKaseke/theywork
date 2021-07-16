<?php
$server_name = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "theywork";

// Create connection
$conn = mysqli_connect($server_name, $db_username, $db_password, $db_name);
// Check connection
if (!$conn) {
    die("Connection failed: " . $conn->connect_error);
} 

/* else {
	echo "Connection Sucessfull!!!";
} */


/*

***Test***

**Note that you are using MySQLi Procedural for database connections and operations.**


- Add else block to the if statement to see if connection succedded
- Research on other reliable test.
*/

?>