<?php
include_once("../../../connection/conexao.php");

$plate =  $_POST['carPlate'];
$model =  $_POST['carModel'];
$color =  $_POST['carColor'];
$brand =  $_POST['carBrand'];

register($plate, $model, $color, $brand);

function register($plate, $model, $color, $brand)
{
    $conexao = criaConexao();
    $sql = "insert into veiculos(placa, modelo, cor, fabricante) values(:plate, :model, :color, :brand)";

    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(":plate", $plate);
    $stmt->bindParam(":model", $model);
    $stmt->bindParam(":color", $color);
    $stmt->bindParam(":brand", $brand);
    
    try {
        $stmt->execute();
        $sql2 = "select * from veiculos where veiculos.placa = :plate";
        $stmt = $conexao->prepare($sql2);
        $stmt->bindParam(":plate", $plate);
        try {
            $stmt->execute();
            $car = $stmt->fetch(PDO::FETCH_ASSOC);
            registerEntry($car,$conexao);
            header("Location:../view/home.php");
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

}

function registerEntry($car, $conexao){
    date_default_timezone_set("America/Sao_Paulo");
    $date = date('y-m-d H:i:s');
    $sqlEntradaCarro = "insert into entrada_saida(veiculo, hr_entrada) values(:carId, :date)";
    $stmt = $conexao->prepare($sqlEntradaCarro);
    $stmt->bindParam(":date", $date);
    $stmt->bindParam(":carId", $car['id']);
    try{
        $stmt->execute();
    }catch (PDOException $e) {
        echo $e->getMessage();
    }
}

?>