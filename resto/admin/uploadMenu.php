<?php
 if(isset($_POST['submit']))
 {   
     session_start();
	 
     $menuName=$_POST['menuName'];
	 $price=$_POST['price'];
	 $discription=$_POST['discription'];
	 $rID=$_SESSION["rID"];
	 
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
				

	   $sql="insert into menu(menuName,path,picName,price,discription) values
	   ('$menuName','$fileDestination','$fileNameNew','$price','$discription')";
       $result=mysqli_query($db,$sql);		
	   
	   if($result!=null)
	   {
		   move_uploaded_file($fileTempName,$fileDestination);
         

         $s="ALTER TABLE $oTable  ADD $menuName INT(11)";
         $r=mysqli_query($db,$s);

		 if($r!=NULL)
		 {  
			   echo "Menu added successfully !!!";
		 }
		 else
	     {
			 
             $sql="delete from menu where menuName ='$menuName'";
             $result=mysqli_query($db,$sql);
			 if($result)
			 {
				 echo "Menu NOT added !!!".$oTable.$menuName;
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