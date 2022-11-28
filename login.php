<?php 
include('koneksi.php');

$response = array();
$email = $_POST['email'];
$password = $_POST['password'];

$result = $conn->query("SELECT * FROM login WHERE email = '$email' AND password = md5('$password')");

if($result->num_rows > 0){ // logika check jika ditemukan email dan password yang sama dgn yang ada di database 
	
	session_start(); // perintahkan browser untuk mengingat sesi yang di masukan user (email)
	$data = $result->fetch_array();  // value dari sesi email sesuikan dengan yang  ada  di database
	
	$_SESSION['email'] = $data['email'];// perintah untuk membuat sesi email 
	
	$response = array('status' => 'valid', 'message' => 'sukses', 'direction' => 'admin');
	// perintah jika sesi sudah dibuat (sukses login) arahkan ke folder administrator
	
}else{ // kemungkinan lain artinya jika tidak ada data ditemukan
	
	$response = array('status' => 'invalid', 'message' => 'Error: Invalid email and password', 'direction' => './');
}
echo json_encode($response);
?>