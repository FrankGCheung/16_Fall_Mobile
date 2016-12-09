<?php
/*
 * This program is applied to update the correspondence datas and states of sensor or switch
 * */
if ($_POST["token"] == "passwd") {
	$sensor_1 = $_POST['sensor_1'];
	$sensor_2 = $_POST['sensor_2'];
	$sensor_3 = $_POST['sensor_3'];
	$servername = "localhost";
	$username = "root";
	$passwd = "960724";
	$mydb = "house";
	//Create connection
	$conn = new mysqli($servername,$username, $passwd,$mydb);
	if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
	} 
	//Check connection
	if($conn->connect_errno){
		echo "dassadsda";
		die("Connection failed: ".$conn->connect_error);
	}
	//update the sensor data of database*/
	$sql = "update sensor set vaule=".$sensor_1." where id = 1";
	$conn->query($sql);
	$sql = "update sensor set vaule=".$sensor_2." where id = 2";
	$conn->query($sql);
	$sql = "update sensor set vaule=".$sensor_3." where id = 3";
	$conn->query($sql);
	//fetch the switch state */
	$sql = "select state from switch";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		$row = $result->fetch_assoc();
		$switch_1 = $row["state"];
		$row = $result->fetch_assoc();
		$switch_2 = $row['state'];
	}
	//return back the sensor states with post format
	$jarr = array('switch_1'=>$switch_1,'switch_2'=>$switch_2);
	$jdata = json_encode($jarr);
	echo $jdata;
	$conn->close();
	
}else{
    echo $_POST['token'];
	echo "Permission Denied";
}
?>
