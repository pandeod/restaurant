<html>
<head>
<title>Resto Table Home</title>
<script type="text/JavaScript">
</script>	
<style>
  #menuTypeDiv:hover{
	  background-color:lightgrey;
  }
</style>
</head>
<body>
<center>
<div style="border:1px solid black; height:20%;">
<h2 style="float : left;margin-top:30px;">
<?php
 session_start();
 echo $_SESSION['restoName']; 
 echo "<br>";
 echo $_SESSION['location'];
 ?> 
</h2> 
<?php
  if(isset($_POST['logOut']))
  {
	  session_unset();
	  session_destroy();
	  header("Location: ../restoLogInForm.php"); 
	  exit();	
  }
?>
<br><br>
<form method="post">
<button type="submit" name="logOut" style="float:right;">LogOut as:<?php echo $_SESSION['user']; ?></button>
</form>
</div>

<form method="post">
<select multiple name="menuList[]">
	  <?php 
	 $rID=$_SESSION["rID"];  
     $db=mysqli_connect('localhost','root','','restomanagement') or die("Error connecting to database");
	    $sql="select DISTINCT * from menu,restomenu where (restoID='$rID' and menu.menuID=restomenu.menuID )";
		$result=mysqli_query($db,$sql);
	   while($row=mysqli_fetch_array($result))
			{
		?>
	<option value="<?php echo $row['menuID']; ?> "><?php echo $row['menuName']; ?></option>
		<?php
			}
		?>
</select><br><br>

<input type="submit" name="showList" value="Move Items to Cart">

</form>
<form method="post">
<ul>
<?php
  if(isset($_POST['showList']))
  {
	if(isset($_POST['menuList']))
   {
	 foreach($_POST['menuList'] as $menuID)   
	 {
		$sql="select * from menu where menuID='$menuID'";
		$result=mysqli_query($db,$sql);
	    $row=mysqli_fetch_array($result);
		
		$x=array();
		array_push($x,$menuID);
?>
 <li> 
    <span style="margin:20px;"> <?php echo $row['menuName'] ?>  </span>
	<span style="margin:20px;"> <?php echo $row['price'] ?> </span>
	<span style="margin:20px;"> <input name="orderMenuID[]" type="number" min="0" > </span>
 </li>  <br>
<?php		
	 }
	 $totalItems=count($x);
	 $_SESSION['totalItems']=$totalItems;
   }
   else
   {
	   echo "Select atleast one item !!!";
   }
  }
?> 
 </ul>
<input type="submit" name="confirmOrder" value="Confirm Order">
</form> 

 <ol>
 <?php
   if(isset($_POST['confirmOrder']))
   {
	   for($i=0;$i<$_SESSION['totalItems'];$i=$i+1)
	   { 
	     $orderMenuID = $_POST['orderMenuID'][i];
	     $quantity=$orderMenuID;
		 $sql="select * from menu where menuID='$orderMenuID'";
		 $result=mysqli_query($db,$sql);
	     $row=mysqli_fetch_array($result);		 
  ?>
  <li> 
    <span style="margin:20px;"> <?php echo $row['menuName']; ?>  </span>
	<span style="margin:20px;"> <?php echo $row['price']; ?> </span>
	<span style="margin:20px;"> <?php echo $quantity; ?> </span>
 </li>  <br>
<?php  
	   }
   }
 ?>
 </ol>
 </center>
</body>
</html>