<?php
session_start();
include("../assets/conf/config.php");
include("../assets/conf/config_site.php");
include("../assets/conf/config_evento.php");

if (empty($_SESSION['logado'])) {
    header("location: ../");
} else {
    $scriptSELECT = "SELECT * FROM `" . $db_conect_date['name'] . "`.`" . $db_conect_date['table'] . "` WHERE idUser='" . $_SESSION['idUser'] . "';";
    // echo $scriptSELECT;
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
    } else {
        header("location: ../");
    }
}


?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meus Dados</title>
    <link rel="shortcut icon" href="<?php echo $siteConfig['favicon']; ?>" type="image/x-icon">


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/fonts/fa/css/all.css">


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.6/jquery.inputmask.min.js"></script>

    <style>
        @media(min-width: 767px) {
            .body_adaptive_70 {
                width: 70vw;
            }
        }
    </style>
</head>

<body class="d-flex align-items-center justify-content-center" style="background-image: url(<?php echo $siteConfig["fundo_wind"] ?>);
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-size: cover;
    background-position: center;">
    <div style="margin: 6rem 0 6rem 0;">
        <div class="container alert alert-danger text-center body_adaptive_70" role="alert" <?php echo (isset($_SESSION['status_pagamento']) && $_SESSION['status_pagamento'] < 2) ? "" : 'style="display: none; width: 70vw;"' ?>>
            <?php
            if ($_SESSION['status_pagamento'] == 0) {
                echo "<strong>A sua taxa ainda não foi paga?!</strong>";
            } else {
                if ($_SESSION['status_pagamento'] == 1) {
                    echo "Parece Que o Seu Pagamento Ainda Não foi Confirmado! <a style='color: black' target='_blank' href='https://wa.me//" . $evento['contato_ajuda'] . "?text=Olá me chamo *" . ucwords(strtolower(explode(" ", $_SESSION['user_nome'])[0])) . "*,%0AEstou precisando de ajuda com a minha inscrição para o acampamento%0A%0AMinha inscrição: *" . $_SESSION['idUser'] . "*'><strong>Fale conosco.</strong></a>";
                }
            }
            ?>
        </div>
        <div class="container d-flex-column align-items-center justify-content-center body_adaptive_70" style="background-color: rgb(123, 123, 123); border-radius: 20px;">
            <div class="w-100 d-flex align-items-center justify-content-center pt-3">
                <div class="text-center d-flex align-items-center justify-content-center" style="width: 80px; height: 80px; font-size: 46px; background: white; border-radius: 100%;">
                    <i class="fa-solid fa-user"></i>
                </div>
            </div>
            <form action="../inscricao/confirmacao/index.php" method="post" class="row mt-3 py-4 px-4 gap-2 d-flex align-items-center justify-content-center" style="background-color: #454343; border-radius: 20px;">
                <div class="d-flex row justify-content-between">
                    <h4 class="text-uppercase" style="font-weight: bold;">Meus Dados</h4>
                    <div class="col-sm">
                        <label for="user_nome" class="form-label">Nome</label>
                        <input class="form-control" type="text" name="user_nome" id="user_nome" readonly value="<?php echo $userData['nome'] ?>">
                    </div>
                    <div class="col-sm">
                        <label for="user_sobrenome" class="form-label">Sobrenome</label>
                        <input class="form-control" type="text" name="user_sobrenome" id="user_sobrenome" readonly value="<?php echo $userData['sobrenome'] ?>">
                    </div>
                    <div class="col-sm-4">
                        <label for="user_idade" class="form-label">Idade</label>
                        <input class="form-control" type="number" pattern="\d*" name="user_idade" id="user_idade" min="8" max="100" readonly value="<?php echo $userData['idade'] ?>">
                    </div>
                    <div class="row py-2">
                        <div class="col-sm-4">
                            <label for="user_cpf" class="form-label">CPF</label>
                            <input class="form-control" type="text" name="user_cpf" id="user_cpf" readonly value="<?php echo $userData['cpf'] ?>">
                        </div>
                        <div class="col-sm-auto">
                            <label for="user_membro" class="form-label">É membro ou frequenta alguma igreja?</label>
                            <select name="user_membro" id="user_membro" class="form-control" disabled>
                                <option value="0" <?php echo ($userData['membro'] == 0) ? 'selected' : '' ?>>Não</option>
                                <option value="1" <?php echo ($userData['membro'] == 1) ? 'selected' : '' ?>>Sou membro</option>
                                <option value="2" <?php echo ($userData['membro'] == 2) ? 'selected' : '' ?>>Sou de outra</option>
                            </select>
                        </div>
                        <div class="col-auto">
                            <label for="check_status_pagamento" class="form-label">Status do Pagamento</label>
                            <select class="form-select col" name="check_status_pagamento" id="check_status_pagamento" disabled>
                                <option value="0" <?php echo ($userData['status_pagamento'] == 0) ? 'selected' : '' ?>>Aguardando Pagamento</option>
                                <option value="1" <?php echo ($userData['status_pagamento'] == 1) ? 'selected' : '' ?>>Aguardando Aprovação</option>
                                <option value="2" <?php echo ($userData['status_pagamento'] == 2) ? 'selected' : '' ?>>Pagamento Aprovado</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-between" id="responsavel" style="display: none;">
                    <hr class="my-2">
                    <h4 class="text-uppercase" style="font-weight: bold;">Dados do Meu Responsavel</h4>
                    <div class="col-sm-7">
                        <label for="user_responsavel" class="form-label">Nome do Responsavel</label>
                        <input class="form-control" type="text" name="user_responsavel" id="user_responsavel" required readonly value="<?php echo $userData['responsavel'] ?>">
                    </div>
                    <div class="col-sm-4">
                        <label for="user_responsavel_cpf" class="form-label">CPF do Responsavel</label>
                        <input class="form-control" type="text" name="user_responsavel_cpf" id="user_responsavel_cpf" required readonly value="<?php echo $userData['responsavel_cpf'] ?>">
                    </div>
                    <hr class="mt-4">
                </div>
                <div class="row justify-content-center">
                    <h4 class="text-uppercase" style="font-weight: bold;">Informações para Contato</h4>
                    <div class="row">
                        <div class="col-sm-auto">
                            <label for="user_estado" class="form-label">Estado:</label>
                            <select name="user_estado" id="user_estado" class="form-control" disabled>
                                <option value=""><?php echo $userData['estado'] ?></option>
                            </select>
                        </div>
                        <div class="col-sm-auto">
                            <label for="user_cidade" class="form-label">Cidade:</label>
                            <select name="user_cidade" id="user_cidade" class="form-control" disabled>
                                <option value=""><?php echo $userData['cidade'] ?></option>
                            </select>
                        </div>
                        <div class="col-sm">
                            <label for="user_cell" class="form-label">Endereço</label>
                            <input class="form-control" type="text" name="user_endereco_rua" id="user_endereco_rua" readonly value="<?php echo $userData['endereco'] ?>">
                        </div>
                    </div>
                    <div class="row justify-content-between mt-3">
                        <div class="col-sm-4">
                            <label for="user_cell" class="form-label">Celular / WhatsApp</label>
                            <input class="form-control" type="text" name="user_cell" id="user_cell" readonly value="<?php echo $userData['cell'] ?>">
                        </div>
                        <div class="col-sm">
                            <label for="user_mail" class="form-label">E-Mail</label>
                            <input class="form-control" type="email" name="user_mail" id="user_mail" readonly value="<?php echo $userData['email'] ?>">
                        </div>
                    </div>
                </div>
                <hr class="mt-4">
                <div class="row mb-3 justify-content-center">
                    <h4 class="text-uppercase" style="font-weight: bold;">Alergias</h4>
                    <div class="row gap-3 justify-content-between">
                        <div class="col-sm">
                            <div class="row">
                                <label class="form-label" for="check_alergia_alimentos_textarea">Alimentos</label>
                                <textarea class="form-control" rows="3" name="check_alergia_alimentos_textarea" id="check_alergia_alimentos_textarea" readonly><?php echo $userData['alergia_alimento'] ?></textarea>
                            </div>
                        </div>
                        <div class="col-sm">
                            <div class="row">
                                <label class="form-label" for="check_alergia_medicamento_textarea">Medicamentos</label>
                                <textarea class="form-control" rows="3" name="check_alergia_medicamento_textarea" id="check_alergia_medicamento_textarea" readonly><?php echo $userData['alergia_medicamento'] ?></textarea>
                            </div>
                        </div>
                        <div class="col-sm">
                            <div class="row">
                                <label class="form-label" for="check_alergia_insetos_textarea">Insetos</label>
                                <textarea class="form-control" rows="3" name="check_alergia_insetos_textarea" id="check_alergia_insetos_textarea" readonly><?php echo $userData['alergia_inseto'] ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="row justify-content-center text-center pb-4 gap-2">
                    <div class="container">
                        <div class="form-check d-flex align-items-center justify-content-center gap-2">
                            <input class="form-check-input" type="checkbox" id="check_terms" disabled required>
                            <label class="form-check-label" for="check_terms" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal_terms">
                                Aceito os termos!
                            </label>
                        </div>
                    </div>
                    <div class="pb-2" style="width: 50vw;">
                        <button type="submit" class="btn btn-success w-100" style="height: 4rem;" id="btn_concluir" disabled>
                            Finalizar Inscrição
                        </button>
                    </div>
                </div> -->
            </form>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modal_terms" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal_termsLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modal_termsLabel">Requisitos Obrigatorios e Termos.</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <strong>O'Que Levar?</strong>
                    barraca, colchonete e cobertor, itens de higiene pessoal, roupas leves e decentes que
                    pode sujar. Bíblia.
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-outline-success" data-bs-dismiss="modal" id="btn_concordo">Concordo!</button>
                </div>
            </div>
        </div>
    </div>

    <?php
    $tabPage = "home";
    include("../assets/componet/menu/menu.php");
    ?>
    <script>
        // Validação de idade
        const user_nascimento = document.getElementById("user_idade");
        user_nascimento.addEventListener("change", () => {
            if (user_nascimento.value >= 18) {
                document.getElementById("responsavel").style = "display: none";
                document.getElementById("user_responsavel").setAttribute("disabled", "disabled");
                document.getElementById("user_responsavel_cpf").setAttribute("disabled", "disabled");
            } else {
                document.getElementById("responsavel").style = "display: flex";
                document.getElementById("user_responsavel").removeAttribute("disabled");
                document.getElementById("user_responsavel_cpf").removeAttribute("disabled");
            }
        });

        // Adiciona mascara no CPF
        $(document).ready(function() {
            // Máscara de CPF para o campo user_cpf
            $('#user_cpf').inputmask('999.999.999-99');

            // Máscara de CPF para o campo user_responsavel_cpf
            $('#user_responsavel_cpf').inputmask('999.999.999-99');

            // Máscara de CPF para o campo user_cpf
            $('#user_cell').inputmask('(99)99999-9999');
        });
    </script>

    <!-- Scripts bootstrap -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>

</html>