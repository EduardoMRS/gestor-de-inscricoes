<?php
session_start();
include("../assets/conf/config_site.php");
include("../assets/conf/config_evento.php");

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
    <link rel="stylesheet" href="../assets/fonts/fa/css/all.css">
    <link rel="stylesheet" href="../assets/css/form.css">


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.6/jquery.inputmask.min.js"></script>

    <style>
        @media(min-width: 767px){
            .body_adaptive_70{
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
            <h2 class="text-center text-uppercase" style="font-weight: bold;">Sua Inscrição Já foi Concluida!</h2>
            <div class="container" style="width: 83%; text-align: justify;">
                <h4>Falta pouco para garantir sua vaga para o acampamento, neste ultimo passo será necessario apenas a confirmação do pagamento da taxa de incrição clicando no botão abaixo.</h4>
            </div>
            <hr>
            <div class="container" style="width: 84%; font-size: 16px;">
                <h5 class="text-center">Obs. caso feche esta pagina não será perdido seu registro, para continuar basta fazer login na pagina inicial.</h5>
            </div>
            <div class="container d-flex align-items-center justify-content-center mt-3">
                <div class="row">
                    <button class="btn btn-primary btn-block text-uppercase" onclick="mercadoPago()">
                        Clique aqui Para pagar a taxa
                    </button>
                </div>
            </div>
        </div>

        <?php
        $tabPage = "status_pagamento";
        include("../assets/componet/menu/menu.php");
        ?>

        <script>
            window.navigator.href
            var aba_de_pagamento;

            function mercadoPago() {
                aba_de_pagamento = window.open("./pix", "_blank");
                verificarAbaFechada();
            }

            function verificarAbaFechada() {
                if (aba_de_pagamento && aba_de_pagamento.closed) {
                    // Ação a ser executada quando a nova aba é fechada
                    fetch('../assets/componet/update-pagamento.php')
                        .then(response => {
                            if (response.ok) {
                                console.log("A tela de pagamento foi fechada e o PHP foi executado com sucesso");
                                window.location.href = "./status/";
                            } else {
                                console.log("Ocorreu um erro ao executar o PHP");
                            }
                        })
                        .catch(error => {
                            console.log("Ocorreu um erro no fetch:", error);
                        });
                } else {
                    setTimeout(verificarAbaFechada, 1000); // Verificar novamente após 1 segundo
                }
            }
        </script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>

</html>