<?php
session_start();
include("../assets/conf/config.php");
include("../assets/conf/config_site.php");
include("../assets/conf/config_evento.php");

if (empty($_SESSION['logado']) || !$_SESSION['user_permissao'][3]) {
    header('location: ../');
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administração - <?php echo $evento['nome']?></title>
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

        .form_box {
            background-color: rgb(123, 123, 123);
            border-radius: 20px;
            padding: 1rem 3rem;
            margin: 1rem;
        }

        .form-label {
            margin-top: 10px;
        }

        .img_preview {
            margin-top: 10px;
            height: 100px;
            border-radius: 6px;
        }

        .edit_btn_conf {
            font-size: 23px;
            background-color: #fa7922;
            padding: 8px;
            margin-left: 2px;
            border-radius: 5px;
            cursor: pointer;
        }

        hr {
            margin-top: 1rem !important;
            margin-bottom: auto !important;
        }
    </style>
</head>

<body class="d-flex justify-content-center" style="background-image: url(<?php echo $siteConfig["fundo_wind"] ?>);
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-size: cover;
    background-position: center;
    padding: 4rem 14px;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-4 form_box">
                <form id="form_config" action="../assets/conf/update.php" method="post">
                    <?php include("../assets/conf/page/config_site.php"); ?>
                </form>
            </div>

            <div class="col-sm-7 form_box">
                <form id="form_config" action="../assets/conf/update.php" method="post">
                    <?php include("../assets/conf/page/config_evento.php"); ?>
                </form>
            </div>
        </div>
    </div>

    <?php
    $tabPage = "admin";
    include("../assets/componet/menu/menu.php");
    ?>


    <script>
        const favico = document.getElementById("favicon_input");
        const img_wide = document.getElementById("fundo_wind_input");
        const img_mobile = document.getElementById("fundo_mobile_input");
        const logo = document.getElementById("logo_input");

        document.getElementById("btn_edit_favico").addEventListener("click", function() {
            if (document.getElementById("preview_favico").src !== favico.value) {
                document.getElementById("preview_favico").src = favico.value;
                document.getElementById('edit_site').removeAttribute("disabled");
            }
        });

        document.getElementById("btn_edit_img_wide").addEventListener("click", function() {
            if (document.getElementById("preview_img_wide").src !== img_wide.value) {
                document.getElementById("preview_img_wide").src = img_wide.value;
                document.getElementById('edit_site').removeAttribute("disabled");
            }
        });

        document.getElementById("btn_edit_img_mobile").addEventListener("click", function() {
            if (document.getElementById("preview_img_mobile").src !== img_mobile.value) {
                document.getElementById("preview_img_mobile").src = img_mobile.value;
                document.getElementById('edit_site').removeAttribute("disabled");
            }
        });

        document.getElementById("btn_edit_logo").addEventListener("click", function() {
            if (document.getElementById("preview_logo").src !== logo.value) {
                document.getElementById("preview_logo").src = logo.value;
                document.getElementById('edit_evento').removeAttribute("disabled");
            }
        });
        function img_input_chage_site() {
            if (favico.value !== document.getElementById("preview_favico").src || img_wide.value !== document.getElementById("preview_img_wide").src || img_mobile.value !== document.getElementById("preview_img_mobile").src) {
                document.getElementById('edit_site').setAttribute("disabled", true);
            } else {
                document.getElementById('edit_site').removeAttribute("disabled");
            }
        };

        function img_input_chage_evento() {
            if (logo.value !== document.getElementById("preview_logo").src) {
                document.getElementById('edit_evento').setAttribute("disabled", true);
            } else {
                document.getElementById('edit_evento').removeAttribute("disabled");
            }
        };

        $(document).ready(function() {
            // Máscara para o campo user_cell
            $('#contato_ajuda_input').inputmask('55(99)[9]9999-9999');
        });
    </script>
    <!-- Scripts bootstrap -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>

</html>