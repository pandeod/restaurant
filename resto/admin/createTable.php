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

<h1>Create Table </h1>
  <form method="post">
    <input type="text" name="tName" placeholder="Enter Table Name">
	<br><br>
	<input type="password" name="pwd" placeholder="Enter password"> <br><br>
	<button type="submit" name="submit">SUBMIT</button>
  </form>

<?php
    if(isset($_POST['submit']))
	{
	  $tName=$_POST['tName'];
	  $pwd=$_POST['pwd'];
	  $rID=$_SESSION['rID'];
      $db=mysqli_connect('localhost','root','','restomanagement') or die("Error connecting to database");

      $sql="select restotableName from restotable where restotableName='$tName'";	  
	  $result=mysqli_query($db,$sql);
	  $row=mysqli_fetch_array($result);
	  
	  if($row!=NULL)
	  {
		 echo "tableName already exists.....<a href='createTable.php'>Click Here</a>"; 
	  }
	  else
      {
		 $sql="insert into restotable(restoID,restotableName,pwd) values('$rID','$tName','$pwd')";	  
	     $result=mysqli_query($db,$sql); 
		 if($result)
		 {
			 echo "table created .....";
		 }
		 else
	     {
			 echo "Unable to create table to retry .....<a href='createTable.php'>Click Here</a>"; 
		 }
	  }
     
    } 
?>
</center>
</body>
<?php
  if(isset($_POST['logOut']))
  {
	  session_unset();
	  session_destroy();
	  header("Location: ../restoLogInForm.php"); 
	  exit();	
  }
?>
</html>