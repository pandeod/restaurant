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
    <input type="text" name="rName" placeholder="Restaurant Name"><br><br>
	<input type="text" name="location"> <br><br>
	<input type="text" name="oTable" placeholder="Enter Order Table Name"><br><br>
	<button type="submit" name="submit">SUBMIT</button>
  </form>

<?php
    if(isset($_POST['submit']))
	{
	  $rName=$_POST['rName'];
	  $loc=$_POST['location'];
	  $oTable=$_POST['oTable'];
	 
      include 'connectDB.php';
	  
	  $s="select orderTableName from resto where restoName='$oTable'";
	  $r=mysqli_query($db,$s);
	  $rw=mysqli_fetch_array($r);
	  
	  if($rw!=NULL)
	  {
		  echo "select different orderTableName .....click here <a href='createResto.php'>try again</a>";
	  }
	  else
	  {
		  
      $sql="select * from resto where restoName='$rName'";	  
	  $result=mysqli_query($db,$sql);
	  $row=mysqli_fetch_array($result);
	  
	  if($row!=NULL && $row['location']==$loc)
	  {
			 echo "Add some more info .....click here <a href='createResto.php'>try again</a>";
	  }
	  else
      {           
		 $sql="insert into resto(restoName,location,orderTableName) values('$rName','$loc','$oTable')";	  
	     $result=mysqli_query($db,$sql); 
		 if($result)
		 {   
	         $s1="create table $oTable (restoID int(11),orderID int(11))";
			 $r1=mysqli_query($db,$s1); 
			 if($r1)
			 echo "resto created .....click to <a href='createResto.php'> create another</a>";
		     else
			  echo "Table not created";
		 }
		 else
	     {
			 echo "Unable to create resto to retry .....<a href='createResto.php'>Click Here</a>"; 
		 }
	  }
     		  
	  }
    } 
?>
   </center>  
</body>
</html>