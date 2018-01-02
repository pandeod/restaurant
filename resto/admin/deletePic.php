<?php
$file = "upload/5a4a8e3be97d68.72632266.jpg";
if (!unlink($file))
  {
  echo ("Error deleting $file");
  }
else
  {
  echo ("Deleted $file");
  }
?>