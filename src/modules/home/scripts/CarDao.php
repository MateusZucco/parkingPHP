<?php
include_once("../../../connection/conexao.php");

$plate =  $_POST['carPlate'];
parking($plate);


function parking($plate)
{
    $conexao = criaConexao();
    $sql = "select * from cars where placa = '{$plate}'";

    $stmt = $conexao->prepare($sql);
    try {
        $stmt->execute();
        $car = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($car){
            echo $car['modelo'];
        }else{
            echo 'faz meu pau de trampolin';
        }
        
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

}