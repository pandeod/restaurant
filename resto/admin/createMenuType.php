<html>
<head>
<title>Create Menu Type</title>
</head>
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

<h1>Create Menu Type </h1>
  <form method="post">
    <input type="text" name="tName" placeholder="Enter Menu Type">
	<br><br>
   <button type="submit" name="submit">SUBMIT</button>
  </form>

<?php
    if(isset($_POST['submit']))
	{
	  $tName=$_POST['tName'];
	  $rID=$_SESSION['rID'];
      $db=mysqli_connect('localhost','root','','restomanagement') or die("Error connecting to database");

      $sql="select menuType from menutype where menuType='$tName'";	  
	  $result=mysqli_query($db,$sql);
	  $row=mysqli_fetch_array($result);
	  
	  if($row!=NULL)
	  {
		 echo "Menu Type already exists.....<a href='createMenuType.php'>Click Here</a>"; 
	  }
	  else
      {
		 $sql="insert into menutype(restoID,menuType) values('$rID','$tName')";	  
	     $result=mysqli_query($db,$sql); 
		 if($result)
		 {
			 echo "Menu Type is created .....";
		 }
		 else
	     {
			 echo "Unable to create table to retry .....<a href='createMenuType.php'>Click Here</a>"; 
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