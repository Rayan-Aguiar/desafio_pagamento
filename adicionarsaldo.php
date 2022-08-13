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
    <title>Adicionar Saldo</title>
</head>
<body>


    <form style="background-color: #fff" action="adicionarsaldo.php" method="POST">
        <input type="number" placeholder="Insira o valor" name="valor">
        <input type="submit" value="Adicionar">
    </form>
    <?php 
    if (isset($_POST['valor'])){
        $valor = $_POST['valor'];
        $id = $_SESSION['ID'];
        $u->conectar("projeto-pagamento", "localhost", "root", "");
        $u->adicionar($id, $valor);       


    }

    ?>

</body>
</html>