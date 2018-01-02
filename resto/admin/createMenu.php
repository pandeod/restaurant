<html>
<head>
<title>Create Menu</title>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script type="text/javascript">
   function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
        $('#test').attr('src', e.target.result);
       }
        reader.readAsDataURL(input.files[0]);
       }
    }
</script>
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
<button type="submit" name="logOut" style="float:right;">LogOut as:<?php echo $_SESSION['user']; ?> </button>
</form>
<br><br><br>

<h3> Create Menu </h3> <br>
<form enctype="multipart/form-data" method="post">

	<input type="text" placeholder="Enter name " name="menuName"> <br><br>
	Choose Menu Pic: <br><br>
	<input onchange="readURL(this);" name="file" type="file" /> <br><br>
    <img alt="Image Display Here" id="test" src="#" style="height:300px;width:300px;border:1px solid black;"/> <br><br>
	<input type="text" placeholder="menu Price" name="price"> <br><br>
	<select name="menuTypeID">
	  <?php 
	  $rID=$_SESSION["rID"];
	  
     $db=mysqli_connect('localhost','root','','restomanagement') or die("Error connecting to database");
	    $sql="select * from menutype where restoID='$rID'";
		$result=mysqli_query($db,$sql);
	   while($row=mysqli_fetch_array($result))
			{
		?>
		<option value="<?php echo $row['menuTypeID']; ?> "> <?php echo $row['menuType']; ?></option>
		<?php
			}
		?>
	</select> <br><br>
	Discription : <br>
	<textarea name="discription">
	 Something about food.....
	</textarea> <br><br>
<input name="submit" type="submit" value="Upload Menu">
</form>

<?php
 if(isset($_POST['submit']))
 {   	 
     $menuName=$_POST['menuName'];
	 $price=$_POST['price'];
	 $discription=$_POST['discription'];
	 $rID=$_SESSION["rID"];
	 $menuTypeID=$_POST['menuTypeID'];
     $db=mysqli_connect('localhost','root','','restomanagement') or die("Error connecting to database");
     
	 $tableName="select * from resto where restoID='$rID'";
     $res=mysqli_query($db,$tableName);
	 $rw=mysqli_fetch_array($res);
	 
	 $oTable=$rw['orderTableName'];
	 
	 $file=$_FILES['file'];
	 $fileName=$_FILES['file']['name'];
	 $fileTempName=$_FILES['file']['tmp_name'];
	 $fileSize=$_FILES['file']['size'];
	 $fileError=$_FILES['file']['error'];
	 $fileType=$_FILES['file']['type'];
	 
	 $fileExt=explode('.',$fileName);
	 $fileActualExt=strtolower(end($fileExt));
	 
	 $allowed=array('jpg','jpeg','png','pdf');
	 
	 if(in_array($fileActualExt,$allowed))
	 {
		if($fileError === 0)
		{
			if($fileSize < 1000000)
			{
				$fileNameNew = uniqid('',true).'.'.$fileActualExt;
				$fileDestination='upload/'.$fileNameNew;
				

	   $sql="insert into menu(menuName,path,picName,price,menuTypeID,discription) values
	   ('$menuName','$fileDestination','$fileNameNew','$price','$menuTypeID','$discription')";
       $result=mysqli_query($db,$sql);		
	   
	   if($result!=null)
	   {
		   move_uploaded_file($fileTempName,$fileDestination);
         
		 $menuID=mysqli_insert_id($db); 
		 $rID=$_SESSION["rID"];
          
         $s="ALTER TABLE $oTable  ADD `$menuName` INT(11) DEFAULT 0";
         $r=mysqli_query($db,$s);

		 if($r!=NULL)
		 {   
			$s1="insert into restomenu(restoID,menuID) values('$rID','$menuID')"; 
			$r1=mysqli_query($db,$s1); 
             
            if($r1!=NULL)
       		{
				 echo "Menu added successfully !!!";
			}
            else
            {
			 $sql="delete from menu where menuName ='$menuName'";
             $result=mysqli_query($db,$sql);
			  if($result)
			  { 
		        
				$file = $fileNameNew;
                if (!unlink($file))
                {
                    echo ("Error deleting $file ...Menu NOT added !!!");
                }
                else
                {
                   echo ("Menu NOT added !!!");
                }

			  }
			}				
		 }
		 else
	     {
			 
             $sql="delete from menu where menuName ='$menuName'";
             $result=mysqli_query($db,$sql);
			 if($result)
			 {
				 $file = $fileNameNew;
                if (!unlink($file))
                {
                    echo ("Error deleting $file ...Menu NOT added !!!");
                }
                else
                {
                   echo ("Menu NOT added !!!");
                }
			 }
			 
		 }
				
	   }
				
			}
			else
			{
				echo "Your file size is too big !!!";
			}
		}	
        else
        {
			echo "There is error in uploading file !!!";
		}			
	 }
	 else
	 {
		 echo "File type is not allowed";
	 }
 }

?>

</center>
</body>
</html>