<?php
// Chandrashekhar Goswami

// Connection with database
$host='localhost:3306';
$user='root';
$pass='';
$db='tests';
try{
	$DBH=new pdo("mysql:host=$host;dbname=$db",$user,$pass);
}catch(PDOException $e){
	echo"Not Connected..".$e->getMessage();
}
//Get Ip
$ip = $_SERVER['REMOTE_ADDR'];
//Check if this ip exits
$sql="SELECT ip FROM visitors WHERE ip='$ip'";
$Check=$DBH->prepare($sql);
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