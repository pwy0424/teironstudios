<?php

header("Location: upload_local.php");

mkdir("../../Public_files".$_POST["parent_folder"]."/".$_POST["subfolder_name"]);

?>