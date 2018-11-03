<?php
include"connection.php";
// Chandrashekhar Goswami

// Connection with database
$host='localhost:3306';
$user='Chandu';
$pass='Goswami@1997';
$db='crazy';
try{
	$DBH=new pdo("mysqli:host=$host;dbname=$db",$user,$pass);
}catch(PDOException $e){
	echo"Not Connected..".$e->getMessage();
}
//Get Ip
$ip = $_SERVER['REMOTE_ADDR'];
//Check if this ip exits
$sqli="SELECT ip FROM visitors WHERE ip='$ip'";
$Check=$DBH->prepare($sqli);
$Check->execute();
$CheckIp=$Check->rowCount();
if ($CheckIp==0){
	$query="INSERT INTO visitors(id,ip) VALUES(NULL,'$ip')";
    $insertIp=$DBH->prepare($query);
    $insertIp->execute();
}
$number=$DBH->prepare("SELECT ip FROM visitors");
$number->execute();
$visitor=$number->rowCount();
echo $visitor;
?>