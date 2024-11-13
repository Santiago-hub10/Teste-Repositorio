<?php
session_start();
$erro_nome = "";
$erro_email = "";
$erro_sexo = "";
$erro_idade = "";
$erro_endereco = "";
$erro_telefone = "";
$erro_cidade = "";
$erro_estado = "";
$erro_cep = "";
$erro_validacao = 0;

if (isset($_POST["botao"])) {
	$_SESSION["nome"]     = $_POST["nome"];
	$_SESSION["email"]    = $_POST["email"];
	$_SESSION["sexo"]     = $_POST["sexo"];
	$_SESSION["idade"]    = $_POST["idade"];
	$_SESSION["endereco"] = $_POST["endereco"];
	$_SESSION["telefone"]  = $_POST["telefone"];
	$_SESSION["cidade"]    = $_POST["cidade"];
	$_SESSION["estado"]    = $_POST["estado"];
	$_SESSION["cep"]       = $_POST["cep"];

	// VALIDAÇÃO: NOME É OBRIGATÓRIO
	if ($_SESSION["nome"] == "") {
		$erro_nome = "<span style='color:red'>Preencha o nome</span>";
		$erro_validacao++;
	} 

	// VALIDAÇÃO: EMAIL É OBRIGATÓRIO E VÁLIDO
	if (!filter_var($_SESSION["email"], FILTER_VALIDATE_EMAIL)) {
		$erro_email = "<span style='color:red'>Email inválido</span>";
		$erro_validacao++;
	}

	// VALIDAÇÃO: SEXO É OBRIGATÓRIO		
	if (($_SESSION["sexo"] != 1) && ($_SESSION["sexo"] != 2)) {
		$erro_sexo = "<span style='color:red'>Escolha 1 para Masculino ou 2 para Feminino</span>";
		$erro_validacao++;
	}

	// VALIDAÇÃO: IDADE É OBRIGATÓRIA
	if ($_SESSION["idade"] == "") {
		$erro_idade = "<span style='color:red'>Preencha a idade</span>";
		$erro_validacao++;
	}

	// VALIDAÇÃO: ENDEREÇO É OBRIGATÓRIO
	if ($_SESSION["endereco"] == "") {
		$erro_endereco = "<span style='color:red'>Preencha o endereço</span>";
		$erro_validacao++;
	}

	// VALIDAÇÃO: TELEFONE É OBRIGATÓRIO
	if ($_SESSION["telefone"] == "") {
		$erro_telefone = "<span style='color:red'>Preencha o telefone</span>";
		$erro_validacao++;
	}

	// VALIDAÇÃO: CIDADE É OBRIGATÓRIA
	if ($_SESSION["cidade"] == "") {
		$erro_cidade = "<span style='color:red'>Preencha a cidade</span>";
		$erro_validacao++;
	}

	// VALIDAÇÃO: ESTADO É OBRIGATÓRIO
	if ($_SESSION["estado"] == "") {
		$erro_estado = "<span style='color:red'>Preencha o estado</span>";
		$erro_validacao++;
	}

	// VALIDAÇÃO: CEP É OBRIGATÓRIO
	if ($_SESSION["cep"] == "") {
		$erro_cep = "<span style='color:red'>Preencha o CEP</span>";
		$erro_validacao++;
	}

	// SEM ERRO DE VALIDAÇÃO
	if ($erro_validacao == 0) {
		header("location:etapa3.php");
		exit();
	}
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Venda de Animes</title>
</head>
<body>
	<h2>DADOS DO CLIENTE</h2>
	<form method="POST" action="etapa2.php"> 
		Nome: <input type="text" name="nome" size="60" maxlength="50" 
		value="<?php if (isset($_SESSION["nome"])) echo $_SESSION["nome"]; ?>">
		<?php echo $erro_nome ?> 
		<br/>

		Email: <input type="text" name="email" size="60" maxlength="50" 
		value="<?php if (isset($_SESSION["email"])) echo $_SESSION["email"]; ?>"> 
		<?php echo $erro_email ?>
		<br/>

		Sexo: <input type="text" name="sexo" size="2" maxlength="2" 
		value="<?php if (isset($_SESSION["sexo"])) echo $_SESSION["sexo"]; ?>">
		<?php echo $erro_sexo ?>
		<br/>

		Idade: <input type="number" name="idade" min="1" 
		value="<?php if (isset($_SESSION["idade"])) echo $_SESSION["idade"]; ?>">
		<?php echo $erro_idade ?>
		<br/>

		Endereço: <input type="text" name="endereco" size="60" maxlength="100" 
		value="<?php if (isset($_SESSION["endereco"])) echo $_SESSION["endereco"]; ?>">
		<?php echo $erro_endereco ?>
		<br/>

		Telefone: <input type="text" name="telefone" size="15" maxlength="15" 
		value="<?php if (isset($_SESSION["telefone"])) echo $_SESSION["telefone"]; ?>">
		<?php echo $erro_telefone ?>
		<br/>

		Cidade: <input type="text" name="cidade" size="40" maxlength="50" 
		value="<?php if (isset($_SESSION["cidade"])) echo $_SESSION["cidade"]; ?>">
		<?php echo $erro_cidade ?>
		<br/>

		Estado: <input type="text" name="estado" size="2" maxlength="2" 
		value="<?php if (isset($_SESSION["estado"])) echo $_SESSION["estado"]; ?>">
		<?php echo $erro_estado ?>
		<br/>

		CEP: <input type="text" name="cep" size="10" maxlength="10" 
		value="<?php if (isset($_SESSION["cep"])) echo $_SESSION["cep"]; ?>">
		<?php echo $erro_cep ?>
		<br/>

		<input type="submit" value="Prosseguir" name="botao">
	</form>
	<a href="../index.php"><button>Voltar</button></a>
</body>
</html>
