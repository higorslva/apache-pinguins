<?php
// Conexão com o banco de dados
/*require "comum.php";

mysqli_connect("localhost", "pinguins", "pinguins789", "server");

// Inicia sessões
session_start();

if (!$conn) {
      die("Falha na conexão: " . mysqli_connect_error());
}
echo "Conectado com sucesso. Redirecionando... ";
 */
/* Codigo reaproveitado do 'cadastro.php' */
$servername = "localhost";
$database = "server";
$username = "pinguins";
$password = "pinguins789";
$data_name = "aut_usuarios";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);

#---- Tentando conexão ----#

if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully - ";

#---- Aqui ele conectou, tá safe ----#
#---- O problema é daqui pra baixo, aparentemente não consegue gerar a consulta e entrar ---#
#---- no sistema ----#



// Recupera o login
$login = isset($_POST["login"]) ? addslashes(trim($_POST["login"])) : FALSE;
// Recupera a senha, a criptografando em MD5
$senha = isset($_POST["senha"]) ? md5(trim($_POST["senha"])) : FALSE;

// Usuário não forneceu a senha ou o login
if(!$login || !$senha)
{
	echo "Você deve digitar sua senha e login!";
	exit;
}

/*    Codigo acima (checar se digitou ou não) também tá funcionando     */

/**
* Executa a consulta no banco de dados.
* Caso o número de linhas retornadas seja 1 o login é válido,
* caso 0, inválido.
*/
#$SQL = "SELECT id, nome, login, senha, postar FROM aut_usuarios WHERE login = '$login'";
$result_id = @mysqli_query("SELECT id, nome, login, senha, postar FROM aut_usuarios WHERE login = '$login'") or die("Erro no banco de dados!");
$total = @mysqli_num_rows($result_id);

echo "Consulta feita";

// Caso o usuário tenha digitado um login válido o número de linhas será 1..
if($total)
{
	// Obtém os dados do usuário, para poder verificar a senha e passar os demais dados para a sessão
	$dados = @mysqli_fetch_array($result_id);

	// Agora verifica a senha
	if(!strcmp($senha, $dados["senha"]))
	{
		// TUDO OK! Agora, passa os dados para a sessão e redireciona o usuário
		$_SESSION["id_usuario"]= $dados["id"];
		$_SESSION["nome_usuario"] = stripslashes($dados["nome"]);
		$_SESSION["permissao"]= $dados["postar"];
		header("Location: index.php");
		exit;
	}
	// Senha inválida
	else
	{
	 "Senha inválida!";
	exit;
	}
}
	// Login inválido
else
{
	echo "O login fornecido por você é inexistente!";
	exit;
}
?>
