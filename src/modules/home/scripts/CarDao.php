<?php
include_once("../../../connection/conexao.php");

$plate =  $_POST['carPlate'];
parking($plate);


function parking($plate)
{
    $conexao = criaConexao();
    $sql = "select * from veiculos where placa = '{$plate}'";

    $stmt = $conexao->prepare($sql);
    try {
        $stmt->execute();
        $car = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($car){
            date_default_timezone_set("America/Sao_Paulo");
            $hour = date("d-m-Y H:i:s");
            $carId = $car['id'];         
            $sqlSaidaCarro = "update entrada_saida es inner join veiculos v on es.veiculo = v.id set hr_saida = '{$hour}' where es.veiculo = '{$carId}'";
            $stmt2 = $conexao->prepare($sqlSaidaCarro);
            $stmt2->execute();
        }else{
            echo 'faz meu pau de trampolin';
        }
        
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

}