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
 $menuTypeID=1;
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
</center>
<div style="width:100%;height:80%;border:1px solid black;">
  <div style="width:25%;height:100%;float:left;border:1px solid black;overflow-y: scroll;">
	  <?php 
	 $rID=$_SESSION["rID"];  
     $db=mysqli_connect('localhost','root','','restomanagement') or die("Error connecting to database");
	    $sql="select * from menutype where restoID='$rID'";
		$result=mysqli_query($db,$sql);
	   while($row=mysqli_fetch_array($result))
			{
		?>
	<a href="restoTableHome.php?menuTypeID=<?php echo $row['menuTypeID']; ?> "><div id="menuTypeDiv" style="width:100%+1px;border:1px solid black;padding:20px;"><?php echo $row['menuType']; ?></div></a>
	<a href="restoTableHome.php?menuTypeID=<?php echo $row['menuTypeID']; ?> "><div id="menuTypeDiv" style="width:100%+1px;border:1px solid black;padding:20px;"><?php echo $row['menuType']; ?></div></a>
		<?php
			}
		?>
  </div>
  <div style="width:74%;height:100%;float:right;border:1px solid blue;overflow-y: scroll;">
  <?php  
  if (isset($_GET['menuTypeID'])) {
    showMenu($_GET['menuTypeID']);
  }
 ?>
  <?php
  function showMenu($menuTypeID) {
     $rID=$_SESSION["rID"];  
     $db=mysqli_connect('localhost','root','','restomanagement') or die("Error connecting to database");

    $menuList="select DISTINCT * from menu,restomenu where ( restomenu.menuID=menu.menuID and restoID='$rID' and menuTypeID='$menuTypeID' )";
	$getList=mysqli_query($db,$menuList);
	   while($row=mysqli_fetch_array($getList))
			{
  ?>
   <table id="menuTypeDiv" style="width:100%;height:40%">
  <tr>
     <td rowspan="4" style="width:40%;height:100%;background-size: 100%; background-image:url('../admin/<?php echo $row['path']; ?>'); background-repeat:no-repeat;"></td>
	 <td style="padding-left:5%;"><?php echo $row['menuName']; ?></td>
   </tr>
   <tr>
	 <td style="padding-left:5%;"><?php echo $row['price']; ?></td>
   </tr>
   <tr>
	 <td style="padding-left:5%;"><?php echo $row['discription']; ?></td>
   </tr>
 </table>
 <?php  
			}
  }
  ?>
  </div>
</div>
<div>  
 <center><a href="restoTableOrder.php"><button type="button" style="margin:10px;padding:10px;">Proceed to Order</button></a> </center>
</div>
</body>
</html>