<?php 
session_start();

// Checar se os dados necessários estão disponíveis
if (!isset($_SESSION["nome"]) || !isset($_SESSION["email"]) || !isset($_SESSION["fpagto"]) || !isset($_SESSION["frete"]) || !isset($_SESSION["livro1"]) || !isset($_SESSION["qtdade1"])) {
    header("Location: etapa1.php"); // Redirecionar para a etapa 1 se os dados não estiverem disponíveis
    exit();
}

// Recebendo dados do cliente
$nome = $_SESSION["nome"]; 
$email = $_SESSION["email"]; 
$sexo = $_SESSION["sexo"] == 1 ? "Masculino" : "Feminino";

// Recebendo dados do pedido
$livro1 = $_SESSION["livro1"];
switch ($livro1) {
    case 1:
        $livro1_nome = "Luffy";
        $preco1 = 78;
        break;
    case 2:
        $livro1_nome = "Goku";
        $preco1 = 65;
        break;
    case 3:
        $livro1_nome = "Naruto";
        $preco1 = 25;    
        break;
    case 4:
        $livro1_nome = "Kaneki";
        $preco1 = 56;    
        break;
    default:
        $livro1_nome = "Indefinido";
        $preco1 = 0;
        break;
}
$qtdade1 = $_SESSION["qtdade1"];

// Calculando total
$total = $preco1 * $qtdade1;

// Recebendo dados de pagamento
$fpagto = $_SESSION["fpagto"];
switch ($fpagto) {
    case 1:
        $fpagto_desc = "À vista";
        $valorpg = $total - ($total * 0.09);
        break;
    case 2:
        $fpagto_desc = "À prazo";
        $valorpg = $total + ($total * 0.11);
        break;
    case 3:
        $fpagto_desc = "Parcelado";
        $valorpg = $total + ($total * 0.15);
        $vparc = $valorpg / 3;
        break;
    default:
        $fpagto_desc = "Indefinido";
        $valorpg = 0;
        break;
}

// Recebendo dados de frete
$frete = $_SESSION["frete"];
$frete_desc = $frete == "normal" ? "Frete Normal" : ($frete == "express" ? "Frete Expresso" : "Retirada na loja");

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Venda de Animes - Confirmação</title>
</head>
<body>
    <h2>Confirmação do Pedido</h2>
    
    <h3>Dados do Cliente</h3>
    <p><strong>Nome:</strong> <?php echo htmlspecialchars($nome); ?></p>
    <p><strong>E-mail:</strong> <?php echo htmlspecialchars($email); ?></p>
    <p><strong>Sexo:</strong> <?php echo htmlspecialchars($sexo); ?></p>    

    <h3>Dados do Pedido</h3>
    <p><strong>Livro:</strong> <?php echo htmlspecialchars($livro1_nome); ?></p>
    <p><strong>Quantidade:</strong> <?php echo htmlspecialchars($qtdade1); ?></p>
    <p><strong>Preço Unitário:</strong> R$ <?php echo number_format($preco1, 2, ',', '.'); ?></p>
    <p><strong>Valor Total da Compra:</strong> R$ <?php echo number_format($total, 2, ',', '.'); ?></p>

    <h3>Forma de Pagamento</h3>
    <p><strong>Forma de pagamento:</strong> <?php echo htmlspecialchars($fpagto_desc); ?></p>
    <p><strong>Valor a Pagar:</strong> R$ <?php echo number_format($valorpg, 2, ',', '.'); ?></p>
    <?php if ($fpagto == 3): ?>
        <p><strong>Valor Parcelado:</strong> R$ <?php echo number_format($vparc, 2, ',', '.'); ?> (3x)</p>
    <?php endif; ?>

    <h3>Forma de Frete</h3>
    <p><strong>Tipo de Frete:</strong> <?php echo htmlspecialchars($frete_desc); ?></p>

    <br/><br/>
    <a href="../index.php"><button>Nova Venda</button></a>
</body>
</html>

