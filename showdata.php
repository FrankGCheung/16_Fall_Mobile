<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Show the data</title>
        <link rel="stylesheet" href="css/style.css">
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>  
  <script type="text/javascript">
		$(document).ready(function(){
				  $("#refbtn").click(function(){
						var url="http://119.29.87.174/majax.php?show=123";
						$.get(url,function(data,status){
						    var mydata = JSON.parse(data);
						    document.getElementById("sensor_1").innerHTML = mydata['sensor_1'];
						    document.getElementById("sensor_2").innerHTML = mydata['sensor_2'];
						    document.getElementById("sensor_3").innerHTML = mydata['sensor_3'];
						    if(mydata['switch_1'] == 0){
							    document.getElementById("switch_1").innerHTML = 'Close';
							 }else{
								document.getElementById("swicth_1").innerHTML = 'Open';
							  }
						    if(mydata['switch_2'] == 0){
							    document.getElementById("switch_2").innerHTML = 'Close';
							 }else{
								document.getElementById("switch_2").innerHTML = 'Open';
							  }
						});
				});
			});
  </script>
  
</head>

<body>
  <div class="container">
  <h2>Notice:This page will show data and control switch</h2>
      <button id = "refbtn" class="btn btn-default">Refresh</button>
    <div class="well">
   <h3>Sensor Datas</h3>
	<table class="table table-hover">
    <thead>
      <tr >
        <th>ID</th>
        <th>SensorName</th>
        <th>Value</th>
      </tr>
    </thead>
    <tbody>
      <tr class="success">
        <td>1</td>
        <td>sensor_1</td>
        <?php 
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
        $sql = "select value from sensor ";
        $result = $conn->query($sql);
        if($result->num_rows >0 ){
        	$row = $result->fetch_assoc();
        	$sensor_1 = $row["value"];
        	$row = $result->fetch_assoc();
        	$sensor_2 = $row["value"];
        	$row = $result->fetch_assoc();
        	$sensor_3 = $row["value"]; 
        	echo "<td id = 'sensor_1'>".$sensor_1."</td>";
        }
        $sql = "select state from switch";
        $result = $conn->query($sql);
        
        if($result->num_rows >0 ){
        	$row = $result->fetch_assoc();
        	$switch_1 = $row["state"];
        	$row = $result->fetch_assoc();
        	$switch_2 = $row["state"];
        	}
        
        $conn->close();
        ?>
      </tr>      
      <tr class="success">
        <td>2</td>
        <td>sensor_1</td>
        <?php 
        echo "<td id = 'sensor_2'>".$sensor_2."</td>";
        ?>
      </tr>
      <tr class="success">
        <td>3</td>
        <td>sensor_3</td>
        <?php        	
        	echo "<td id = 'sensor_3'>".$sensor_3."</td>";
        ?>
      </tr>
    </tbody>
  </table>
  </div>
  
	<div class="well">
	<h3>Switch Data</h3>
  		<table class="table table-hover">
    		<thead>
      			<tr>
        			<th>ID</th>
        			<th>SwitchName</th>
        			<th>State</th>
      			</tr>
    		</thead>
    		<tbody>
      			<tr class="warning">
        			<td>1</td>
        			<td>switch_1</td>
        <?php 
        	if ($switch_1==0){
        		echo "<td id = 'switch_1'> close </td>";	 
        	}else{
        		echo "<td id = 'switch_1'> open </td>";
        }
        ?>
      			</tr>      
      			<tr class="warning">
        			<td>2</td>
        			<td>switch_2</td>
       <?php 
        if ($switch_2==0){
        	echo "<td id = 'switch_2'> close </td>";
        	 
        }else{
        	echo "<td id = 'switch_2'> open </td>";
        	 
        }
        ?>     
        </tr>
    </tbody>
  </table>
  </div>
  
  <div class = "well">
  <h4>Switch_1</h4>
  <form method="post" action="showdata.php">
    <div class="checkbox">
      <label><input type="checkbox" name="switch_1_open" value="Open">Open</label>
    </div>
    <div class="checkbox">
      <label><input type="checkbox" name="switch_1_close" value="Close">Close</label>
    </div>
    <button type="submit" class="btn btn-default">Submit</button>
  </form>
  </div>
  
  <div class = "well">
    <h4>Switch_1</h4>
  <form method="post" action="showdata.php">
    <div class="checkbox">
      <label><input type="checkbox" name="switch_2_open" value="Open">Open</label>
    </div>
    <div class="checkbox">
      <label><input type="checkbox" name="switch_2_close" value="Close">Close</label>
    </div>
    <button type="submit" class="btn btn-default">Submit</button>
  </form>
  </div>
  
</div>
  <?php
	if($_SERVER['REQUEST_METHOD']=='POST') 
{
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
   if (isset($_POST['switch_1_open'])&&$_POST['switch_1_open'] == 'Open')
   {
   	
   	$sql = "update switch set state = 1 where id = 1";
   	$result = $conn->query($sql);
   }
   if (isset($_POST['switch_1_close'])&&$_POST['switch_1_close'] == 'Close')
   {
   	$sql = "update switch set state = 0 where id = 1";
   	$result = $conn->query($sql);
   }
   if (isset($_POST['switch_2_open'])&&$_POST['switch_2_open'] == 'Open')
   {
   	$sql = "update switch set state = 1 where id = 2";
   	$result = $conn->query($sql);
   }
   if (isset($_POST['switch_2_close'])&&$_POST['switch_2_close'] == 'Close')
   {
   	$sql = "update switch set state = 0 where id = 2";
   	$result = $conn->query($sql);
   }
   $conn->close();
}
?>
    <script src="js/index.js"></script>

</body>
</html>
