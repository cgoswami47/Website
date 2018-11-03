<?php
include"connection.php";
$vid="";
$vname="";
$vmobile="";
if(isset($_POST["button_add"])){
	$qry = mysqli_query($con, "insert into table_student values('','".$_POST["student_name"]."','".$_POST["student_mobile"]."','".$_FILES["student_picture"]["name"]."')") or die("Cannot query with database");
	if($qry){
        $target_dir = "picture/";
        $target_file = $target_dir . basename($_FILES["student_picture"]["name"]);
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
      if(move_uploaded_file($_FILES["student_picture"]["tmp_name"],
    $target_file)){ 
      echo "Upload successfully";
      }
      else{
            "Upload failed";
      }
    
	}
}
else if(isset($_POST["button_edit"])){
$qry=mysqli_query($con,"update table_student set student_name='".$_POST["student_name"]."', student_mobile='".$_POST["student_mobile"]."' where student_id='".$_POST["student_id"]."'");
}
if(isset($_GET["delete"])){
	$qry =mysqli_query($con,"delete from table_student where student_id='".$_GET
     ["delete"]."'");
	if($qry){
		unlink("picture/".$_GET["picture"]);  
	}
}
else if (isset($_GET["edit"])){
 $qry=mysqli_query($con,"select * from table_student where student_id='".$_GET
     ["edit"]."'");
while($row=mysqli_fetch_array($qry,MYSQLI_ASSOC)){
	$vid=$row["student_id"];
	$vname=$row["student_name"];
	$vmobile=$row["student_mobile"];
}

} 
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Student</title>
</head>

<body>
<h>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color="#FF00FF"><strong><big><i>Upload  Wonderful  five  drawing</i></big></strong></font></h>	
<form action='<?php echo $_SERVER["PHP_SELF"];?>' method="post" enctype="multipart/form-data">	
<table>
<tr><td><b><strong>Student Id</strong></b></td><td><input type="text" name="student_id" value="<?php echo $vid;?>"/></td></tr>
<tr><td><b><strong>Student Name</strong></b></td><td><input type="text" name="student_name" value="<?php echo $vname;?>"/></td></tr>
<tr><td><b><strong>Student Mobile</strong></b></td><td><input type="text" name="student_mobile" value="<?php echo $vmobile;?>"/></td></tr>
<tr><td><b><strong>Student Picture</strong></b></td><td><input type="file" name="student_picture"/></td></tr>
<tr><td colspan="2"><input type="submit" name="button_add" value="Add"/>
	<input type="submit" name="button_edit" value="edit"/></td></tr>

</table>
</form>
<table border=1>
<tr><th><b><strong>Student Id</th><th>Student Name</th><th>Student Mobile</th><th>Student Picture</th><th>Action</strong></b></th></tr>	
<?php
$qry=mysqli_query($con,"select * from table_student");
while($row=mysqli_fetch_array($qry,MYSQLI_ASSOC)){
	echo '<tr><td>'.$row["student_id"].'</td>';
	echo '<td>'.$row["student_name"].'</td>';
	echo '<td>'.$row["student_mobile"].'</td>';
	echo '<td><img src="picture/'.$row["student_picture"].'"
	style="width:100px;height:100px;"/></td>';
	echo'<td><a href="?edit='.$row["student_id"].'">Edit</a> | <a href="?delete='.$row["student_id"].'&picture='.$row["student_picture"].'">Delete</td></tr>';
}
?>
</table> 

</body>
</html>