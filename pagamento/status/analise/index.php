<?php
session_start();
include("../../../assets/conf/config_site.php");
include("../../../assets/conf/config_evento.php");

if (empty($_SESSION['logado']) or isset($_SESSION['logado']) and !$_SESSION['logado']) {
    header('location: ../');
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagamento</title>
    <link rel="shortcut icon" href="<?php echo $siteConfig['favicon'];?>" type="image/x-icon">


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../../../assets/fonts/fa/css/all.css">
    <link rel="stylesheet" href="../../../assets/css/form.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.6/jquery.inputmask.min.js"></script>

    <style>
        body {
            -webkit-touch-callout: auto;
        }

        @media(min-width: 767px) {
            .body_adaptive_70 {
                width: 70vw;
            }
        }
    </style>
</head>

<body class="d-flex align-items-center justify-content-center" style="padding: 6rem 0; width: 100vw; height: 100vh;
    background-image: url(<?php echo $siteConfig["fundo_wind"]?>);
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-size: cover;
    background-position: center;">
    <div class="container">
        <div class="container d-flex-column align-items-center justify-content-center p-4 body_adaptive_70" style="border-radius: 20px;
            background-color: rgb(119 119 119 / 88%);
            box-shadow: 0px 8px 16px 8px black, inset 0px 2px 13px 17px #ffffff30;
            border-radius: 20px;
            backdrop-filter: blur(5px);">
            <h4 class="text-center text-uppercase" style="font-weight: bold;">Parece Que o Seu Pagamento Ainda Não foi Confirmado!</h4>
            <div class="container" style="width: 83%; text-align: justify;">
                <h4>Algumas formas de pagamento podem levar até 2 dias uteis para serem creditados, sendo assim pedimos que aguarde um pouco, se até este periodo nada tiver mudado entre em contato com um dos responsaveis pelo evento e envie o comprovante do pagamento.<br>Você pode fazer isso clicando no botão com o icone do WhatsApp</h4>
            </div>
            <hr>
            <div class="container" style="width: 90%;">
                <h5 class="text-center">Desde já, lhe desejamos um otimo acampamento!</h5>
            </div>
        </div>
    </div>


    <?php
    $tabPage = "status_pagamento";
    include("../../../assets/componet/menu/menu.php");
    ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>

</html>