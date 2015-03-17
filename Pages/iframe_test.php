<?php

require_once "Common_Use/header.php";
require_once "Common_Use/ftp.php";

$section_file_path = "/TDS-S2/Project Portal/test.pdf";
$ext = "pdf";
$local_file = "temp.".$ext;
$local_fp = fopen($local_file, "w");
$d = ftp_nb_fget($ftp_conn, $local_fp, $section_file_path, FTP_BINARY);
while ($d == FTP_MOREDATA)
  {
  $d = ftp_nb_continue($ftp_conn);
  }

if ($d != FTP_FINISHED)
  {
  echo "Error downloading $server_file";
  exit(1);
  }
fclose($local_fp);

?>

<iframe src="temp.pdf" width="800" height="800">