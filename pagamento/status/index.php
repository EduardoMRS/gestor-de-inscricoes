<?php
session_start();
include("../../assets/conf/config.php");
$scriptSELECT = "SELECT * FROM `". $db_conect_date['name'] ."`.`" . $db_conect_date['table'] . "` WHERE idUser='" . $_SESSION['idUser'] . "';";
echo $scriptSELECT;
if (mysqli_num_rows($dbConect->query($scriptSELECT)) == 1) {
    echo 'Usuario encontrado';
    $result = $dbConect->query($scriptSELECT);
    $userData = mysqli_fetch_assoc($result);
    if ($_GET['case'] == 1 or $userData['status_pagamento'] == 1) {
        header("location: ./analise/");
    } else {
        if ($_GET['case'] == 2 or $userData['status_pagamento'] == 2) {
            header("location: ./aprovado/");
        } else {
            if ($_GET['case'] == 0 or $userData['status_pagamento'] == 0) {
                header("location: ../");
            }
        }
    }
} else {
    header("location: ../../");
}
