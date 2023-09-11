<?php
include_once("../conf/config.php");
if (mysqli_num_rows($dbConect->query("SELECT * FROM `" . $db_conect_date['name'] . "`.`" . $db_conect_date['table'] . "` WHERE idUser='" . $_GET['cod'] . "'")) == 0) {
    // Parâmetro inválido, retorne uma resposta de erro
    http_response_code(400); // Defina o código de status HTTP para indicar um erro de solicitação inválida
    echo "Ticket Invalido!";
    exit; // Interrompe o script PHP e impede a continuação do fetch
}
$user_data = mysqli_fetch_assoc($dbConect->query("SELECT * FROM `" . $db_conect_date['name'] . "`.`" . $db_conect_date['table'] . "` WHERE idUser='" . $_GET['cod'] . "'"));
?>

<div class="row">
    <h6 class="text-uppercase" style="font-weight: bold;">Dados da Inscrição</h6>
    <div class="col">
        <label for="user_nome_completo" class="form-label">Nome Completo</label>
        <input class="form-control" type="text" id="user_nome_completo" value="<?php echo ucwords(strtolower($user_data['nome'])) . " " . ucwords(strtolower($user_data['sobrenome'])) ?>" readonly>
    </div>
</div>
<div class="row justify-content-between">
    <div class="col-9">
        <label for="user_cpf" class="form-label">CPF</label>
        <input class="form-control" type="text" name="user_cpf" id="user_cpf" value="<?php echo $user_data['cpf'] ?>" readonly>
    </div>
    <div class="col-3" style="max-width: 80px;">
        <label for="user_idade" class="form-label">Idade</label>
        <input class="form-control" type="text" name="user_idade" id="user_idade" value="<?php echo $user_data['idade'] ?>" readonly>
    </div>
</div>
<div class="row">
    <div class="col">
        <label for="status_pagamento" class="form-label">Status do Pagamento</label>
        <input class="form-select col" name="status_pagamento" id="status_pagamento" readonly value="<?php
                                                                                                        switch ($user_data['status_pagamento']) {
                                                                                                            case '0':
                                                                                                                echo "Aguardando Pagamento";
                                                                                                                break;

                                                                                                            case '1':
                                                                                                                echo "Aguardando Aprovação";
                                                                                                                break;

                                                                                                            case '2':
                                                                                                                echo "Pagamento Aprovado";
                                                                                                                break;
                                                                                                            default:
                                                                                                                echo "Erro";
                                                                                                                break;
                                                                                                        }
                                                                                                        ?>">
    </div>
</div>
<div class="row justify-content-between gap-2" id="responsavel">
    <hr class="my-2">
    <h6 class="text-uppercase" style="font-weight: bold;">Dados do Responsavel</h6>
    <div class="col-sm-auto">
        <label for="user_responsavel" class="form-label">Nome do Responsavel</label>
        <input class="form-control" type="text" name="user_responsavel" id="user_responsavel" value="<?php echo ucwords(strtolower($user_data['responsavel'])) ?>" readonly>
    </div>
    <div class="col-sm-auto">
        <label for="user_responsavel_cpf" class="form-label">CPF do Responsavel</label>
        <input class="form-control" type="text" inputmode="numeric" name="user_responsavel_cpf" id="user_responsavel_cpf" value="<?php echo $user_data['responsavel_cpf'] ?>" readonly>
    </div>
</div>