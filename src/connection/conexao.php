<?php
define("SERVER", "127.0.0.1");
define("USER", "root");
define("PASS", "");
define("DB", "estacionamento");

function criaConexao()
{
    try {
        $conexao = new PDO('mysql:host=' . SERVER . ';dbname=' . DB, USER, PASS);
        return $conexao;
    } catch (PDOException $e) {
        echo "Erro na conexão. Erro gerado: " . $e->getMessage();
    }
}
