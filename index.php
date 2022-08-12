<?php    
    require_once 'conexao.php';
    $u = new Usuario; // faz a instancia
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Pagina Inicial - Tela de Login</title>
</head>
<body>
    
    <form method="POST" action="index.php">

        <div class="main-container">
            <h1>Entre com o seu login</h1>
                <div class="login">
                    <input type="email" name="email" id="email placeholder="Digite seu email" required>
                    <input type="password" name="senha" id="senha" placeholder="Digite sua senha" required>
                    <input type="submit" name="" value="Entrar">
                </div>
        </div>
        <?php
        if(isset($_POST['email'])){
            $email = addslashes($_POST['email']);//addlashes - não deixa que passem scripts pelos campos
            $senha = addslashes($_POST['senha']);
        }

         //Verifica se os campos foram preenchidos
         if(!empty($email) && !empty($senha)){
            $u ->conectar("projeto-pagamento", "localhost", "root", "");
                if($u->msgErro == ""){ //Verifica se não houve nenhum erro na conexão com o BD
                    $test = $u->logar($email,$senha);
                    if($u->logar($email,$senha)){
                        header("location: areaprivada.php");
                    } else{
                        ?>
                        <div class="msg-erro">
                            Email e/ou senha incorreta!
                    </div>
                    <?php
                    }
            }
                else{
                    ?>
                    <div class="msg-erro">
                        <?php  echo 'Erro:'.$u->msgErro; ?>
                    </div>
                <?php 
                 }
        } 
                else{
                    ?>
                        <div class="msg-erro">
                            <p> Preencha todos os campos.</p>
                        </div>
                    <?php
                }
            ?>

    </form>    


</body>
</html>