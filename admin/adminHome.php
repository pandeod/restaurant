<html>
<body>
<center>
<br>
<h2>Welcome ..<?php
 session_start();
 echo $_SESSION['adminName']; ?></h2>
<form method="post">
<button type="submit" name="logOut" style="float:right;">LogOut</button>
</form>
<br><br>
<a href="createAdmin.php"><button>Create Admin</button></a> <br><br>
<a href="createResto.php"><button>Create Restaurant</button></a> <br><br>
<a href="createRestoAdmin.php"><button>Create Restaurant Admin</button></a>
</center>
<?php
  if(isset($_POST['logOut']))
  {
	  session_unset();
	  session_destroy();
	  header("Location: adminLogInForm.php"); 
	  exit();	
  }
?>
</body>
</html>