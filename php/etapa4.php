<?php
session_start();
$erro_pagto = "";
$erro_frete = "";
$erro_validacao = 0;

if (isset($_POST["botao"])) {
    // Validação da forma de pagamento
    if (isset($_POST["fpagto"])) {
        $_SESSION["fpagto"] = $_POST["fpagto"];
    } else {
        $erro_validacao++;
        $erro_pagto = '<span style="color:red">Selecione uma das opções de pagamento</span>';
    }

    // Validação da forma de frete
    if (isset($_POST["frete"])) {
        $_SESSION["frete"] = $_POST["frete"];
    } else {
        $erro_validacao++;
        $erro_frete = '<span style="color:red">Selecione uma opção de frete</span>';
    }

    // Sem erro de validação
    if ($erro_validacao == 0) {
        header("Location: confirma.php");
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
    <h2>FORMA DE PAGAMENTO E FRETE</h2>
    <form method="POST" action="etapa4.php">
        <h2>Escolha a Forma de Pagamento</h2>
        <select name="fpagto">
            <option value="" disabled <?php if (!isset($_SESSION["fpagto"])) echo 'selected'; ?>>Selecione uma forma de pagamento</option>
            <option value="1" <?php if (isset($_SESSION["fpagto"]) && $_SESSION["fpagto"] == "1") echo 'selected'; ?>>À vista - desconto 9%</option>
            <option value="2" <?php if (isset($_SESSION["fpagto"]) && $_SESSION["fpagto"] == "2") echo 'selected'; ?>>A prazo - acréscimo 11%</option>
            <option value="3" <?php if (isset($_SESSION["fpagto"]) && $_SESSION["fpagto"] == "3") echo 'selected'; ?>>Parcelado em 3x - acréscimo de 15%</option>
        </select>
        <?php echo $erro_pagto; ?>
        <br/><br/>

        <h2>Escolha a Forma de Frete</h2>
        <input type="radio" name="frete" value="normal" <?php if (isset($_SESSION["frete"]) && $_SESSION["frete"] == "normal") echo 'checked'; ?>> Frete Normal<br/>
        <input type="radio" name="frete" value="express" <?php if (isset($_SESSION["frete"]) && $_SESSION["frete"] == "express") echo 'checked'; ?>> Frete Expresso<br/>
        <input type="radio" name="frete" value="retirada" <?php if (isset($_SESSION["frete"]) && $_SESSION["frete"] == "retirada") echo 'checked'; ?>> Retirada na loja<br/>
        <?php echo $erro_frete; ?>
        <br/>

        <input type="submit" value="Prosseguir" name="botao">
    </form>
    <a href="etapa3.php"><button>Voltar</button></a>
</body>
</html>
