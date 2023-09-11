<?php
session_start();
include("../../assets/conf/config.php");
include("../../assets/conf/config_site.php");
include("../../assets/conf/config_evento.php");

if (empty($_SESSION['logado']) || !$_SESSION['user_permissao'][2]) {
    header("location: ../");
}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validador de Ticket - <?php echo $evento['nome']?></title>
    <link rel="shortcut icon" href="<?php echo $siteConfig['favicon']; ?>" type="image/x-icon">


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../../assets/fonts/fa/css/all.css">


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.6/jquery.inputmask.min.js"></script>

    <style>
        @media(min-width: 767px) {
            .body_adaptive_70 {
                width: 70vw;
            }
        }

        #scan-btn {
            background: #1d5eda;
            padding: 14px;
            border-radius: 100%;
            font-size: 20px;
        }
    </style>
</head>

<body class="d-flex align-items-center justify-content-center" style="height: 100vh; background-image: url(<?php echo $siteConfig["fundo_wind"] ?>);
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-size: cover;
    background-position: center;">
    <div class="row gap-2 justify-content-center body_adaptive_70" style="margin: 6rem 2rem;">
        <div class="col-sm-5 p-3 d-flex flex-column justify-content-center align-items-center" style="background-color: rgb(123, 123, 123); border-radius: 20px;">
            <video id="video-preview" style="width: 200px; border-radius: 20px; margin: 6px; display:none;"></video>
            <div class="row justify-content-center align-items-center">
                <i class="fa-solid fa-magnifying-glass col-auto" id="scan-btn"></i>
                <h4 class="col-auto" id="result_qr" style="display: none;"></h4>
            </div>
        </div>
        <div class="col-sm-5 p-3 justify-content-center align-items-center" id="box_dados_ticket" style="background-color: rgb(123, 123, 123); border-radius: 20px; display: none;">
            <!-- fetch -->
        </div>

        <script src="https://unpkg.com/@zxing/library@latest"></script>

        <script>
            // Selecione o elemento de vídeo
            const video = document.getElementById('video-preview');

            // Selecione o botão de scan
            const scanBtn = document.getElementById('scan-btn');

            // Inicialize a variável para o leitor de código QR
            let codeReader = new ZXing.BrowserQRCodeReader();

            // Adicione o evento de clique ao botão de scan
            scanBtn.addEventListener('click', function() {
                document.getElementById('video-preview').style.display = "block";
                document.getElementById('box_dados_ticket').style.display = "none";
                document.getElementById('result_qr').style.display = "none";

                // Inicie a câmera e comece a escanear
                codeReader.decodeFromVideoDevice(undefined, 'video-preview', (result, err) => {
                    if (result) {
                        // Aqui você pode processar o conteúdo do código QR lido
                        codeReader.reset();

                        var options = {
                            method: 'GET',
                            headers: {
                                'Content-Type': 'application/json'
                            }
                        };
                        //Fetch
                        fetch('../../assets/componet/validador_ticket.php?cod=' + encodeURIComponent(result.text), options)
                            .then(response => response.text())
                            .then(data => {
                                if (!data.includes('Ticket Invalido!')) {
                                    document.getElementById('box_dados_ticket').innerHTML = data;
                                    document.getElementById('box_dados_ticket').style.display = "block";
                                    document.getElementById('result_qr').style.display = "block";
                                    console.log("Inscrição: " + result.text);
                                    document.getElementById('result_qr').innerHTML = result.text;
                                    video.style.display = "none";
                                }
                            })
                            .catch(error => {
                                console.log('Erro ao carregar o arquivo:', error);
                            });
                    }
                    if (err && !(err instanceof ZXing.NotFoundException)) {
                        console.error(err);
                    }
                });
            });
        </script>

        <!-- Scripts bootstrap -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    </div>
    <?php
    $tabPage = "validador";
    include("../../assets/componet/menu/menu.php");
    ?>
</body>

</html>