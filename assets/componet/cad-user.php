<?php
session_start();
include_once('../conf/config.php');
$timezone = new DateTimeZone('America/Manaus');
if (isset($_POST['user_confirma'])) {
    $user_nome = ucwords(strtolower($_POST['user_nome']));
    $user_sobrenome = ucwords(strtolower($_POST['user_sobrenome']));
    $user_cpf = $_POST['user_cpf'];
    $alergia_alimentos = $_POST['alergia_alimentos'];
    $alergia_medicamento = $_POST['alergia_medicamento'];
    $alergia_insetos = $_POST['alergia_insetos'];
    $user_membro = $_POST['user_membro'];
    $user_idade = $_POST['user_idade'];
    $user_mail = $_POST['user_mail'];
    $user_cell = $_POST['user_cell'];
    $user_cidade = $_POST['user_cidade'];
    $user_estado = $_POST['user_estado'];
    $user_endereco = $_POST['user_endereco'];
    $user_responsavel = ucwords(strtolower($_POST['user_responsavel']));
    $user_responsavel_cpf = $_POST['user_responsavel_cpf'];
    $user_pagamento = 0;

    $scriptSELECT = "SELECT * FROM `" . $db_conect_date['name'] . "`.`" . $db_conect_date['table'] . "` WHERE email='$user_mail' or cpf='$user_cpf' or cell='$user_cell';";
    // echo $scriptSELECT;
    if (mysqli_num_rows($dbConect->query($scriptSELECT)) > 0) {
        $_SESSION['msg_login'] = 'Atenção: Já foi realizado um inscrição com esses dados, se for voce faça login!';
        header("location: ../../");
    } else {
        // echo '<h2 style="color:red ">Atenção:</h2><h3 style="color:black">Dados validos para inscrição!<h3>';
        $scriptQuery = "INSERT INTO `" . $db_conect_date['name'] . "`.`" . $db_conect_date['table'] . "` (`nome`, `sobrenome`, `cpf`, `alergia_alimento`, `alergia_medicamento`, `alergia_inseto`, `membro`, `idade`, `email`, `cell`, `cidade`, `estado`, `endereco`, `responsavel`, `responsavel_cpf`,`status_pagamento`) VALUES ('$user_nome', '$user_sobrenome', '$user_cpf', '$alergia_alimentos', '$alergia_medicamento', '$alergia_insetos', '$user_membro', '$user_idade', '$user_mail', '$user_cell', " . '"' . $user_cidade . '"' . ", '$user_estado', '$user_endereco', '$user_responsavel', '$user_responsavel_cpf','$user_pagamento');";
        // echo $scriptQuery;
        if ($result = $dbConect->query($scriptQuery)) {
            // echo '<br>INSERT Realizado com Sucesso!';
            $_SESSION['user_nome'] = $user_nome;
            $_SESSION['user_mail'] = $user_mail;
            $_SESSION['user_cpf'] = $user_cpf;
            $_SESSION['user_cell'] = $user_cell;
            $_SESSION['status_pagamento'] = $user_pagamento;
            $_SESSION['user_permissao'] = explode(",", "1,0,0,0");
            $_SESSION['logado'] = true;

            header('location: ../../pagamento/');
        } else {
            // echo '<br>Erro no INSERT';
        }
    }
} else {
    // echo '<br><br>Não realizado POST';
}
