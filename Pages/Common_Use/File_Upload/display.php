<?php
//path to directory to scan
$directory = "File_Upload/";
 
//get all files in specified directory
$files = glob($directory . "File_Upload");
 
//print each file name
foreach($files as $file)
{
 //check to see if the file is a folder/directory
 if(is_dir($file))
 {
  echo $file;
 }
}
?>