<?php
include_once "../Common_Use/header.php";

if(!$_GET["curfolder"])
{
    $curfolder = "/TDS-S2";
}
else
{
    $curfolder = $_GET["curfolder"];
}
?>

<?php
$ftp_server = "teironstudios.asuscomm.com";
$ftp_conn = ftp_connect($ftp_server) or die("Could not connect to $ftp_server");
$ftp_username = "admin";
//$ftp_username = "tds";
$ftp_userpass = "tds000321";
$login = ftp_login($ftp_conn, $ftp_username, $ftp_userpass);
ftp_chdir($ftp_conn, $curfolder);
$file_list = ftp_nlist($ftp_conn, ".");

if(!isset($_POST["selected_folder"]))
{
    $_SESSION["selected_folder"] = $file_list[0];
}
else
{
    $_SESSION["selected_folder"] = $_POST["selected_folder"];
}


echo "<p>";
echo "Upload file to directory:";
echo ftp_pwd($ftp_conn);
echo "</p>";
// close connection
//ftp_close($ftp_conn);
?>

<form name="ftp_file" action="ftp_upload_handler.php" method="post" onsubmit="return confirm('Really Add This File?');" enctype="multipart/form-data">

<input type="file" name="file">
<br>
Save as new file name:<input type="text" name="new_file_name">(remember to include the extension)
<br>
(leave it blank will use the original file name)
<?php
echo '<input type="hidden" name="upload_folder" value="'.$curfolder.'"';
?>


<br>
<input type="submit" value="Submit">

</form>

<?php
ftp_cdup($ftp_conn);

echo '<a href="?curfolder='.(ftp_pwd($ftp_conn)).'">';
echo "parent directory";
echo "</a>";



ftp_chdir($ftp_conn,$curfolder);
$file_list = ftp_nlist($ftp_conn, ".");

foreach($file_list as $file_or_dir)
{
    if(ftp_chdir($ftp_conn, $file_or_dir))
    {
	
	$dir_name = strrchr($file_or_dir,"/");
	$dir_name = str_ireplace("/","",$dir_name);
 	echo '<p><a href="?curfolder='.$file_or_dir.'"> ';
    	echo $dir_name;
    	echo "</a></p>";
	ftp_cdup($ftp_conn);
    }
    else
    {
    	$dir_name = strrchr($file_or_dir,"/");
	$dir_name = str_ireplace("/","",$dir_name);
 	echo "<p>";
    	echo $dir_name;
    	$confirm_message = "Really Delete This File?";
    	echo "<form name=\"delete\" action=\"ftp_delete_handler.php\" method=\"post\" onsubmit=\"return confirm('Really Delete This File?');\">";
    	
    	echo '<input type="hidden" name="file" value="'.$file_or_dir.'">';
    	echo '<input type="submit" value="delete">';
    	echo "</form>";
    	
    	echo "</p>";
    }
   
}


ftp_close($ftp_conn);
?>