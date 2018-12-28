<?php
    session_start();

    if($_GET['op'] == 1){
        include_once '../model/Login.php';

        $login = new Login();

        $login->construtor($_POST['usuario'],
                           $_POST['senha']);

        header ($login->verificarLogin());
    }
?>