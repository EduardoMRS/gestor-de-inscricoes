<?php
session_start();
include_once("../../assets/conf/config.php");
include("../../assets/conf/config_site.php");
include("../../assets/conf/config_evento.php");


//Verifica se o Usuario esta logado, se não estiver retorna para a pagina de login.
if (empty($_SESSION['logado']) || !$_SESSION['user_permissao'][1]) {
    header('location: ../../');
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Inscritos para o acampamento</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?php echo $siteConfig['favicon']; ?>" type="image/x-icon">

    <!-- Estilo Bootstrap-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">

    <!-- Estilos -->
    <link rel="stylesheet" href="../../assets/css/elements.css">
    <link rel="stylesheet" href="../../assets/fonts/fa/css/all.css">
    <link rel="stylesheet" href="../../assets/css/style.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.8/jquery.inputmask.min.js"></script>
    <style>
        .btn_title {
            cursor: pointer;
            color: #ffc107;
            text-shadow: 0 0 6px BLACK;
            text-decoration: none;
        }

        #btn_search {
            background: #ffc107;
            padding: 4px;
            border-radius: 6px;
            color: black;
            font-size: 30px;
            text-shadow: 0px 2px 7px black;
        }

        .search_remove {
            color: #f70d23 !important;
            background-color: #a0a0a0 !important;
            transition: 0, 5s;
        }

        table tbody tr:last-child td {
            border-bottom: none;
        }

        @media(min-width: 767px) {
            .body_adaptive_70 {
                width: 70vw;
            }
        }
    </style>
</head>

