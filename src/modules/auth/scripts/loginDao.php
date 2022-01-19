<?php
include_once("../../../connection/conexao.php");

function doLogin($count, $user)
{
    if ($count == 1 ) {
        session_start();
        $_SESSION['user'] = $user;
        header('Location: ../../home/view/home.php');
    } else {
        header('Location:../view/index.html');
    }
}
