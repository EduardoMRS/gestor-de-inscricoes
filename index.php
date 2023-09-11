<?php
session_start();
include("./assets/conf/config.php");
include("./assets/conf/config_site.php");
include("./assets/conf/config_evento.php");

// Remove os elementos vazios do array
$filtered_array = array_filter($db_conect_date);
if (count($filtered_array) < 4) {
    header("location: ./setup");
}

if (!empty($_SESSION['logado']) or isset($_SESSION['logado']) and $_SESSION['logado']) {
    header('location: ./user/');
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $evento['nome'] ?> - Faça Sua incrição</title>
    <meta name="description" content="<?php echo str_replace("<strong>", "", str_replace("</strong>", "", $evento['descricao'])); ?>">
    <link rel="shortcut icon" href="<?php echo $siteConfig['favicon']; ?>" type="image/x-icon">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./assets/fonts/fa/css/all.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.8/jquery.inputmask.min.js"></script>

    <style>
        @media(min-width: 767px) {
            .body_adaptive_60 {
                width: 60vw;
            }
        }
    </style>
</head>

<body class="d-flex justify-content-center align-items-center" style="width: 100vw; height: 100vh; padding: 4rem 0 4rem 0;
    background-image: url(<?php echo $siteConfig["fundo_login"] ?>);
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-size: cover;
    background-position: center;">
    <div class="d-flex-column">
        <div class="container alert alert-danger text-center body_adaptive_60" role="alert" <?php echo (!empty($_SESSION['msg_login']) or isset($_SESSION['msg_login'])) ? "" : 'style="display: none;"' ?>>
            <?php echo (!empty($_SESSION['msg_login']) or isset($_SESSION['msg_login'])) ? $_SESSION['msg_login'] : "";
            unset($_SESSION['msg_login']);
            ?>
        </div>
        <div class="d-flex align-items-center justify-content-center body_adaptive_60" style="padding: 4rem;
        background-color: rgb(119 119 119 / 88%);
        box-shadow: 0px 8px 16px 8px black, inset 0px 2px 13px 17px #ffffff30;
        border-radius: 20px;
        backdrop-filter: blur(5px);">
            <div class="row gap-4">
                <div class="col-sm d-flex-column justify-content-center align-items-center">
                    <h5 class="text-uppercase" style="font-weight: bold;">Já Se Inscreveu?</h5>
                    <form class="row d-flex justify-content-center align-items-center" action="./assets/componet/validaLogin.php" method="post">
                        <div class="row mb-3">
                            <label for="usuario">E-Mail</label>
                            <input type="text" class="form-control" id="usuario" name="usuario">
                        </div>
                        <div class="row mb-3">
                            <label for="user_cpf">CPF</label>
                            <input type="text" inputmode="numeric" class="form-control" id="user_cpf" name="user_cpf" placeholder="123.456.789-10">
                        </div>
                        <div class="row">
                            <button type="submit" class="btn btn-primary btn-block" id="submitLogin" name="submitLogin">
                                Entrar
                            </button>
                        </div>
                    </form>
                </div>
                <div class="col-sm justify-content-center align-items-center">
                    <div class="container">
                        <div class="row">
                            <h4 class="text-uppercase" style="font-weight: bold;" id="tittle_inscricao">Faça sua inscrição!</h4>
                            <p><?php echo $evento['descricao'] ?></p>
                            <?php echo (intval($evento['custo']) != 0) ? "<h6><strong>Taxa: R$" . $evento['custo'] . "</strong></h6>" : "" ?>
                        </div>
                        <div class="row">
                            <?php date_default_timezone_set('America/Porto_Velho');
                            $dia = date("d");
                            $mes = date("m");
                            $ano = date("Y");
                            $hora = date("H");
                            // $minuto = date("i");
                            if ($dia <= $evento_fim['dia'] && $mes <= $evento_fim['mes'] && $ano <= $evento_fim['ano'] && $hora <= $evento_fim['hora']) {
                                echo '<button class="btn btn-primary btn-block" id="btn_inscricao" name="btn_inscricao">
                                Quero Me Increver
                            </button>';
                            } else {
                                echo '<script>
                                        document.getElementById("tittle_inscricao").innerHTML = "Inscrições Finalizadas!!!";
                                    </script>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        const btn_inscricao = document.getElementById("btn_inscricao");
        btn_inscricao.addEventListener("click", () => {
            window.location.href = "./inscricao";
        })
        // Adiciona mascara no CPF
        $(document).ready(function() {
            // Máscara de CPF para o campo user_cpf
            $('#user_cpf').inputmask('999.999.999-99');

            // Máscara de CPF para o campo user_responsavel_cpf
            $('#user_responsavel_cpf').inputmask('999.999.999-99');
        });

        // console.log("<?php //echo $_SERVER['REMOTE_ADDR']
                        ?>");
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
</body>

</html>