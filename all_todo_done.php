<?php
	if ($_SERVER ["REQUEST_METHOD"] == "GET") {
		include 'get_db_con.php';
		include 'json_encode.php';
		include 'clean_input.php';
		
		$sql ="SELECT * FROM todos";
		$resultset = $conn->query ( $sql);

		
		while($row = mysqli_fetch_assoc($resultset)){
			$sql2 = "INSERT INTO done_todo VALUES('".$row["todos"]."','".$row["description"]."')";
			$resultset2 = $conn->query ( $sql2);
			
		}
		$sql1 ="DELETE FROM todos";
		$resultset1 = $conn->query ( $sql1 );
		
		include 'close_db_con.php';
		echo "todo done";
}	
	
?>