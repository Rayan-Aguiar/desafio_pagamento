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
    <title>Transferir Saldo</title>
</head>
<body>


    <form style="background-color: #fff" action="transferirsaldo.php" method="POST">
        <input type="number" placeholder="Insira o valor" name="valor">
        <input type="number" placeholder="Insira o ID" name="id_usuario">
        <input type="submit" value="Transferir">
    </form>
    <?php 
    if (isset($_POST['valor'])){
        $valor = $_POST['valor'];
        $id = $_SESSION['ID'];
        $tranferencia = $_POST['id_usuario'];

        $u->conectar("projeto-pagamento", "localhost", "root", "");
        $u->transferir($id, $valor,$tranferencia);
    }


    ?>

</body>
</html>