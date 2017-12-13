<?php
	if ($_SERVER ["REQUEST_METHOD"] == "GET") {
		include 'get_db_con.php';
		include 'json_encode.php';
		include 'clean_input.php';
		$todo = clean_input( $_GET ["todo"] );
		$description = clean_input( $_GET ["description"] );
		$sql ="DELETE FROM done_todo WHERE todo ='".$todo."' AND description ='".$description."'  ";
		$resultset = $conn->query ( $sql );
		$sql1 = "SELECT todo,description FROM done_todo";
		$resultset1 = $conn->query($sql1);
		$rs = array ();
		$rs = addToArr($resultset1,$rs);
		$json_data = json_encode ( $rs );
		echo $json_data;
		include 'close_db_con.php';
	}	
	
?>