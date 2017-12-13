<?php
	if ($_SERVER ["REQUEST_METHOD"] == "GET") {
		include 'get_db_con.php';
		include 'json_encode.php';
		include 'clean_input.php';
		$todo = clean_input( $_GET ["todo"] );
		$description = clean_input( $_GET ["description"] );
		$sql = "INSERT INTO done_todo VALUES('".$todo."','".$description."')";
		$sql1 ="DELETE FROM todos WHERE todos ='".$todo."' AND  description = '".$description."'" ;
		$resultset = $conn->query ( $sql );
		$resultset1 = $conn->query ( $sql1 );
		$sql2 = "SELECT todos,description FROM todos";
		$resultset2 = $conn->query($sql2);
		$rs = array ();
		$rs = addToArr($resultset2,$rs);
		$json_data = json_encode ( $rs );
		echo $json_data;
		include 'close_db_con.php';
}	
	
?>