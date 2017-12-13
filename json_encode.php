<?php
function reToJson($mysql_result) {
	$rs = array ();
	
	while ( $row = mysqli_fetch_array ( $mysql_result, MYSQLI_ASSOC ) ) {
		$rs [] = $row;
	}
	return $rs;
}

function addToArr($mysql_result,$rs) {
	
	while ( $row = mysqli_fetch_array ( $mysql_result,MYSQLI_ASSOC ) ) {
		$rs [] = $row;
	}
	return $rs;
}
?>