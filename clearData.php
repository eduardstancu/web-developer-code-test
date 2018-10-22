
<?php

// clear all the data from the database
require_once("clsOperations.php");


$Obj = new DataOperations();
$Obj->emptyTable();