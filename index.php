<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Simple login form</title>
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">

  
      <link rel="stylesheet" href="css/style.css">

  
</head>

<body>
  <div class="container">
  <div class="login">
  	<h1 class="login-heading">
      <strong>Welcome.</strong> Please login.</h1>
      <form method="post" action="index.php">
        <input type="text" name="username" placeholder="Username" required="required" class="input-txt" />
          <input type="password" name="password" placeholder="Password" required="required" class="input-txt" />
          <div class="login-footer">
             <a href="#" class="lnk">
              <span class="icon icon--min">ಠ╭╮ಠ</span> 
              I've forgotten something
            </a>
            <button type="submit" class="btn btn--right">Sign in  </button>
    
          </div>
      </form>
  </div>
</div>
  <?php 
if($_SERVER['REQUEST_METHOD']=='POST') 
{
  $username = $_POST['username'];
  $password = $_POST['password'];
  if ($username == "frank" && $password == "960724") {
    session_start();
    $_SESSION['frank'] = true;
    $url = "Location:"."http://".$_SERVER['HTTP_HOST']."/showdata.php";
    echo "<script> alert('".$url."') </script>";
    Header($url); 
	//Header("Location:"."https://www.baidu.com"); 
  } else {
    echo "<script>alert('Please input correct account and password');</script>";
  }
  
}

?>
    <script src="js/index.js"></script>

</body>
</html>