<?php

// Show all the data in database
require_once("clsOperations.php");


$Obj = new DataOperations();
$Obj->retrieveAllData();