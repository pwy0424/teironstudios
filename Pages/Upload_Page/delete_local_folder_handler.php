<?php
session_start();

header("Location: upload_local.php");

if(rmdir("../../Public_files".$_POST["current_folder"]))
{
$pos = strrpos($_POST["current_folder"], "/");
$parent_folder = substr_replace($_POST["current_folder"], "", $pos);


if($parent_folder == "") $parent_folder = "/";

$_SESSION["local_folder"] = $parent_folder;
}
?>