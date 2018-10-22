
<?php 
// save the file in the img folder

$destination= 'img';
$tmp_name = $_FILES["inputFile"]["tmp_name"];
$name = $_FILES["inputFile"]["name"];
move_uploaded_file($tmp_name, "$destination/$name");





