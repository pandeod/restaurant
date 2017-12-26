<?php
if(isset($_POST['submit']))
{
	  $aName=$_POST['aName'];
	  $pwd=$_POST['pwd'];
	 session_start();    
     include 'connectDB.php';	 
	 
	 $sql="select * from admin where adminName='$aName'";
     $result=mysqli_query($db,$sql);
	 $row=mysqli_fetch_array($result);

    if($row!=NULL)
    {
	    if($row['pwd']==$pwd)
	   {   
		  $_SESSION["adminName"]=$aName;
		  header("Location: adminHome.php"); 
		  exit();	 
	   }
	   else
	   {    
		echo "<br><br>Enter valid details..to try again click<a href='adminLogInForm.php'>here</a> ";
	   }
    }
    else
   {  
     echo "<br><br>Enter valid details..to try again click<a href='adminLogInForm.php'>here</a> ";
   }
} 
   ?>