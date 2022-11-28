<?php include("connection.php");
$table = "galery"; 
$id_galery = $_GET["id_galery"]; 
$photo = $_FILES["photo"]["name"]; 
$deskripsi = $_POST["deskripsi"]; 

$target_dir = "uploads/"; 
$target_file = $target_dir . basename($_FILES["photo"]["name"]); 
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION)); 

if($_GET['act']=='insert'){ 
if($imageFileType != "jpeg" && $imageFileType != "jpg"){ 
echo '<script>alert("Sorry, only  jpeg , jpg  files are allowed"); window.history.go(-1);</script>'; 
}else if ($_FILES["photo"]["size"] > 30000000){ 
echo '<script>alert("Sorry, your file is too large"); window.history.go(-1);</script>';  
}else{ 
		if(move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)){ 
			$sql = "INSERT INTO `$table` (`photo`, 
`deskripsi`) 
			VALUES ('$photo', 
'$deskripsi')"; 
			if ($conn->query($sql) === TRUE) { 
			echo '<script>alert("Data execute successfully"); window.history.go(-1);</script>'; 
			}else{ 
			echo '<script>alert("Data error execute"); window.history.go(-1);</script>'; 
			} 
		} 
		$conn->close(); 
} 
}else if($_GET['act']=='update'){ 
if ($_FILES["photo"]["size"] > 0){ 
if($imageFileType != "jpeg" && $imageFileType != "jpg"){ 
echo '<script>alert("Sorry, only  jpeg , jpg  files are allowed"); window.history.go(-1);</script>'; 
}else if ($_FILES["photo"]["size"] > 30000000){ 
echo '<script>alert("Sorry, your file is too large"); window.history.go(-1);</script>';  
}else{ 
		if(move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)){ 
			$sql = "UPDATE `$table` SET `photo` = '$photo', 
`deskripsi` = '$deskripsi' WHERE `id_galery` = '$id_galery'"; 
			if ($conn->query($sql) === TRUE) { 
			echo '<script>alert("Data execute successfully"); window.history.go(-1);</script>'; 
			}else{ 
			echo '<script>alert("Data error execute"); window.history.go(-1);</script>'; 
			} 
			$conn->close(); 
		} 
} 
}else{ 
		$sql = "UPDATE `$table` SET `deskripsi` = '$deskripsi' WHERE `id_galery` = '$id_galery'"; 
		if ($conn->query($sql) === TRUE) { 
		echo '<script>alert("Data execute successfully"); window.history.go(-1);</script>'; 
		}else{ 
		echo '<script>alert("Data error execute"); window.history.go(-1);</script>'; 
		} 
		$conn->close(); 
} 
}else if($_GET['act']=='show'){ 
$sql = "SELECT * FROM `$table`  WHERE `id_galery` = '$_POST[id_galery]'"; 
$result = $conn->query($sql);  
if ($result->num_rows > 0) { 
$row = $result->fetch_array(); 
$sqlfield = $conn->query("SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `table_name` = '$table'");  
while($field = $sqlfield->fetch_array()) { 
$data["$field[COLUMN_NAME]"] = $row["$field[COLUMN_NAME]"]; 
} 
echo json_encode($data); 
} 
}else if($_GET['act']=='delete'){ 
$result = $conn->query("SELECT * FROM `$table` WHERE `id_galery` = '$id_galery'"); 
$row = $result->fetch_assoc(); 
if(file_exists("uploads/$row[photo]")){ 
unlink("uploads/$row[photo]"); 
} 
$sql = "DELETE FROM `$table` WHERE `id_galery` = '$id_galery'"; 
if ($conn->query($sql) === TRUE) { 
echo '<script>alert("Data execute successfully"); window.history.go(-1);</script>'; 
}else{ 
echo '<script>alert("Data error execute"); window.history.go(-1);</script>'; 
}
$conn->close(); }
 ?>