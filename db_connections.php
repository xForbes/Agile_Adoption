<?php
function OpenPetConn(){
	$dbhost = "localhost";
	$dbuser = "root";
	$dbpass = "SuperMario/135/1997";
	$conn = new mysqli($dbhost, $dbuser, $dbpass,"pet") or die("Connect failed: %s\n". $conn -> error);
	return $conn;
}
function OpenShelterConn(){
	$dbhost = "localhost";
	$dbuser = "root";
	$dbpass = "SuperMario/135/1997";
	$conn = new mysqli($dbhost, $dbuser, $dbpass,"shelter") or die("Connect failed: %s\n". $conn -> error);
	return $conn;
}

 
function CloseCon($conn){
	$conn -> close();
}
   
?>