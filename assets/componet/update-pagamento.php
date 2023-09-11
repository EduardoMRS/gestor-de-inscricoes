<?php
include_once("../conf/config.php");
session_start();

$scriptSELECT = "SELECT * FROM `" . $db_conect_date['name'] . "`.`" . $db_conect_date['table'] . "` where idUser='" . $_SESSION['idUser'] . "'";
$query = "UPDATE `" . $db_conect_date['name'] . "`.`" . $db_conect_date['table'] . "` SET `status_pagamento`='1' WHERE `idUser`='" . $_SESSION['idUser'] . "';";
$result = $dbConect->query($query);

if (mysqli_num_rows($dbConect->query($scriptSELECT)) < 0) {
    $userData = mysqli_fetch_assoc($result);
    $_SESSION['user_nome'] = $userData['nome'];
    $_SESSION['user_mail'] = $userData['email'];
    $_SESSION['user_cpf'] = $userData['cpf'];
    $_SESSION['user_cell'] = $userData['cell'];
    $_SESSION['status_pagamento'] = $userData['status_pagamento'];
    $_SESSION['user_permissao'] = explode(",", $userData['permissao']);
}
