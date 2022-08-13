<?php

class usuario
{
    private $pdo;
    public $msgErro = ""; // Se tiver vazia, não tem erro

    public function conectar($nome, $host, $usuario, $senha)
    {
        global $pdo;
        try {
            //Criar a conexão com banco de dados usando o PDO
            $pdo = new pdo('mysql:host=' . $host . ';dbname=' . $nome, $usuario, $senha);
        } catch (PDOException $e) {
            $msgErro = $e->getMessage();
        }
    }

    public function logar($email, $senha)
    {
        global $pdo;
        //Verifica se o email e senha estão cadastrados.
        $sql = $pdo->prepare("SELECT ID FROM cliente WHERE email = :e AND senha = :s");
        $sql->bindValue(":e", $email);
        $sql->bindValue(":s", $senha);
        $sql->execute();



        if ($sql->rowCount() > 0) {
            //Entrar no Sistema (sessao)
            $dado = $sql->fetch(); //Retorna uma unica row da consulta
            $_SESSION['ID'] = $dado['ID'];
            return true; //Logado com Sucesso
        } else {
            return false; //Não possivel logar
        }
    }

    public function adicionar($id, $saldo)
    {
        echo "$id $saldo";

        global $pdo;

        $AdicionaSaldo = $pdo->prepare("UPDATE cliente SET saldo=saldo+$saldo WHERE ID=$id");
        $AdicionaSaldo->execute();
        if ($AdicionaSaldo) {
            echo "Saldo adicionado";
        }
    }

    public function transferir($id, $tranferencia, $id_transferencia)
    {
        if ($id == $id_transferencia) {
            echo "não pode transferir para a mesma pessoa";
            return false;
        }
        global $pdo;

        $select = $pdo->prepare("SELECT saldo FROM cliente WHERE ID=$id");
        $select->execute();


        if ($select->rowCount() > 0) {
            $dado = $select->fetch();
            if ($dado['saldo'] >= $tranferencia) {
                $RetirarSaldo = $pdo->prepare("UPDATE cliente SET saldo=saldo-$tranferencia WHERE ID=$id");
                $RetirarSaldo->execute();
                if ($RetirarSaldo) {
                    $AdicionaSaldo = $pdo->prepare("UPDATE cliente SET saldo=saldo+$tranferencia WHERE ID=$id_transferencia");
                    $AdicionaSaldo->execute();
                    if ($AdicionaSaldo) {
                        echo "Saldo Transferido";
                    }
                }
            }
        }
    }
}
