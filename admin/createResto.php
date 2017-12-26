<html>
<head>
<title>Create Restaurant</title>
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

<h1>Create Restaurant </h1>
  <form method="post">
    <input type="text" name="rName">
	<br><br>
	<input type="text" name="location"> <br><br>
	<button type="submit" name="submit">SUBMIT</button>
  </form>

<?php
    if(isset($_POST['submit']))
	{
	  $rName=$_POST['rName'];
	  $loc=$_POST['location'];
	 
      include 'connectDB.php';
	  
      $sql="select * from resto where restoName='$rName'";	  
	  $result=mysqli_query($db,$sql);
	  $row=mysqli_fetch_array($result);
	  
	  if($row!=NULL && $row['location']==$loc)
	  {
			 echo "Add some more info .....click here <a href='createResto.php'>try again</a>";
	  }
	  else
      {
		 $sql="insert into resto(restoName,location) values('$rName','$loc')";	  
	     $result=mysqli_query($db,$sql); 
		 if($result)
		 {
			 echo "resto created .....click to <a href='createResto.php'> create another</a>";
		 }
		 else
	     {
			 echo "Unable to create resto to retry .....<a href='createResto.php'>Click Here</a>"; 
		 }
	  }
     
    } 
?>
   </center>  
</body>
</html>