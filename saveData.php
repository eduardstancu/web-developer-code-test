<?php
require_once("clsOperations.php");

$id = $_REQUEST["id"];
$descr=$_REQUEST["descr"];
$filepath=$_REQUEST["filepath"];
/*echo "<br>";
echo $id . " - ";
echo $descr . " - ";
echo $filepath . " ";
echo "<br>";
*/
// Now we will save the image path in database
$Obj = new DataOperations();
if ($Obj->verifyDataSaved($id)==true){
    // when the data was already saved
    $Obj->updateData($id, $filepath);
} else {
    //if no data was saved
    $Obj->saveData($id, $descr, $filepath);
       
}
