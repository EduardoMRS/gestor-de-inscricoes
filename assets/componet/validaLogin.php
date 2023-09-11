<?php
session_start();
if (isset($_POST['submitLogin']) && !empty($_POST['usuario']) && !empty($_POST['user_cpf'])) { //Verifica se existe a variavel submitLogin em POST
    $usuario = $_POST['usuario'];
    $user_cpf = $_POST['user_cpf'];

    include_once('../conf/config.php');
    $query = "SELECT * FROM `" . $db_conect_date['name'] . "`.`" . $db_conect_date['table'] . "` where email='$usuario' and cpf='$user_cpf'";
    $result = $dbConect->query($query);
    $userData = mysqli_fetch_assoc($result);
    if (mysqli_num_rows($result) < 1) {
        unset($_SESSION['idUser']);
        unset($_SESSION['user_nome']);
        unset($_SESSION['user_mail']);
        unset($_SESSION['user_cpf']);
        unset($_SESSION['user_cell']);
        unset($_SESSION['status_pagamento']);
        unset($_SESSION['user_permissao']);
        $_SESSION['logado'] = false;

        $_SESSION['msg_login'] = "Atenção: E-Mail ou CPF não registrado!";
    } else {
        //permissão: 0(Novo Registro) 1(Edição de Registro) 2(Exclusão de Fotos) 3(Exclusão de Registros) 4(Gerencia de Usuarios) 5(Gerencia Web da Aplicação) 6(Beta Tester)
        $_SESSION['idUser'] = $userData['idUser'];
        $_SESSION['user_nome'] = $userData['nome'];
        $_SESSION['user_mail'] = $userData['email'];
        $_SESSION['user_cpf'] = $userData['cpf'];
        $_SESSION['user_cell'] = $userData['cell'];
        $_SESSION['status_pagamento'] = $userData['status_pagamento'];
        $_SESSION['user_permissao'] = explode(",", $userData['permissao']);
        $_SESSION['logado'] = true;

        header("location: ../../user/");
        // if ($userData['status_pagamento'] == 0) {
        //     header("location: ../../pagamento/");
        // } else {
        //     if ($userData['status_pagamento'] == 1) {
        //         header("location: ../../pagamento/status/?case=1");
        //     } else {
        //         if ($userData['status_pagamento'] == 2) {
        //             header("location: ../../pagamento/status/?case=2");
        //         }
        //     }
        // }
    }
} else {
    $_SESSION['msg_login'] = "Atenção: Para fazer login é necessario informar seu E-Mail e CPF";
}
header('location: ../../');
