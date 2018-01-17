<html>
<head>
<title>Resto Table Home</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<style>
  #menuTypeDiv:hover{
    background-color:lightgrey;
  }
</style>`
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
 $total=0;
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
	 $_SESSION['mTypeID']=$menuTypeID;
     $rID=$_SESSION["rID"];  
     $db=mysqli_connect('localhost','root','','restomanagement') or die("Error connecting to database");

    $menuList="select DISTINCT * from menu,restomenu where ( restomenu.menuID=menu.menuID and restoID='$rID' and menuTypeID='$menuTypeID' )";
  $getList=mysqli_query($db,$menuList);
  while($row=mysqli_fetch_array($getList))
  {
        $mID=$row['menuID'];
  ?>
   <table id="menuTypeDiv" style="width:100%;height:40%">
  <tr>
     <td rowspan="3" style="width:40%;height:100%;background-size: 100%; background-image:url('../admin/<?php echo $row['path']; ?>'); background-repeat:no-repeat;"></td>
   <td style="padding-left:5%;"><?php echo $row['menuName']; ?></td>
   <td rowspan="3"><input id="<?php echo 'quantity'.$mID ?>" name="quantity" type="number"/> </td>
   <td rowspan="3">
    <a href="restoTableHome.php?menuTypeID=<?php echo $row['menuTypeID']; ?>&action=<?php echo $mID; ?>"><button id="addToCart" name="addToCart">Add to Cart</button>
    </a>
   </td>
   </tr>
   <tr>
   <td style="padding-left:5%;"><?php echo $row['price']; ?></td>
   </tr>
   <tr>
   <td style="padding-left:5%;"><?php echo $row['discription']; ?></td>
   </tr>
 </table>
 <script>
    var q=document.getElementById(<?php echo "quantity".$mID; ?>).value();
	alert("Hello");
   </script>
<?php  
    if(isset($_GET['action']))
	{
	  if($_GET['action']==$mID)
	 { 
 ?>
   <?php echo "quantity".$mID; ?>
 <?php
        $str="<script>document.write(q)</script>";
		//$q=5;
		$d=(int)$str;
		echo $str;
		updateToList($_GET['action'],$d);
     }	
	}		 
  }
 }   
  ?> 
  </div>
</div>
<?php
 function updateToList($a,$q)
	{
	  $compare=0;
	  
	  foreach($_SESSION['menuList'] as $mid)
	  {
		if($mid == $a)
		{
          $compare=1;
        }		  
	  } 
	  if($compare!=1)
	  {
		array_push($_SESSION['menuList'],$a);
	    array_push($_SESSION['menuQuantity'],$q);  
	  }
	}
?>
<br>
<br><br>

<?php 
   if(count($_SESSION['menuList'])!=0)
   {
?>
<a href="restoTableHome.php?menuTypeID=1&removeAll=true">
<button>Remove all Elements</button>
</a>
<table border="1">
  <tr>
    <td>Name</td>
  <td>Price</td>
  <td>Quantity</td>
  <td>Total</td>
  <td></td>
  </tr>
 <?php
   for($i=0;$i<count($_SESSION['menuList']);$i++)
   {
	   
    $mID=$_SESSION['menuList'][$i];
    $Quantity=$_SESSION['menuQuantity'][$i];
    
    $mList="select * from menu where menuID='$mID'";
    $gList=mysqli_query($db,$mList);
      $rw=mysqli_fetch_array($gList);
    
    $mName=$rw['menuName'];
    $p=$rw['price'];
    $t=$Quantity*$p;
    
    $total+=$t;
?>
  <tr>
    <td><?php echo $mName; ?></td>
  <td><?php echo $p; ?></td>
  <td><?php echo $Quantity; ?></td>
  <td><?php echo $t;?></td>
  <td>
  <a href="restoTableHome.php?menuTypeID=<?php echo $_SESSION['mTypeID']; ?>&remove=<?php echo $i; ?>&removeMenuID=<?php echo $mID; ?>">
   <button>Remove</button>
    </a>
  </td>
  </tr>
<?php    
   }
 ?>
</table>
<br><br>
<?php
  echo "Total Bill =".$total;
   
   }
?>
<?php
 if(isset($_GET['remove']))
 {
	$_SESSION['menuList']=array_values($_SESSION['menuList']);
	$_SESSION['menuQuantity']=array_values($_SESSION['menuQuantity']);
	
	 $j=$_GET['remove'];
    if(count($_SESSION['menuList'])!=$j && count($_SESSION['menuList'])!=0 && $_GET['removeMenuID']==$_SESSION['menuList'][$j])
	{		
	 unset($_SESSION['menuList'][$j]);
	 unset($_SESSION['menuQuantity'][$j]);
	 
	 $_SESSION['menuList']=array_values($_SESSION['menuList']);
	 $_SESSION['menuQuantity']=array_values($_SESSION['menuQuantity']);
	 $total=0;
?>  <script>location.reload();</script>
<?php
	}		
 }
?>
<?php  
    if(isset($_GET['removeAll']))
	{
	  for($j=0;$j<count($_SESSION['menuList']);$j++)
     {	 
		unset($_SESSION['menuList'][$j]);
		unset($_SESSION['menuQuantity'][$j]);
?>  <script>location.reload();</script>
<?php	
        $total=0;	
		$_SESSION['menuList']=array();
		$_SESSION['menuQuantity']=array();	
	 }
	}		   
  ?> 
<div>  
 <center><a href="restoTableOrder.php"><button type="button" style="margin:10px;padding:10px;">Proceed to Order</button></a> </center>
</div>
</body>
</html>