<?php
if (mysqli_num_rows($dbConect->query($scriptSELECT)) == 1) {
    $result = $dbConect->query($scriptSELECT);
    $userData = mysqli_fetch_assoc($result);

    //Update Usuario
    $_SESSION['idUser'] = $userData['idUser'];
    $_SESSION['user_nome'] = $userData['nome'];
    $_SESSION['user_mail'] = $userData['email'];
    $_SESSION['user_cpf'] = $userData['cpf'];
    $_SESSION['user_cell'] = $userData['cell'];
    $_SESSION['status_pagamento'] = $userData['status_pagamento'];
    $_SESSION['user_permissao'] = explode(",", $userData['permissao']);
}
