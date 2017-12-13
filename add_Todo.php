<?php
if ($_SERVER ["REQUEST_METHOD"] == "GET") {
	include 'get_db_con.php';
	include 'json_encode.php';
	include 'clean_input.php';
	
	$keyword = clean_input ( $_GET ["keyword"] );
	$description = clean_input ( $_GET ["description"] );
	if(!$keyword == "" && !$description == "")
	{
		
		$sql = "INSERT INTO todos Values('".$keyword."','".$description."')";
		$resultset = $conn->query ( $sql );
		
		
	}
	$sql1 = "SELECT todos,description FROM todos";
	$resultset1 = $conn->query($sql1);
	$rs = array ();
	$rs = addToArr($resultset1,$rs);
	$json_data = json_encode ( $rs );
	echo $json_data;

	include 'close_db_con.php';
}
?>