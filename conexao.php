<?php 

    Class usuario{
        private $pdo;
        public $msgErro = ""; // Se tiver vazia, não tem erro

        public function conectar($nome, $host, $usuario, $senha){
            global $pdo;
            try{            
                //Criar a conexão com banco de dados usando o PDO
                $pdo = new pdo('mysql:host=' . $host . ';dbname=' . $nome, $usuario, $senha);
            } catch (PDOException $e){
            $msgErro = $e->getMessage();
            }
        }
        
        public function logar($email, $senha){
            global $pdo;
            //Verifica se o email e senha estão cadastrados.
            $sql = $pdo->prepare("SELECT ID FROM cliente WHERE email = :e AND senha = :s");
            $sql->bindValue(":e", $email);
            $sql->bindValue(":s", $senha);
            $sql->execute();

            /*echo $email.$senha;

            var_dump($sql->fetch());*/

            if($sql->rowCount() > 0){
                //Entrar no Sistema (sessao)
                $dado = $sql->fetch(); //Retorna uma unica row da consulta
                $_SESSION ['ID'] = $dado['ID'];
                return true; //Logado com Sucesso
            }
            else{
                return false; //Não possivel logar
            }

        }

    }


?>
