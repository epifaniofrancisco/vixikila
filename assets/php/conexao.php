<?php

class Usuario
{
    private $pdo;
    public $msgErro = "";

    public function conectar($nome, $host, $usuario, $senha)
    {

        global $pdo;

        try {
            $pdo = new PDO('mysql:host='.$host.';dbname='.$nome, $usuario, $senha);
        } catch (PDOException $e) {
            $msgErro = $e->getMessage();
        }
    }

    public function cadastrar($nomeusuario, $numerobi, $email, $senha)
}
