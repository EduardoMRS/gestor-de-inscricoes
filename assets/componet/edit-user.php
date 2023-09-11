<?php
session_start();
include_once('../conf/config.php');

if (isset($_POST['btn_save_edit'])) {
    $idUser = $_POST['user_cod'];
    $user_nome = $_POST['user_nome'];
    $user_sobrenome = $_POST['user_sobrenome'];
    $user_cpf = $_POST['user_cpf'];
    $alergia_alimentos = $_POST['check_alergia_alimentos_textarea'];
    $alergia_medicamento = $_POST['check_alergia_medicamento_textarea'];
    $alergia_insetos = $_POST['check_alergia_insetos_textarea'];
    $user_membro = $_POST['user_membro'];
    $user_idade = $_POST['user_idade'];
    $user_mail = $_POST['user_mail'];
    $user_cell = $_POST['user_cell'];
    $user_endereco = $_POST['user_endereco'];
    $user_responsavel = $_POST['user_responsavel'];
    $user_responsavel_cpf = $_POST['user_responsavel_cpf'];
    $user_pagamento = $_POST['check_status_pagamento'];


    $update_permissao = explode(",", $_POST['user_permissao']);
    $update_permissao[1] = ($_POST['user_permissao_edit']) ? 1 : 0;
    $user_permissao = implode(",", $update_permissao);


    $scriptSELECT = "SELECT * FROM `" . $db_conect_date['name'] . "`.`" . $db_conect_date['table'] . "` WHERE `idUser`='$idUser';";
    // echo $scriptSELECT;
    if (mysqli_num_rows($dbConect->query($scriptSELECT)) < 0) {
        $_SESSION['msg'] = '<h2 style="color:red ">Atenção: Ocorreu um erro! Usuario não encontrado!</h2>';
    } else {
        $scriptQuery = "UPDATE `" . $db_conect_date['name'] . "`.`" . $db_conect_date['table'] . "` SET `nome`='$user_nome', `sobrenome`='$user_sobrenome', `cpf`='$user_cpf', `alergia_alimento`='$alergia_alimentos', `alergia_medicamento`='$alergia_medicamento',
        `alergia_inseto`='$alergia_insetos', `membro`='$user_membro', `idade`='$user_idade', `email`='$user_mail', `cell`='$user_cell', `endereco`='$user_endereco', `responsavel`='$user_responsavel', 
        `responsavel_cpf`='$user_responsavel_cpf', `status_pagamento`='$user_pagamento', `permissao`='$user_permissao' WHERE `idUser`='$idUser'; ";
        // echo "<br>" . $scriptQuery . "<br>";
        if ($result = $dbConect->query($scriptQuery)) {
            // echo '<br>UPDATE Realizado';
            $_SESSION['msg'] = '<h2 style="color:Green ">Atenção: Os dados da inscrição foram salvos com sucesso!</h2>';
        } else {
            // echo '<br>Erro no UPDATE';
        }
    }
} elseif ($_GET['user_del']) {
    $scriptSELECT = "SELECT * FROM `" . $db_conect_date['name'] . "`.`" . $db_conect_date['table'] . "` WHERE `idUser`='" . $_GET['user_del'] . "';";
    // echo $scriptSELECT;
    if (mysqli_num_rows($dbConect->query($scriptSELECT)) < 0) {
        $_SESSION['msg'] = '<h2 style="color:red ">Atenção: Ocorreu um erro! Usuario não encontrado!</h2>';
    } else {
        $scriptQuery = "UPDATE `" . $db_conect_date['name'] . "`.`usuario` SET `active`='0' WHERE `idUser`='" . $_GET['user_del'] . "'; ";
        // echo "<br>" . $scriptQuery . "<br>";
        if ($result = $dbConect->query($scriptQuery)) {
            // echo '<br>UPDATE Realizado';
            $_SESSION['msg'] = '<h2 style="color:Green ">Atenção: Inscrição cancelada com sucesso!</h2>';
            header("location: " . $siteConf['url'] . "/user/list");
        } else {
            // echo '<br>Erro no UPDATE';
        }
    }
} else {
    // echo '<br><br>Não realizado POST';
}
header('location: ../../');
