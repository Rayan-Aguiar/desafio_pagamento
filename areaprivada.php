<?php
require_once 'conexao.php';
$u = new Usuario;

//Inicio uma sessão e verifico se quem está logado realmente tem essa permissão, caso não, redireciona para o inicio da pagina.
session_start();
if (!isset($_SESSION['ID'])) {
    header("location: index.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/style2.css">
    <title>Area do cliente</title>
</head>

<body>

    <?php
    $u->conectar("projeto-pagamento", "localhost", "root", "");
    $id = $_SESSION['ID'];
    $sql = $pdo->prepare("SELECT CPF, nome, email FROM cliente WHERE CPF = :id ");
    $sql->bindValue(":id", $id);
    $sql->execute();
    ?>
    
    <div class="main-container">
        <h2>Seja bem-vindo(a)!</h2>
        <div class="bottons">
            <a href="#">Adicionar Saldo</a>
            <a href="#">Transferir Saldo</a>
            <a href="Sair.php">Sair</a>
        </div>
    </div>

</body>

</html>