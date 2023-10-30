<?php session_start();
error_reporting(0);

include_once("connect_pdo.php");

if(isset($_POST['submit'])){
$login=$_POST['login'];
$password=$_POST['password'];
$sql ="SELECT  * FROM user WHERE login=:login and pass=:pass";
$query= $dbh -> prepare($sql);
$query-> bindParam(':login', $login, PDO::PARAM_STR);
$query-> bindParam(':pass', $password, PDO::PARAM_STR);
$query-> execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

if($query->rowCount() > 0){
    echo "<script>alert('Welcome, you logged in !');</script>";
    echo "<script type='text/javascript'> document.location = 'formulaire.php'; </script>";
	}else{
        echo "<script>alert('Invalid login :( ');</script>";
    }
$_SESSION['login']= $login;
}
?>
<?php 
$host = gethostname();
setcookie('host_device', $host, time() + 31536000); // cookie expires after a year
if (isset($_COOKIE['host_device'])) {
  $host_device = $_COOKIE['host_device'];
  echo "<h3 style='font-family:arial; margin:15px ;'>The name of the host device is:  $host_device</h3>";
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login page</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
  

<div class="login-box">
  <h2>Login</h2>
  
  <form method="post">
    <div class="user-box">
      <input type="text" name="login" required="true">
      <label>Login</label>
    </div>
    <div class="user-box">
      <input type="password" name="password" required="true">
      <label>Password</label>
    </div>
    <div id="submit">
      <button type="submit" name="submit">Submit</button>
    </div>
  </form>
</div>
</body>
</html>