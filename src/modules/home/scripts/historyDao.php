<?php
    include_once("../../../connection/conexao.php");

    function parkingHistory()
    {
        $date = date('y-m-d H:i:s');
        $conexao = criaConexao();
        $sql = "select * from entrada_saida join veiculos on entrada_saida.veiculo = veiculos.id order by entrada_saida.id desc limit 50;";
        $stmt = $conexao->prepare($sql);
        try {
            $stmt->execute();
            $arr = $stmt->fetch(PDO::FETCH_ASSOC);
            return $arr['placa'];
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
?>