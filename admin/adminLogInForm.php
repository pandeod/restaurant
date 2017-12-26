<html>
<head>
<title>Admin LogIN</title>
</head>
<body>
  <center>
<h1>Admin LogIn </h1>
  <form method="post">
    <input list="adminName" name="aName">	
      <datalist id="adminName">
	  <?php include 'connectDB.php';?>
	  <?php 
	    $sql="select * from admin";
		$result=mysqli_query($db,$sql);
	   while($row=mysqli_fetch_array($result))
			{
		?>
		<option value="<?php echo $row['adminName']; ?> "> <?php echo $row['adminName']; ?></option>
		<?php
			}
		?>
      </datalist>
	  
	<br><br>
	<input type="password" placeholder="password" name="pwd"> <br><br>
	<button type="submit" name="submit">SUBMIT</button>
  </form>
  <?php include 'LogInValidate.php'?>
   </center>  
</body>
</html>