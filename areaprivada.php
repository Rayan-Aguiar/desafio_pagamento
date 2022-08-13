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


    <div class="main-container">
        <h2>Seja bem-vindo(a)!</h2>
        <div class="bottons">
            <a href="#">Adicionar Saldo</a>
            <a href="#">Transferir Saldo</a>
            <a href="Sair.php">Sair</a>
        </div>
    </div>

    <?php
    $u->conectar("projeto-pagamento", "localhost", "root", "");
    $id = $_SESSION['ID'];
    $sql = $pdo->prepare("SELECT ID, CPF, nome, email, saldo FROM cliente WHERE ID = :id ");
    $sql->bindValue(":id", $id);
    $sql->execute();
    ?>

    <div class="dados-user">
        <?php
        while ($row_user = $sql->fetch(PDO::FETCH_ASSOC)) {
        ?>
            <div class="container-user">
                <?php
                echo "Nome: " . $row_user['nome']; ?><br><?php
                echo "Email: " . $row_user['email']; ?><br><?php
                echo "Saldo: R$ " . number_format($row_user['saldo'] , 2 , ',', '.'); ?><br><?php
        }
        ?>
            </div>
    </div>

</body>

</html>