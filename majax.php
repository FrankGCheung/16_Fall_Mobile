<?php 
if ($_SERVER['REQUEST_METHOD'] == "GET" && $_GET['show'] == 123){
	$username = "root";
	$servername = "localhost";
	$passwd = "960724";
	$mydb = "house";
	
	//Create connection
	$conn = new mysqli($servername,$username, $passwd,$mydb);
	
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	
	$sql = "select value from sensor ";
	$result = $conn->query($sql);
	if($result->num_rows >0 ){
		$row = $result->fetch_assoc();
		$sensor_1 = $row["value"];
		
		$row = $result->fetch_assoc();
		$sensor_2 = $row["value"];
		$row = $result->fetch_assoc();
		$sensor_3 = $row["value"];
	}
	$sql = "select state from switch";
	$result = $conn->query($sql);
	
	if($result->num_rows >0 ){
		$row = $result->fetch_assoc();
		$switch_1 = $row["state"];
		$row = $result->fetch_assoc();
		$switch_2 = $row["state"];
	}
	$arr = array('sensor_1'=>$sensor_1,'sensor_2'=>$sensor_2,'sensor_3'=>$sensor_3,'switch_1'=>$switch_1,'switch_2'=>$switch_2);
	$conn->close();
	echo json_encode($arr);
	
}

?>