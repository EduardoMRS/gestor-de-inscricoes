<?php
session_start();
include("../../../assets/conf/config.php");
include("../../../assets/conf/config_evento.php");

if (empty($_SESSION['logado'])) {
    header('location: login.php');
}

$scriptSELECT = "SELECT * FROM `" . $db_conect_date['name'] . "`.`" . $db_conect_date['table'] . "` WHERE idUser='" . $_GET['cod'] . "';";
// echo $scriptSELECT;
if (mysqli_num_rows($dbConect->query($scriptSELECT)) == 1) {
    $result = $dbConect->query($scriptSELECT);
    $userData = mysqli_fetch_assoc($result);
} else {
    header("location: ../../list/");
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Inscrição <?php echo $_GET['cod'] ?></title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../../../assets/fonts/fa/css/all.css">


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.6/jquery.inputmask.min.js"></script>
</head>

<body class="align-items-center justify-content-center" onload="window.print()">
    <form action="../inscricao/confirmacao/index.php" method="post" class="row py-4 px-4 gap-2 align-items-center justify-content-center">
        <div class="row justify-content-between">
            <h5 class="text-uppercase" style="font-weight: bold;">Formulario de Inscrição <?php echo $_GET['cod'] ?></h5>
            <div class="col">
                <label for="user_nome" class="form-label">Nome</label>
                <input class="form-control" type="text" name="user_nome" id="user_nome" readonly value="<?php echo ucwords(strtolower($userData['nome'])) ?>">
            </div>
            <div class="col">
                <label for="user_sobrenome" class="form-label">Sobrenome</label>
                <input class="form-control" type="text" name="user_sobrenome" id="user_sobrenome" readonly value="<?php echo ucwords(strtolower($userData['sobrenome'])) ?>">
            </div>
            <div class="col-4">
                <label for="user_idade" class="form-label">Idade</label>
                <input class="form-control" type="number" pattern="\d*" name="user_idade" id="user_idade" min="8" max="100" readonly value="<?php echo $userData['idade'] ?>">
            </div>
            <div class="row py-2">
                <div class="col-4">
                    <label for="user_cpf" class="form-label">CPF</label>
                    <input class="form-control" type="text" name="user_cpf" id="user_cpf" readonly value="<?php echo $userData['cpf'] ?>">
                </div>
                <div class="col-auto">
                    <label for="user_membro" class="form-label">É membro ou frequenta alguma igreja?</label>
                    <select name="user_membro" id="user_membro" class="form-control" disabled>
                        <option value="0" <?php echo ($userData['membro'] == 0) ? 'selected' : '' ?>>Não</option>
                        <option value="1" <?php echo ($userData['membro'] == 1) ? 'selected' : '' ?>>Sou membro</option>
                        <option value="2" <?php echo ($userData['membro'] == 2) ? 'selected' : '' ?>>Sou de outra</option>
                    </select>
                </div>
                <div class="col-auto">
                    <label class="form-label">Status do Pagamento</label>
                    <select class="form-select col" name="check_status_pagamento" id="check_status_pagamento" disabled>
                        <option value="0" <?php echo ($userData['status_pagamento'] == 0) ? 'selected' : '' ?>>Aguardando Pagamento</option>
                        <option value="1" <?php echo ($userData['status_pagamento'] == 1) ? 'selected' : '' ?>>Aguardando Aprovação</option>
                        <option value="2" <?php echo ($userData['status_pagamento'] == 2) ? 'selected' : '' ?>>Pagamento Aprovado</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row justify-content-between" id="responsavel">
            <hr class="my-2">
            <h6 class="text-uppercase" style="font-weight: bold;">Dados do Responsavel</h6>
            <div class="col-7">
                <label for="user_responsavel" class="form-label">Nome do Responsavel</label>
                <input class="form-control" type="text" name="user_responsavel" id="user_responsavel" required readonly value="<?php echo ucwords(strtolower($userData['responsavel'])) ?>">
            </div>
            <div class="col-4">
                <label for="user_responsavel_cpf" class="form-label">CPF do Responsavel</label>
                <input class="form-control" type="text" name="user_responsavel_cpf" id="user_responsavel_cpf" required readonly value="<?php echo $userData['responsavel_cpf'] ?>">
            </div>
            <hr class="mt-2">
        </div>
        <div class="row justify-content-center">
            <h6 class="text-uppercase" style="font-weight: bold;">Informações para Contato</h6>
            <div class="row">
                <div class="col-auto">
                    <label for="user_estado" class="form-label">Estado:</label>
                    <select name="user_estado" id="user_estado" class="form-control" disabled>
                        <option value=""><?php echo $userData['estado'] ?></option>
                    </select>
                </div>
                <div class="col-auto">
                    <label for="user_cidade" class="form-label">Cidade:</label>
                    <select name="user_cidade" id="user_cidade" class="form-control" disabled>
                        <option value=""><?php echo $userData['cidade'] ?></option>
                    </select>
                </div>
                <div class="col">
                    <label for="user_cell" class="form-label">Endereço</label>
                    <input class="form-control" type="text" name="user_endereco_rua" id="user_endereco_rua" readonly value="<?php echo $userData['endereco'] ?>">
                </div>
            </div>
            <div class="row justify-content-between mt-3">
                <div class="col-4">
                    <label for="user_cell" class="form-label">Celular / WhatsApp</label>
                    <input class="form-control" type="text" name="user_cell" id="user_cell" readonly value="<?php echo $userData['cell'] ?>">
                </div>
                <div class="col">
                    <label for="user_mail" class="form-label">E-Mail</label>
                    <input class="form-control" type="email" name="user_mail" id="user_mail" readonly value="<?php echo $userData['email'] ?>">
                </div>
            </div>
        </div>
        <hr class="mt-2">
        <div class="row justify-content-center">
            <h6 class="text-uppercase" style="font-weight: bold;">Alergias</h6>
            <div class="row gap-3 justify-content-between">
                <div class="col">
                    <div class="row">
                        <label class="form-label">Alimentos</label>
                        <textarea class="form-control" rows="12" name="check_alergia_alimentos_textarea" id="check_alergia_alimentos_textarea" readonly><?php echo $userData['alergia_alimento'] ?></textarea>
                    </div>
                </div>
                <div class="col">
                    <div class="row">
                        <label class="form-label">Medicamentos</label>
                        <textarea class="form-control" rows="12" name="check_alergia_medicamento_textarea" id="check_alergia_medicamento_textarea" readonly><?php echo $userData['alergia_medicamento'] ?></textarea>
                    </div>
                </div>
                <div class="col">
                    <div class="row">
                        <label class="form-label">Insetos</label>
                        <textarea class="form-control" rows="12" name="check_alergia_insetos_textarea" id="check_alergia_insetos_textarea" readonly><?php echo $userData['alergia_inseto'] ?></textarea>
                    </div>
                </div>
            </div>
        </div>
    </form>
</body>

</html>