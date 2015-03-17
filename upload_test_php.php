<html>
<body>

<form action="upload_file_test.php" method="post"
enctype="multipart/form-data">
<label for="file">Filename:</label>
<input type="file" name="file" id="file"><br>
<input type="submit" name="submit" value="Submit">
</form>

<?php

// Show all information, defaults to INFO_ALL
phpinfo();

?>

</body>
</html>