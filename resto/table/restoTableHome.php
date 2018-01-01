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
<a href="createTable.php"><button>Create Table LogIn</button></a> <br><br>
<a href="createKitchen.php"><button>Create Kitchen LogIn</button></a> <br><br>
<a href="createMenu.php"><button>Add Menu</button></a>
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