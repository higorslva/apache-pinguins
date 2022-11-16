<?php
$login = $_POST['login'];
#$senha = MD5($_POST['senha']);
$senha = $_POST['senha'];
$servername = "localhost";
$database = "server";
$username = "pinguins";
$password = "pinguins789";
$data_name = "usuarios";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);
// Check connection
if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully - ";
 
$sql = "INSERT INTO $data_name (login, senha) VALUES ('$login', '$senha')";


if (mysqli_query($conn, $sql)) {
      echo "New record created successfully";
	
} else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
mysqli_close($conn);
?>
