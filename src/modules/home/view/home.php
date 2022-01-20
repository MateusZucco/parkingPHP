<?php
    include_once('../../auth/scripts/verifica_login.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">
</head>
<body>
<?php 
  include('../scripts/historyDao.php');
  $arr = parkingHistory();
?>
    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="jumbotron col-md-6">
                <form action="../scripts/CarDao.php" method="post">
                    <div class="form-group">
                        <label for="carPlate">Placa</label>
                        <input type="text" pattern='[A-Z]{3}[0-9][0-9A-Z][0-9]{2}' placeholder='AAA0000' class="form-control" name="carPlate" id="carPlate">
                        <div class="help-text">padrão de placas do mercosul</div>
                    </div>
                    <input type="submit" class="btn btn-primary" value="Enviar">
                </form>
            </div>
        </div>
        <div class="row">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Placa</th>
                        <th scope="col">Modelo</th>
                        <th scope="col">Cor</th>
                        <th scope="col">Entrada</th>
                        <th scope="col">Saida</th>
                        <th scope="col">À pagar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($arr as $obj)  {
                        echo '<tr>';
                            echo '<td scope="col">'.$obj["placa"].'</td>';
                            echo '<td>'.$obj["fabricante"].' '.$obj["modelo"].'</td>';
                            echo '<td>'.$obj["cor"].'</td>';
                            echo '<td>'.$obj["hr_entrada"].'</td>';
                            echo '<td>'.$obj["hr_saida"].'</td>';
                            if ($obj["hr_saida"] != null)
                            {
                                $horas = ceil((strtotime($obj['hr_saida']) - strtotime($obj['hr_entrada']))/ 3600);
                                echo '<td>'.($horas * 5.5).'</td>';
                            }
                        echo '</tr>';
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>