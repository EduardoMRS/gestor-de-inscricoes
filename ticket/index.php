<?php
session_start();
include("../assets/conf/config.php");
include("../assets/conf/config_site.php");
include("../assets/conf/config_evento.php");

$user_data = mysqli_fetch_assoc($dbConect->query("SELECT * FROM `" . $db_conect_date['name'] . "`.`" . $db_conect_date['table'] . "` WHERE idUser='" . $_SESSION['idUser'] . "'"));
if (empty($_SESSION['logado']) || $user_data['status_pagamento'] != 2) {
    header("location: ../");
}
require  "../assets/componet/phpqrcode/qrlib.php";
QRcode::png($_SESSION['idUser'], './qr_code.png');
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu ticket - <?php echo $evento['nome'] ?></title>
    <link rel="shortcut icon" href="<?php echo $siteConfig['favicon']; ?>" type="image/x-icon">


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/fonts/fa/css/all.css">


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.6/jquery.inputmask.min.js"></script>

    <style>
        @media(min-width: 767px) {
            .body_adaptive_50 {
                width: 50vw;
            }
        }
    </style>
</head>

<body class="d-flex align-items-center justify-content-center" style="height: 100vh;background-image: url(<?php echo $siteConfig["fundo_wind"] ?>);
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-size: cover;
    background-position: center;">
    <div class="row gap-2 justify-content-center body_adaptive_50" style="margin: 6rem 14px;background-color: rgb(123, 123, 123); padding: 2rem 0; border-radius: 20px;">
        <div class="col-sm align-items-center justify-content-center p-4">
            <img class="rounded mx-auto d-block" style="height: 200px; width: 200px;" src="./qr_code.png">
        </div>
        <div class="col-sm d-flex flex-column justify-content-center">
            <h3>Dados do Ticket</h3>
            <h6>Nome: <?php echo ucwords(strtolower($user_data['nome'])) . " " . ucwords(strtolower($user_data['sobrenome'])) ?></h6>
            <h6>CPF: <?php echo $user_data['cpf'] ?></h6>
            <h6>Idade: <?php echo $user_data['idade'] ?></h6>
            <h6>Telefone: <?php echo $user_data['cell'] ?></h6>
            <?php
            if ($user_data['idade'] < 18) {
                echo "<hr>
                <h5>Dados do Responsavel</h5>
                <h6>Nome: " . $user_data['responsavel'] . "</h6>
                <h6>CPF: " . $user_data['responsavel_cpf'] . "</h6>";
            }
            ?>
        </div>
        <div class="row text-center text-uppercase">
            <h2><?php
                switch ($user_data['status_pagamento']) {
                    case '0':
                        echo "Aguardando Pagamento";
                        break;

                    case '1':
                        echo "Aguardando Aprovação";
                        break;

                    case '2':
                        echo "Pagamento Realizado";
                        break;
                    default:
                        echo "Erro";
                        break;
                }
                ?></h2>
        </div>
    </div>
    <!-- Scripts bootstrap -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>

</html>