<body style="padding: 3rem 0;
    background-image: url(<?php echo $siteConfig["fundo_wind"] ?>);
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-size: cover;
    background-position: center;">

    <!-- Corpo da pagina -->
    <div class="my-5">
        <div class="container alert alert-dark text-center body_adaptive_70" role="alert" <?php echo (!empty($_SESSION['msg']) or isset($_SESSION['msg'])) ? "" : 'style="display: none;"' ?>>
            <?php echo (!empty($_SESSION['msg']) or isset($_SESSION['msg'])) ? $_SESSION['msg'] : "";
            unset($_SESSION['msg']);
            ?>
        </div>
        <div class="container body_adaptive_70" style="border-radius: 20px; background-color: rgb(99 97 97); padding-bottom: 1rem;">
            <div class="container pt-2">
                <div class="row align-bottom">
                    <h2 class="tittle" id="pageTittle" style="font-size: 30px;font-weight: 900;">Relação de Inscrito <a href="../print/users/" target="_blank" class="btn_title"><i title="Clique para gerar a folha de impressão do relatorio." class="fa-solid fa-print"></i></a></h2>
                </div>
                <div class="d-flex flex-nowrap justify-content-center align-items-center pb-3 gap-2">
                    <div class="col-sm-2">
                        <input class="form-control text-center" type="number" inputmode="numeric" name="input_search" id="input_search" placeholder="30000" title="Digite o Numero da Inscrição">
                    </div>
                    <div class="col-auto">
                        <i id="btn_search" class="fa-solid fa-magnifying-glass" onclick="search()"></i>
                    </div>
                </div>
            </div>
            <!-- Tabela -->
            <div id="box_table">
                <!-- Tabela responsiva -->
                <div class="table-responsive" style="background-color: #393939; border-radius: 20px;">
                    <!-- Tabela com texto branco -->
                    <table class="table text-white table-bg">
                        <thead>
                            <tr>
                                <!-- Colunas sem borda no topo -->
                                <th scope="col" class="text-center" style="border-top: none;">Inscrição</th>
                                <th scope="col" style="border-top: none;">Nome Completo</th>
                                <th scope="col" class="text-center" style="border-top: none;">Celular</th>
                                <th scope="col" class="text-center" style="border-top: none;">CPF</th>
                                <th scope="col" class="text-center" style="border-top: none;">Idade</th>
                                <th scope="col" class="text-center" style="border-top: none;">Status do Pagamento</th>
                                <th scope="col" class="text-center" style="border-top: none;">...</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $resultList = $dbConect->query("SELECT * FROM `" . $db_conect_date['name'] . "`.`usuario` order by `nome`");
                            //Enquanto $table_data receber os dados de $resultList sera adicionado os dados em linha
                            while ($user_data = mysqli_fetch_assoc($resultList)) {
                                $btn_edit = '<a style="cursor:pointer; color: #ffc107; text-shadow: 0 0 6px BLACK;" id="view_edit_user" on data-value="' . ($user_data["idUser"]) . '" data-toggle="modal" data-target="#modal_edit_user" ><i title="Clique para editar o usuario." class="fa-solid fa-eye"></i></a>';
                                if ($user_data['status_pagamento'] == 0) {
                                    $status = '<td style="text-align: center; vertical-align: middle">Aguardando Pagamento <i class="fa-solid fa-money-bill" style="color: #e35454;"></i></i></td>';
                                } else {
                                    if ($user_data['status_pagamento'] == 1) {
                                        $status = '<td style="text-align: center; vertical-align: middle">Em Analise <i class="fa-solid fa-clock" style="color: #fff700;"></i></td>';
                                    } else {
                                        if ($user_data['status_pagamento'] == 2) {
                                            $status = '<td style="text-align: center; vertical-align: middle">Pago <i class="fa-solid fa-circle-check" style="color: #12ff12;"></i></td>';
                                        }
                                    }
                                }
                                echo "<tr style='text-align: center; vertical-align: middle'>";
                                echo "<td style='text-align: center; vertical-align: middle'>" . $user_data['idUser'] . "</td>";
                                echo "<td style='text-align: left; vertical-align: middle'><div class='row'><div class='col-auto'>" . ucwords(strtolower($user_data['nome'])) . " " . ucwords(strtolower($user_data['sobrenome'])) . "</div><div class='col-auto'>$btn_edit</div></div></td>";
                                echo "<td style='text-align: center; vertical-align: middle'>" . $user_data['cell'] . "</td>";
                                echo "<td style='text-align: center; vertical-align: middle'>" . $user_data['cpf'] . "</td>";
                                echo "<td style='text-align: center; vertical-align: middle'>" . $user_data['idade'] . "</td>";
                                echo $status;
                                echo "<td style='text-align: center; vertical-align: middle'><a target='_blank' id='linkFile' class='fa-solid fa-print' href='../print/user/?cod=" . $user_data['idUser'] . "' title='Clique para imprimir a folha de inscrição.'></a></td>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="row mt-3 px-3">
                    <?php
                    $incricao = (mysqli_num_rows($dbConect->query("SELECT * FROM `" . $db_conect_date['name'] . "`.`" . $db_conect_date['table'] . "`")));
                    $taxa_aguardando = (mysqli_num_rows($dbConect->query("SELECT * FROM `" . $db_conect_date['name'] . "`.`" . $db_conect_date['table'] . "` WHERE status_pagamento='0'")));
                    $taxa_paga = (mysqli_num_rows($dbConect->query("SELECT * FROM `" . $db_conect_date['name'] . "`.`" . $db_conect_date['table'] . "` WHERE status_pagamento='2'")));
                    ?>
                    <div class="row">
                        <h5>Inscrições: <?php echo $incricao ?></h5>
                    </div>
                    <div class="row">
                        <h5>Pagamentos em Espera: <?php echo $taxa_aguardando ?></h5>
                    </div>
                    <div class="row">
                        <h5>Pagamentos Aprovados: <?php echo $taxa_paga ?></h5>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Edit User-->
        <div class="modal fade" id="modal_edit_user" tabindex="-1" role="dialog" aria-labelledby="modal_edit_user_Label" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen-lg-down" role="document" style="--bs-modal-width: 850px;">
                <div class="modal-content" style="background-color: #212529;">
                    <div class="modal-header justify-content-center align-items-center">
                        <h5 class="modal-title" id="modal_edit_user_Label"></h5>
                        <button type="button" class="btn-close d-flex align-items-center justify-content-center" data-dismiss="modal" aria-label="Fechar" style="color:white; --bs-btn-close-bg:none;"><i class="fa-solid fa-xmark fa-2xl" style="color: #f0f2f4;"></i></button>
                    </div>
                    <div class="modal-body">
                        <div class="d-flex-column align-items-center justify-content-center" id="box_modal_edit" name="box_modal_edit">
                            <!-- Sera preenchido com o formulario do usuario. -->
                        </div>
                        <script>
                            // Seleciona todos os botões com o id "view_edit_user"
                            const buttons = document.querySelectorAll('#view_edit_user');

                            // Adiciona o evento de clique a cada botão
                            buttons.forEach(button => {
                                button.addEventListener('click', () => {
                                    const value = button.getAttribute('data-value');

                                    fetch('../../assets/componet/inscricao.php?cod=' + encodeURIComponent(value))
                                        .then(response => response.text())
                                        .then(data => {
                                            const boxModalEdit = document.getElementById('box_modal_edit');
                                            boxModalEdit.innerHTML = data;
                                            document.querySelector("#modal_edit_user_Label").innerHTML = "Formulario de Inscrição " + value;
                                            console.log("Inscrição selecionada: " + value);
                                            // Adiciona mascara no CPF
                                            $(document).ready(function() {
                                                // Máscara de CPF para o campo user_cpf
                                                $('#user_cpf').inputmask('999.999.999-99');

                                                // Máscara de CPF para o campo user_responsavel_cpf
                                                $('#user_responsavel_cpf').inputmask('999.999.999-99');

                                                // Máscara de CPF para o campo user_cell
                                                $('#user_cell').inputmask('(99)[9]9999-9999');
                                            });
                                        })
                                        .catch(error => {
                                            console.log('Erro ao carregar o arquivo:', error);
                                        });
                                });
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
        <!-- Adiciona Navbar presente no arquivo menu.php -->
        <?php
        $tabPage = "user_list";
        include("../../assets/componet/menu/menu.php");
        ?>
        <script>
            $(document).ready(function() {
                // Máscara para o campo user_cell
                $('#contato_ajuda_input').inputmask('(99)[9]9999-9999');
            });

            var search_status = 0;
            window.onbeforeprint = function() {
                var janelaImpressao = window.open("../print/users", "_blank");
                janelaImpressao.onload = function() {
                    janelaImpressao.print();
                }
            };

            function search() {
                if (search_status == 0 && document.getElementById("input_search").value != "") {
                    fetch('../../assets/componet/table/users.php?search=' + encodeURIComponent(document.getElementById("input_search").value))
                        .then(response => response.text())
                        .then(data => {
                            const boxModalEdit = document.getElementById('box_table');
                            boxModalEdit.innerHTML = data;
                            search_status = 1;
                            document.getElementById("btn_search").classList = "fa-solid fa-magnifying-glass-minus search_remove";
                            document.getElementById("input_search").readOnly = true;
                            document.getElementById("input_search").style.backgroundColor = "#a0a0a0";
                        })
                        .catch(error => {
                            console.log('Erro ao carregar o arquivo:', error);
                        });
                } else {
                    if (document.getElementById("input_search").value != "") {
                        location.reload();
                    }
                }
            }
        </script>
        <!-- Scripts bootstrap -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

</body>

</html>