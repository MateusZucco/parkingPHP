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

<?php
include_once('../../auth/scripts/verifica_login.php')
?>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="jumbotron col-md-6">
            <h1 for="carPlate">Registrar Carro</h1>
                <form action="../scripts/registerDao.php" method="post">
                    <div class="form-group">
                        <label for="carPlate">Placa</label>
                        <input type="text" class="form-control" readonly value="<?=$_GET['plate']; ?>" name="carPlate" id="carPlate">
                    </div>
                    <div class="form-group">
                        <label for="carModel">Modelo</label>
                        <input type="text" class="form-control" name="carModel" id="carModel">
                    </div>
                    <div class="form-group">
                        <label for="carBrand">Marca</label>
                        <input type="text" class="form-control" name="carBrand" id="carBrand">
                    </div>
                    <div class="form-group">
                        <label for="carColor">Cor</label>
                        <input type="text" class="form-control" name="carColor" id="carColor">
                    </div>
                    <input type="submit" class="btn btn-primary" value="Cadastrar">
                </form>
            </div>
        </div>
    </div>
</body>

</html>