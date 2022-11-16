<?php
$login = $_POST['login'];
$entrar = $_POST['entrar'];
$senha = md5($_POST['senha']);
#$connect = mysqli_connect('localhost','pinguins','pinguins789');
$servername = "localhost";
$database = "server";
$username = "pinguins";
$password = "pinguins789";
$data_name = "usuarios";

$connect = mysqli_connect($servername,$username,$password, $database);

$db = mysqli_select_db('server');
  if (isset($entrar)) {

    $verifica = mysqli_query("SELECT * FROM usuarios WHERE login =
    '$login' AND senha = '$senha'") or die("erro ao selecionar");
      if (mysqli_num_rows($verifica)<=0){
        echo"<script language='javascript' type='text/javascript'>
        alert('Login e/ou senha incorretos');window.location
        .href='login.html';</script>";
        die();
      }else{
        setcookie("login",$login);
        header("Location:index.php");
      }
  }
?>

