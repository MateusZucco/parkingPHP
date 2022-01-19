<?php
include_once ('../../../connection/conexao.php');
include_once ('./loginDao.php');

$userName =  $_POST['userName'];
$password = $_POST['userPassword'];
$conexao = criaConexao();
$sql = "select * from usuarios where username = '{$userName}' and password = '{$password}'";

$stmt = $conexao->prepare($sql);
try {
    $stmt->execute();
    $count = $stmt->rowCount();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    doLogin($count, $user['username']);
} catch (PDOException $e) {
    echo $e->getMessage();


}
