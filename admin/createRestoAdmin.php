<html>
<head>
<title>Create Restaurant Admin</title>
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

<h1>Create RestoAdmin </h1>
  <form method="post">
   	
      <select name="rName">
	  <?php include 'connectDB.php';?>
	  <?php 
	    $sql="select * from resto";
		$result=mysqli_query($db,$sql);
	   while($row=mysqli_fetch_array($result))
			{
		?>
		<option value="<?php echo $row['restoID']; ?> "> <?php echo $row['restoName']; ?></option>
		<?php
			}
		?>
      </select>
	 <br><br>
    <input type="text" name="aName" placeholder="Enter userName">
	<br><br>
	<input type="password" name="pwd" placeholder="Enter password"> <br><br>
	<button type="submit" name="submit">SUBMIT</button>
  </form>

<?php
    if(isset($_POST['submit']))
	{
	  $rID=$_POST['rName'];
	  $aName=$_POST['aName'];
	  $pwd=$_POST['pwd'];
	 
      include 'connectDB.php';
	  
      $sql="select restoadminName from restoadmin where restoadminName='$aName' and restoID='$rID'";	  
	  $result=mysqli_query($db,$sql);
      $row=mysqli_fetch_array($result);

	  if($row!=NULL)
	  {
		 echo "adminName already exists.....<a href='createRestoAdmin.php'>Click Here</a>"; 
	  }
	  else
      {
		 $sql="insert into restoadmin(restoID,restoadminName,pwd) values('$rID','$aName','$pwd')";	  
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