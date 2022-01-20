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
        isCarRegistered($car, $plate, $conexao);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

}

function isCarRegistered($car, $plate, $conexao){
    if ($car){        
        date_default_timezone_set("America/Sao_Paulo");
        $date = date('y-m-d H:i:s');
        $sqlSaidaCarro = "update entrada_saida es inner join veiculos v on es.veiculo = v.id set hr_saida = :date where es.veiculo = :carId";
        $stmt = $conexao->prepare($sqlSaidaCarro);
        $stmt->bindParam(":date", $date);
        $stmt->bindParam(":carId", $car['id']);
        try{
            $stmt->execute();
        }catch (PDOException $e) {
            echo $e->getMessage();
        }
    }else{
        header("Location:../view/register.php?plate=".$plate);
    }
    
}
