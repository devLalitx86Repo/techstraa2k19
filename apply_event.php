<?php session_start();

include 'include/Dbhandler.php';
$db = new Dbhandler();


$name = $_SESSION['std_name'];
$course = $_SESSION['std_course'];
$email = $_SESSION['std_email'];

$table_name = $_GET["eventName"];



$table_name_lower = str_replace(' ','',strtolower($table_name));



if ($db->insertIntoApplyTable($name,$course,$email,$table_name_lower)) {

} else {
   
}

$link = 'detail.php?eventid='.$_SESSION['event_id'];

header("location:".$link);




?>


