<?php
include_once("../conf/config.php");
$resultList = $dbConect->query("SELECT * FROM `" . $db_conect_date['name'] . "`.`" . $db_conect_date['table'] . "` WHERE idUser='" . $_GET['cod'] . "'");
$userData = mysqli_fetch_assoc($resultList);
?>



<style>
    h6 {
        color: white;
    }

    hr {
        color: white;
    }
</style>
<form action="/formula/assets/componet/edit-user.php" method="post" class="row p-4 gap-2 d-flex align-items-center justify-content-center">
    <input type="hidden" name="user_cod" value="<?php echo $_GET['cod'] ?>">
    <div class="d-flex row justify-content-between gap-2">
        <div class="col-sm">
            <label for="user_nome" class="form-label">Nome</label>
            <input class="form-control" type="text" name="user_nome" id="user_nome" value="<?php echo ucwords(strtolower($userData['nome'])) ?>">
        </div>
        <div class="col-sm">
            <label for="user_sobrenome" class="form-label">Sobrenome</label>
            <input class="form-control" type="text" name="user_sobrenome" id="user_sobrenome" value="<?php echo ucwords(strtolower($userData['sobrenome'])) ?>">
        </div>
        <div class="col-sm-auto">
            <label for="user_idade" class="form-label">Idade</label>
            <input class="form-control" type="number" inputmode="numeric" name="user_idade" id="user_idade" min="8" max="100" value="<?php echo $userData['idade'] ?>">
        </div>
        <div class="col-sm-4">
            <label for="user_cpf" class="form-label">CPF</label>
            <input class="form-control" type="text" inputmode="numeric" name="user_cpf" id="user_cpf" value="<?php echo $userData['cpf'] ?>">
        </div>
        <div class="col-sm-auto">
            <label for="user_membro" class="form-label">É membro ou frequenta alguma igreja?</label>
            <select name="user_membro" id="user_membro" class="form-control">
                <option value="0" <?php echo ($userData['membro'] == 0) ? 'selected' : '' ?>>Não</option>
                <option value="1" <?php echo ($userData['membro'] == 1) ? 'selected' : '' ?>>Sou membro</option>
                <option value="2" <?php echo ($userData['membro'] == 2) ? 'selected' : '' ?>>Sou de outra</option>
            </select>
        </div>
        <div class="col-sm-5">
            <label for="check_status_pagamento" class="form-label">Status do Pagamento</label>
            <select class="form-select col" name="check_status_pagamento" id="check_status_pagamento">
                <option value="0" <?php echo ($userData['status_pagamento'] == 0) ? 'selected' : '' ?>>Aguardando Pagamento</option>
                <option value="1" <?php echo ($userData['status_pagamento'] == 1) ? 'selected' : '' ?>>Aguardando Aprovação</option>
                <option value="2" <?php echo ($userData['status_pagamento'] == 2) ? 'selected' : '' ?>>Pagamento Aprovado</option>
            </select>
        </div>
    </div>
    <div class="row justify-content-between gap-2" id="responsavel">
        <hr class="my-2">
        <h6 class="text-uppercase" style="font-weight: bold;">Dados do Responsavel</h6>
        <div class="col-sm-7">
            <label for="user_responsavel" class="form-label">Nome do Responsavel</label>
            <input class="form-control" type="text" name="user_responsavel" id="user_responsavel" value="<?php echo ucwords(strtolower($userData['responsavel'])) ?>">
        </div>
        <div class="col-sm-4">
            <label for="user_responsavel_cpf" class="form-label">CPF do Responsavel</label>
            <input class="form-control" type="text" inputmode="numeric" name="user_responsavel_cpf" id="user_responsavel_cpf" value="<?php echo $userData['responsavel_cpf'] ?>">
        </div>
        <hr class="mt-2">
    </div>
    <div class="row justify-content-center">
        <h6 class="text-uppercase" style="font-weight: bold;">Informações para Contato</h6>
        <div class="row justify-content-between">
            <div class="col-auto">
                <label for="user_estado" class="form-label">Estado:</label>
                <select name="user_estado" id="user_estado" class="form-control">
                    <option value=""><?php echo $userData['estado'] ?></option>
                </select>
            </div>
            <div class="col-auto">
                <label for="user_cidade" class="form-label">Cidade:</label>
                <select name="user_cidade" id="user_cidade" class="form-control">
                    <option value=""><?php echo $userData['cidade'] ?></option>
                </select>
            </div>
            <div class="col">
                <label for="user_cell" class="form-label">Endereço</label>
                <input class="form-control" type="text" name="user_endereco" id="user_endereco" value="<?php echo $userData['endereco'] ?>">
            </div>
        </div>
        <div class="row justify-content-between mt-3">
            <div class="col-sm-4">
                <label for="user_cell" class="form-label">Celular / WhatsApp</label>
                <input class="form-control" type="text" inputmode="numeric" name="user_cell" id="user_cell" value="<?php echo $userData['cell'] ?>">
            </div>
            <div class="col-sm">
                <label for="user_mail" class="form-label">E-Mail</label>
                <input class="form-control" type="email" name="user_mail" id="user_mail" value="<?php echo $userData['email'] ?>">
            </div>
        </div>
    </div>
    <hr class="mt-2">
    <div class="row justify-content-center">
        <h6 class="text-uppercase" style="font-weight: bold;">Alergias</h6>
        <div class="row gap-3 justify-content-between">
            <div class="col-sm">
                <div class="row">
                    <label class="form-label" for="check_alergia_alimentos_textarea">Alimentos</label>
                    <textarea class="form-control" rows="7" name="check_alergia_alimentos_textarea" id="check_alergia_alimentos_textarea"><?php echo $userData['alergia_alimento'] ?></textarea>
                </div>
            </div>
            <div class="col-sm">
                <div class="row">
                    <label class="form-label" for="check_alergia_medicamento_textarea">Medicamentos</label>
                    <textarea class="form-control" rows="7" name="check_alergia_medicamento_textarea" id="check_alergia_medicamento_textarea"><?php echo $userData['alergia_medicamento'] ?></textarea>
                </div>
            </div>
            <div class="col-sm">
                <div class="row">
                    <label class="form-label" for="check_alergia_insetos_textarea">Insetos</label>
                    <textarea class="form-control" rows="7" name="check_alergia_insetos_textarea" id="check_alergia_insetos_textarea"><?php echo $userData['alergia_inseto'] ?></textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center text-center pt-4">
        <div>
            <input type="hidden" name="user_permissao" id="user_permissao" value="<?php echo $userData['permissao'] ?>">
            <input class="form-form-check-input" type="checkbox" name="user_permissao_edit" id="user_permissao_edit" <?php echo (explode(",", $userData['permissao'])['1']) ? " checked" : "" ?>>
            <label for="user_permissao_edit" class="form-check-label"> Marque para o usuário ter permissão de organizador</label>
        </div>
        <div class="pb-2" style="width: 50vw;">
            <button type="submit" class="btn btn-success w-100" style="height: 4rem;" name="btn_save_edit" id="btn_save_edit">
                Salvar Alterações
            </button>
        </div>
    </div>
</form>

<script>
    // Adiciona mascara no CPF
    $(document).ready(function() {
        // Máscara de CPF para o campo user_cpf
        $('#user_cpf').inputmask('999.999.999-99');

        // Máscara de CPF para o campo user_responsavel_cpf
        $('#user_responsavel_cpf').inputmask('999.999.999-99');

        // Máscara para o campo user_cell
        $('#user_cell').inputmask('(99)[9]9999-9999');
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>