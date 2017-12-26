<html>
<head>
<title>Create Admin</title>
</head>
<body>
  <center>
  <br>
<h2>Welcome ..<?php
 session_start();
 echo $_SESSION['adminName']; ?></h2>
<form method="post">
<button type="submit" name="logOut" style="float:right;">LogOut</button>
</form>
<?php
  if(isset($_POST['logOut']))
  {
	  session_unset();
	  session_destroy();
	  header("Location: adminLogInForm.php"); 
	  exit();	
  }
?>

<h1>Create Admin </h1>
  <form method="post">
    <input type="text" name="aName">
	<br><br>
	<input type="password" name="pwd"> <br><br>
	<button type="submit" name="submit">SUBMIT</button>
  </form>

<?php
    if(isset($_POST['submit']))
	{
	  $aName=$_POST['aName'];
	  $pwd=$_POST['pwd'];
	 
      include 'connectDB.php';
	  
      $sql="select adminName from admin where adminName='$aName'";	  
	  $result=mysqli_query($db,$sql);
	  $row=mysqli_fetch_array($result);
	  
	  if($row!=NULL)
	  {
		 echo "adminName already exists.....<a href='createAdmin.php'>Click Here</a>"; 
	  }
	  else
      {
		 $sql="insert into admin(adminName,pwd) values('$aName','$pwd')";	  
	     $result=mysqli_query($db,$sql); 
		 if($result)
		 {
			 echo "admin created .....click to <a href='adminLogInForm.php'>Log In</a>";
		 }
		 else
	     {
			 echo "Unable to create admin to retry .....<a href='createAdmin.php'>Click Here</a>"; 
		 }
	  }
     
    } 
?>
   </center>  
</body>
</html>