<?php
session_start();
include("../../assets/conf/config_site.php");
include("../../assets/conf/config_evento.php");

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
    <link rel="stylesheet" href="../../assets/fonts/fa/css/all.css">
    <link rel="stylesheet" href="../../assets/css/form.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.6/jquery.inputmask.min.js"></script>

    <style>
        @media(min-width: 767px) {
            .body_adaptive_40 {
                width: 40vw;
            }
        }
    </style>
</head>

<body class="d-flex align-items-center justify-content-center" style="width: 100vw; height: 100vh;
    background-image: url(<?php echo $siteConfig["fundo_wind"]?>);
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-size: cover;
    background-position: center;">
    <div class="container">
        <div class="container d-flex-column align-items-center justify-content-center p-4 body_adaptive_40" style="border-radius: 20px;
            background-color: rgb(119 119 119 / 88%);
            box-shadow: 0px 8px 16px 8px black, inset 0px 2px 13px 17px #ffffff30;
            border-radius: 20px;
            backdrop-filter: blur(5px);">
            <div class="container mt-3">
                <div class="d-flex justify-content-center align-items-center">
                    <h5 class="text-center my-3" style="word-wrap: break-word;width: 200px;">Valor: <strog>R$<?php echo $evento['custo']?></strong></h5>
                </div>
                <?php
                $num_pix = $evento['chave_pix'];
                $cod_pix = $evento['codigo_qr_pix'];
                require  "../../assets/componet/phpqrcode/qrlib.php";
                QRcode::png($cod_pix, './qr_code_pix.png');
                ?>
                <div class="d-felx align-items-center justify-content-center p-4">
                    <img class="rounded mx-auto d-block" style="height: 200px; width: 200px;" src="./qr_code.png" onclick="copy_chavepix()">
                </div>
                <div class="text-center my-3">
                    <h5 style="word-wrap: break-word; font-size: 30px; font-weight: bold; text-shadow: 3px 3px 4px black;" onclick="copy_chavepix()"><?php echo $num_pix?> <i class="fa-regular fa-clipboard"></i></h5>
                    <span style="position: relative;top: -10px; color: #ffc107; text-shadow: 1px 1px 1px black; font-weight: 500;">Clique no numero para copiar a chave</span>
                </div>
            </div>
            <hr>
            <div class="container" style="width: 90%;">
                <h5 class="text-center">Desde já, lhe desejamos um otimo acampamento!&#128513;</h5>
            </div>

            <div class="d-flex justify-content-center align-items-center mt-3">
                <!-- <button class="btn btn-success text-uppercase" onclick="window.close()">Clique para concluir</button> -->
            </div>
        </div>
    </div>

    <?php
    $tabPage = "status_pagamento";
    include("../../assets/componet/menu/menu.php");
    ?>
    <script>
         function copy_chavepix (){
            const el = document.createElement('textarea');
            el.value = "<?php echo $evento['chave_pix']?>";
            el.setAttribute('readonly', '');
            el.style.position = 'absolute';
            el.style.left = '-9999px';
            document.body.appendChild(el);
            el.select();
            if (document.execCommand('copy')) {
                // console.log("Tudo certo");
            } else {
                // console.log("Ocorreu um erro");
            }
            document.body.removeChild(el);
            alert("Eeeba!!!\nChave PIX Copiada com Sucesso!\nAgora basta concluir o pagamento. 😊");
        };
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>

</html>