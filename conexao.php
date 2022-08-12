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
            $sql = $pdo->prepare("SELECT id_usuario FROM usuarios WHERE email = :e AND senha = :s");
            $sql->bindValue(":e", $email);
            $sql->bindValue(":s", md5($senha));
            $sql->execute();

            if($sql->rowCount() > 0){
                //Entrar no Sistema (sessao)
                $dado = $sql->fetch(); //Retorna uma unica row da consulta
                session_start();
                $_SESSION ['id-cliente'] = $dado['id_usuario'];
                return true; //Logado com Sucesso
            }
            else{
                return false; //Não possivel logar
            }

        }

    }


?>
