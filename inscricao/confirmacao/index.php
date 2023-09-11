<?php
include("../../assets/conf/config_site.php");
include("../../assets/conf/config_evento.php");

if(!isset($_POST['btn_concluir']) or empty($_POST["user_cidade"] or empty($_POST["user_estado"]))){
    echo "<script>history.back()</script>";
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $evento['nome']?> - Tudo Certo?</title>
    <link rel="shortcut icon" href="<?php echo $siteConfig['favicon'];?>" type="image/x-icon">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../../assets/fonts/fa/css/all.css">
    <link rel="stylesheet" href="../../assets/css/form.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.6/jquery.inputmask.min.js"></script>

    <style>
        @media(min-width: 767px) {
            .body_adaptive_70 {
                width: 70vw;
            }
        }
    </style>
</head>

<body class="d-flex align-items-center justify-content-center" style="
    background-image: url(<?php echo $siteConfig["fundo_wind"]?>);
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-size: cover;
    background-position: center;">
    <div class="container" style="margin: 6rem 0 6rem 0;">
        <div class="container d-flex-column align-items-center justify-content-center p-4 body_adaptive_70" style="background-color: rgb(123, 123, 123); border-radius: 20px;">
            <h2 class="text-center text-uppercase" style="font-weight: bold;">Falta Pouco Para Finalizar Sua Inscrição!</h2>
            <div class="container" style="width: 83%; text-align: justify;">
                <h5 class="text-center">Antes de ir continuar, precisamos que confira se o dados preenchidos estão corretos.</h5>
            </div>
            <hr>
            <form action="../../assets/componet/cad-user.php" method="post">
                <div class="row justify-content-center align-items-center mt-4">
                    <div class="col-sm text-center">
                        <img class="img-fluid" src="<?php echo $evento['logo']?>" alt="" style="border-radius: 15px; width: 332px;">
                    </div>
                    <div class="col-sm">
                        <div class="row">
                            <input type="hidden" name="user_nome" id="user_nome" value="<?php echo (!empty($_POST["user_nome"])) ? $_POST["user_nome"] : "" ?>">
                            <input type="hidden" name="user_sobrenome" id="user_sobrenome" value="<?php echo (!empty($_POST["user_sobrenome"])) ? $_POST["user_sobrenome"] : "" ?>">
                            <input type="hidden" name="user_membro" id="user_membro" value="<?php echo (!empty($_POST["user_membro"])) ? $_POST["user_membro"] : "" ?>">
                            <div class="col-sm">
                                <label for="user_nome_completo" class="form-label">Nome Completo</label>
                                <input class="form-control" type="text" id="user_nome_completo" value="<?php echo $_POST["user_nome"] . " " . $_POST["user_sobrenome"] ?>" disabled>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm">
                                <label for="user_cpf" class="form-label">CPF</label>
                                <input class="form-control" type="text" name="user_cpf" id="user_cpf" value="<?php echo $_POST["user_cpf"] ?>" readonly>
                            </div>
                            <div class="col-sm" style="max-width: 80px;">
                                <label for="user_idade" class="form-label">Idade</label>
                                <input class="form-control" type="text" name="user_idade" id="user_idade" value="<?php echo $_POST["user_idade"] ?>" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm">
                                <label for="user_cell" class="form-label">Telefone / WhatsApp</label>
                                <input class="form-control" type="text" name="user_cell" id="user_cell" value="<?php $numero = $_POST["user_cell"];
                                                                                                                $numero = (substr($numero, -1) === "_") ? substr_replace($numero, "9", strpos($numero, ")") + 1, 0) : $numero;
                                                                                                                $numero = str_replace(['_', '-'], '', $numero);
                                                                                                                $numero = substr_replace($numero, '-', -4, 0);
                                                                                                                echo $numero;
                                                                                                                ?>" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm">
                                <label for="user_mail" class="form-label">E-Mail</label>
                                <input class="form-control" type="text" name="user_mail" id="user_mail" value="<?php echo $_POST["user_mail"] ?>" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-between mt-3">
                    <div class="col-sm-6">
                        <label for="user_endereco" class="form-label">Endereço</label>
                        <input class="form-control" type="text" name="user_endereco" id="user_endereco" value="<?php echo $_POST["user_endereco_rua"] . " - " . $_POST["user_endereco_numero"] . ", " . $_POST["user_endereco_bairro"] ?>" readonly>
                    </div>
                    <div class="col-sm-auto">
                        <label for="user_cidade" class="form-label">Cidade:</label>
                        <input type="text" name="user_cidade" id="user_cidade" class="form-control" value="<?php echo $_POST["user_cidade"] ?>" readonly>
                    </div>
                    <div class="col-sm">
                        <label for="user_estado" class="form-label">Estado:</label>
                        <input type="text" name="user_estado" id="user_estado" class="form-control" value="<?php echo $_POST["user_estado"] ?>" readonly>
                    </div>
                </div>
                <br>
                <div class="row justify-content-between" id="responsavel" <?php echo ($_POST["user_idade"] >= 18) ? 'style="display: none;"' : ""; ?>>
                    <hr class="my-2">
                    <h5 class="text-uppercase" style="font-weight: bold;">Dados do Meu Responsavel</h5>
                    <div class="col-sm-7">
                        <label for="user_responsavel" class="form-label">Nome do Responsavel</label>
                        <input class="form-control" type="text" name="user_responsavel" id="user_responsavel" <?php echo (!empty($_POST["user_responsavel"])) ? 'value="' . $_POST["user_responsavel"] . '" ' : ""; ?> readonly>
                    </div>
                    <div class="col-sm-4">
                        <label for="user_responsavel_cpf" class="form-label">CPF do Responsavel</label>
                        <input class="form-control" type="text" pattern="\d*" name="user_responsavel_cpf" id="user_responsavel_cpf" <?php echo (!empty($_POST["user_responsavel_cpf"])) ? 'value="' . $_POST["user_responsavel_cpf"] . '" ' : ""; ?>readonly>
                    </div>
                </div>
                <hr>
                <h5 <?php echo (!$_POST["check_alergia_alimentos"] && !$_POST["check_alergia_medicamento"] && !$_POST["check_alergia_insetos"]) ? 'style="display: none;"' : "" ?>>Alergias</h5>
                <div class="row mb-3" <?php echo (!$_POST["check_alergia_alimentos"] && !$_POST["check_alergia_medicamento"] && !$_POST["check_alergia_insetos"]) ? 'style="display: none;"' : "" ?>>
                    <div class="col-sm" <?php echo (!empty($_POST["check_alergia_alimentos_textarea"])) ? "" : 'style="display: none;"' ?>>
                        <label for="alergia_alimentos" class="form-label">Alimentos</label>
                        <input class="form-control" type="text" name="alergia_alimentos" id="alergia_alimentos" value="<?php echo (!empty($_POST["check_alergia_alimentos_textarea"])) ? $_POST["check_alergia_alimentos_textarea"] : "" ?>" readonly>
                    </div>
                    <div class="col-sm" <?php echo (!empty($_POST["check_alergia_medicamento_textarea"])) ? "" : 'style="display: none;"' ?>>
                        <label for="alergia_medicamento" class="form-label">Medicamentos</label>
                        <input class="form-control" type="text" name="alergia_medicamento" id="alergia_medicamento" value="<?php echo (!empty($_POST["check_alergia_medicamento_textarea"])) ? $_POST["check_alergia_medicamento_textarea"] : "" ?>" readonly>
                    </div>
                    <div class="col-sm" <?php echo (!empty($_POST["check_alergia_insetos_textarea"])) ? "" : 'style="display: none;"' ?>>
                        <label for="alergia_insetos" class="form-label">Insetos</label>
                        <input class="form-control" type="text" name="alergia_insetos" id="alergia_insetos" value="<?php echo (!empty($_POST["check_alergia_insetos_textarea"])) ? $_POST["check_alergia_insetos_textarea"] : "" ?>" readonly>
                    </div>
                </div>
                <div class="container d-flex align-items-center justify-content-center">
                    <!-- <div class="row" style="width: 260px;">
                    <script src="https://www.mercadopago.com.br/integrations/v1/web-payment-checkout.js" data-preference-id="260100835-f2319d6d-86ba-4e85-8464-04534728ee51" data-source="button">
                    </script>
                </div> -->
                    <button class="btn btn-primary btn-block text-uppercase" name="user_confirma" id="user_confirma">Clique Para Confirmar</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
</body>

</html>