
<?php
$db= mysqli_connect("localhost", "root", "", "aditya");

function show($table, $where = null, $order)
{
	global $db;
	$command = "SELECT * FROM $table  ORDER BY $order";
	if($where != null)
	{
		$command ="SELECT * FROM $table WHERE $where ORDER BY $order";
		}	
	$query = mysqli_query($db, $command) or die ($db->error);
	$row =array();
	while ($rows=mysqli_fetch_array($query, MYSQLI_BOTH))
	{
		$row[] =$rows;
		}
		return $row;
		mysqli_close ($db);
	}
?>