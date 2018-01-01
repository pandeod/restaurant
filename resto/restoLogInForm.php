<html>
<head>
<title>Restaurant LogIn</title>
</head>
<body>
  <center>
  <br>

<h1>Restaurant LogIn</h1>
  <form method="post">
   	
    Restaurant:  <select name="rName">
	  <?php 
     $db=mysqli_connect('localhost','root','','restomanagement') or die("Error connecting to database");
	    $sql="select * from resto";
		$result=mysqli_query($db,$sql);
	   while($row=mysqli_fetch_array($result))
			{
		?>
		<option value="<?php echo $row['restoID']; ?> "> <?php echo $row['restoName']; ?></option>
		<?php
			}
		?>
      </select>
	 <br><br>
	LogIN to: <select name="logType">
	  <option value="1">Restaurant admin</option>
	  <option value="2">Table</option>
	  <option value="3">Kitchen</option>
	  </select> <br><br>
    <input type="text" name="uName" placeholder="Enter userName">
	<br><br>
	<input type="password" name="pwd" placeholder="Enter password"> <br><br>
	<button type="submit" name="submit">SUBMIT</button>
  </form>

<?php
    if(isset($_POST['submit']))
	{
	  session_start();
	  $rID=$_POST['rName'];
	  $logType=$_POST['logType'];
	  $uName=$_POST['uName'];
	  $pwd=$_POST['pwd'];
	  
	  $db=mysqli_connect('localhost','root','','restomanagement') or die("Error connecting to database");

	  if($logType==1)
	  {
		  $sql="select * from restoadmin where restoadminName='$uName' and restoID='$rID'";	  
	      $result=mysqli_query($db,$sql);
          $row=mysqli_fetch_array($result);
		  if($row!=NULL)
		  {
		     if($row['pwd']==$pwd)
		    {   
		        $s="select * from resto where restoID='$rID'";
		        $res=mysqli_query($db,$s);
	            $rw=mysqli_fetch_array($res);
                if($rw!=NULL)
				{ 
			      $_SESSION["rID"]=$rID;
				  $_SESSION["restoName"]=$rw['restoName'];
				  $_SESSION["location"]=$rw['location'];
				  $_SESSION["user"]=$uName;	
				}
				
			    header("Location:admin/restoAdminHome.php");
				exit();
		    } 
        	 else
	        {
			  echo "Enter valid LogIn credentials !!!";
		    }		
		  }
		  else
	      {
			  echo "Enter valid LogIn credentials !!!";
		  }		  
	  }

	  if($logType==2)
	  {
		  $sql="select * from restotable where restotableName='$uName' and restoID='$rID'";	  
	      $result=mysqli_query($db,$sql);
          $row=mysqli_fetch_array($result);
		  if($row!=NULL)
		  {
		     if($row['pwd']==$pwd)
		    {   
		        $s="select * from resto where restoID='$rID'";
		        $res=mysqli_query($db,$s);
	            $rw=mysqli_fetch_array($res);
                if($rw!=NULL)
				{ 
			      $_SESSION["rID"]=$rID;
				  $_SESSION["restoName"]=$rw['restoName'];
				  $_SESSION["location"]=$rw['location'];
				  $_SESSION["user"]=$uName;	
				}
				
			    header("Location:table/restoTableHome.php");
				exit();
		    } 
        	 else
	        {
			  echo "Enter valid LogIn credentials !!!";
		    }		
		  }
		  else
	      {
			  echo "Enter valid LogIn credentials !!!";
		  }		  
	  }

	  if($logType==3)
	  {
		  $sql="select * from restokitchen where restokitchenName='$uName' and restoID='$rID'";	  
	      $result=mysqli_query($db,$sql);
          $row=mysqli_fetch_array($result);
		  if($row!=NULL)
		  {
		     if($row['pwd']==$pwd)
		    {   
		        $s="select * from resto where restoID='$rID'";
		        $res=mysqli_query($db,$s);
	            $rw=mysqli_fetch_array($res);
                if($rw!=NULL)
				{ 
			      $_SESSION["rID"]=$rID;
				  $_SESSION["restoName"]=$rw['restoName'];
				  $_SESSION["location"]=$rw['location'];
				  $_SESSION["user"]=$uName;	
				}
				
			    header("Location:kitchen/restoKitchenHome.php");
				exit();
		    } 
        	 else
	        {
			  echo "Enter valid LogIn credentials !!!";
		    }		
		  }
		  else
	      {
			  echo "Enter valid LogIn credentials !!!";
		  }		  
	  }
	  	  
   } 
?>
   </center>  
</body>
</html>