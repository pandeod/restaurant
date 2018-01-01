<html>
<body>
<center>
<br>
<h2 style="float : left;">
<?php
 session_start();
 echo $_SESSION['restoName']; 
 echo "<br>";
 echo $_SESSION['location'];
 ?> 
</h2> 
<br><br>
<form method="post">
<button type="submit" name="logOut" style="float:right;">LogOut as:<?php echo $_SESSION['user']; ?> </button>
</form>
<br><br><br>


<h1>Create kitchen </h1>
  <form method="post">
    <input type="text" name="kName" placeholder="Enter Kitchen Name">
	<br><br>
	<input type="password" name="pwd" placeholder="Enter password"> <br><br>
	<button type="submit" name="submit">SUBMIT</button>
  </form>

<?php
    if(isset($_POST['submit']))
	{
	  $kName=$_POST['kName'];
	  $pwd=$_POST['pwd'];
	  $rID=$_SESSION['rID'];
      $db=mysqli_connect('localhost','root','','restomanagement') or die("Error connecting to database");

      $sql="select restokitchenName from restokitchen where restokitchenName='$kName'";	  
	  $result=mysqli_query($db,$sql);
	  $row=mysqli_fetch_array($result);
	  
	  if($row!=NULL)
	  {
		 echo "kitchenName already exists.....<a href='createkitchen.php'>Click Here</a>"; 
	  }
	  else
      {
		 $sql="insert into restokitchen(restoID,restokitchenName,pwd) values('$rID','$kName','$pwd')";	  
	     $result=mysqli_query($db,$sql); 
		 if($result)
		 {
			 echo "kitchen created .....";
		 }
		 else
	     {
			 echo "Unable to create kitchen to retry .....<a href='createkitchen.php'>Click Here</a>"; 
		 }
	  }
     
    } 
?>

</center>
<?php
  if(isset($_POST['logOut']))
  {
	  session_unset();
	  session_destroy();
	  header("Location: ../restoLogInForm.php"); 
	  exit();	
  }
?>
</body>
</html>