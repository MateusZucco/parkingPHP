<?php
include_once("../../../connection/conexao.php");

$plate =  $_POST['carPlate'];
parking($plate);


function parking($plate)
{
    $conexao = criaConexao();
    $sql = "select * from veiculos join entrada_saida on entrada_saida.veiculo = veiculos.id where veiculos.placa =
    '{$plate}' order by entrada_saida.id desc limit 1;";
    $stmt = $conexao->prepare($sql);
    try {
        $stmt->execute();
        $entry = $stmt->fetch(PDO::FETCH_ASSOC);
        error_log($entry['veiculo']);
        isCarRegistered($entry, $plate, $conexao);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

}

function isCarRegistered($entry, $plate, $conexao){
    date_default_timezone_set("America/Sao_Paulo");
    $date = date('y-m-d H:i:s');
    if ($entry && !$entry['hr_saida']){        
        $sqlSaidaCarro = "update entrada_saida es inner join veiculos v on es.veiculo = v.id set hr_saida = :date where es.id = :carId";
        $stmt = $conexao->prepare($sqlSaidaCarro);
        $stmt->bindParam(":date", $date);
        $stmt->bindParam(":carId", $entry['id']);
        try{
            $stmt->execute();
            header("Location:../view/home.php");
        }catch (PDOException $e) {
            echo $e->getMessage();
        }
    }else if ($entry['hr_saida']) {
        $sqlEntradaCarro = "insert into entrada_saida(veiculo, hr_entrada) values(:carId, :date)";
        $stmt = $conexao->prepare($sqlEntradaCarro);
        $stmt->bindParam(":date", $date);
        $stmt->bindParam(":carId", $entry['veiculo']);
        try{
            $stmt->execute();
            header("Location:../view/home.php");
        }catch (PDOException $e) {
            echo $e->getMessage();
        }
    } else {
        header("Location:../view/register.php?plate=".$plate);
    }
    
}
