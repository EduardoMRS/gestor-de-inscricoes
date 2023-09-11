<?php
session_start();
include("../assets/conf/config.php");

// Remove os elementos vazios do array
$filtered_array = array_filter($db_conect_date);

if (count($filtered_array) > 3) {
    header("location: ../");
}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuração inicial - Formula</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">

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

<body class="d-flex flex-column justify-content-center align-items-center" style="padding: 6rem 0 ; height: 100vh; background-color: #252525;">
    <div id="conect_erro_box" class="container alert alert-danger text-center body_adaptive_60" role="alert" style="display: none;">
        <!-- Mensagem de erro na conexão -->
    </div>
    <div class="d-flex align-items-center justify-content-center body_adaptive_60" style="padding: 4rem;
        background-color: rgb(119 119 119 / 88%);
        box-shadow: 0px 8px 16px 8px black, inset 0px 2px 13px 17px #ffffff30;
        border-radius: 20px;
        backdrop-filter: blur(5px);">
        <div class="row gap-4">
            <div class="col-sm d-flex-column justify-content-center align-items-center">
                <h4 class="text-uppercase" style="font-weight: bold;">Primeira Vez Aqui?</h4>
                <h6>Antes de continuar precisamos de algumas informações para configurar nosso sistema</h6>
                <hr>
                <form class="row gap-3 justify-content-center align-items-center">
                    <div class="row">
                        <h5>Dados do Banco de Dados</h5>
                        <h6>Informe os dados de conexão ao seu banco de dados</h6>
                    </div>
                    <div class="row">
                        <div class="col-sm-8">
                            <label for="db_host">Host</label>
                            <input type="text" class="form-control" id="db_host" name="db_host" placeholder="meuhost:3306" require>
                        </div>
                        <div class="col-sm-4">
                            <label for="db_name">Nome</label>
                            <input type="text" class="form-control" id="db_name" name="db_name" placeholder="teste_db" require>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm">
                            <label for="db_user">Usuario</label>
                            <input type="text" class="form-control" id="db_user" name="db_user" placeholder="root" require>
                        </div>
                        <div class="col-sm">
                            <label for="db_pass">Senha</label>
                            <input type="password" class="form-control" id="db_pass" name="db_pass" placeholder="*********" require>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <a class="btn btn-primary btn-block" id="submit_setup" name="submit_setup" style="width: 90%;">
                            Conetar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        erro_box = document.getElementById('conect_erro_box');

        document.getElementById("submit_setup").addEventListener('click', () => {
            fetch('./conect/check.php?db_host=' + encodeURIComponent(document.getElementById('db_host').value) + '&db_name=' + encodeURIComponent(document.getElementById('db_name').value) + '&db_user=' + encodeURIComponent(document.getElementById('db_user').value) + '&db_pass=' + encodeURIComponent(document.getElementById('db_pass').value))
                .then(response => response.text())
                .then(data => {
                    // erro_box.innerHTML = data;
                    if (!data.includes('mysqli_sql_exception')) {
                        window.location.href = "./finish";
                    } else {
                        erro_box.style.display = "block";
                        erro_box.innerHTML = "Não foi possivel realizar a conexão com o seu banco de dados, se o problema perssistir, contate o suporte!";
                    }
                })
                .catch(error => {
                    console.log('Erro ao carregar o arquivo:', error);
                });
        });
    </script>
</body>

</html>