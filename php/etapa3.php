<?php
session_start();
$erro_quantidade = "";
$erro_validacao = 0;

if (isset($_POST["botao"])) {
    $_SESSION["livro1"] = $_POST["livro1"];
    $_SESSION["qtdade1"] = $_POST["qtdade1"];
    $_SESSION["frete"] = $_POST["frete"];
    
    // Validação da quantidade
    if ($_SESSION["qtdade1"] < 1) {
        $erro_quantidade = "<span style='color:red'>Preencha a quantidade</span>";
        $erro_validacao++;
    } elseif ($_SESSION["qtdade1"] > 4) {
        $erro_quantidade = "<span style='color:red'>Limite de venda excedido</span>";
        $erro_validacao++;
    }

    // Validação da forma de frete
    if (!isset($_POST["frete"])) {
        $erro_validacao++;
        $erro_frete = "<span style='color:red'>Selecione uma opção de frete</span>";
    } else {
        $_SESSION["frete"] = $_POST["frete"];
    }

    // Sem erro de validação
    if ($erro_validacao == 0) {
        header("Location: etapa4.php");
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
    <h2>Escolha seu Livro:</h2>
    <form method="POST" action="etapa3.php">
        <label>Livro:</label><br/>
        <select name="livro1">
            <option value="1" <?php if (isset($_SESSION["livro1"]) && $_SESSION["livro1"] == "1") echo 'selected'; ?>> Luffy - R$ 78,00 </option>
            <option value="2" <?php if (isset($_SESSION["livro1"]) && $_SESSION["livro1"] == "2") echo 'selected'; ?>> Goku - R$ 65,00 </option>
            <option value="3" <?php if (isset($_SESSION["livro1"]) && $_SESSION["livro1"] == "3") echo 'selected'; ?>> Naruto - R$ 25,00 </option>
            <option value="4" <?php if (isset($_SESSION["livro1"]) && $_SESSION["livro1"] == "4") echo 'selected'; ?>> Kaneki - R$ 56,00 </option>
        </select><br/>

        <label>Quantidade:</label>
        <input type="number" name="qtdade1" min="1" max="4" value="<?php if (isset($_SESSION["qtdade1"])) echo $_SESSION["qtdade1"]; ?>" />
        <?php echo $erro_quantidade; ?>
        
        <br/><br/>

        <label>Forma de Frete:</label><br/>
        <input type="radio" name="frete" value="normal" <?php if (isset($_SESSION["frete"]) && $_SESSION["frete"] == "normal") echo 'checked'; ?>> Frete Normal<br/>
        <input type="radio" name="frete" value="express" <?php if (isset($_SESSION["frete"]) && $_SESSION["frete"] == "express") echo 'checked'; ?>> Frete Expresso<br/>
        <input type="radio" name="frete" value="retirada" <?php if (isset($_SESSION["frete"]) && $_SESSION["frete"] == "retirada") echo 'checked'; ?>> Retirada na loja<br/>
        <?php echo isset($erro_frete) ? $erro_frete : ''; ?>
        
        <br/><br/>

        <label>Notificações:</label><br/>
        <input type="checkbox" name="notificacoes" value="sim" <?php if (isset($_SESSION["notificacoes"]) && $_SESSION["notificacoes"] == "sim") echo 'checked'; ?>> Quero receber notificações sobre o pedido<br/>

        <input type="submit" value="Prosseguir" name="botao">
    </form>
    <a href="etapa2.php"><button>Voltar</button></a>
</body>
</html>

