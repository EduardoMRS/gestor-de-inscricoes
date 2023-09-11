<?php
session_start();
include_once("../../../assets/conf/config.php");
include_once("../../../assets/conf/config_site.php");
include("../../../assets/conf/config_evento.php");

//Verifica se o Usuario esta logado, se não estiver retorna para a pagina de login.
if (empty($_SESSION['logado']) || !$_SESSION['user_permissao'][1]) {
    header('location: ../../');
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Relação de Inscritos - <?php echo $evento["nome"] ?></title>

    <!-- Estilo Bootstrap-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">

    <!-- Estilos -->
    <link rel="stylesheet" href="../../../assets/fonts/fa/css/all.css">

    <style>
        tbody td {
            font-size: 10px;
        }

        thead th {
            font-size: 10px;
        }

        @media print {
            @page {
                margin-top: 30px;
                margin-bottom: 30px;
            }

            body {
                padding-top: 10px;
                /* Espaço para o seu cabeçalho personalizado */
                padding-bottom: 10px;
                /* Espaço para o seu rodapé personalizado */
            }
        }
    </style>
</head>

<body onload="window.print()">
    <h4 class="tittle" id="pageTittle" style="font-size: 30px;font-weight: 900;">Relação de Inscrito</h4>
    <!-- Tabela responsiva -->
    <div>
        <!-- Tabela com texto branco -->
        <table class="table text-black table-bg">
            <thead>
                <tr>
                    <!-- Colunas sem borda no topo -->
                    <th scope="col" class="text-center" style="border-top: none;">Inscrição</th>
                    <th scope="col" style="border-top: none;">Nome Completo</th>
                    <th scope="col" class="text-center" style="border-top: none;">Celular</th>
                    <th scope="col" class="text-center" style="border-top: none;">CPF</th>
                    <th scope="col" class="text-center" style="border-top: none;">Idade</th>
                    <th scope="col" class="text-center" style="border-top: none;">Status do Pagamento</th>
                </tr>
            </thead>
            <tbody>
                <?php

                $resultList = $dbConect->query("SELECT * FROM `" . $db_conect_date['name'] . "`.`" . $db_conect_date['table'] . "` order by `nome`");
                //Enquanto $table_data receber os dados de $resultList sera adicionado os dados em linha
                while ($user_data = mysqli_fetch_assoc($resultList)) {
                    if ($user_data['status_pagamento'] == 0) {
                        $status = '<td style="text-align: center; vertical-align: middle;' . (!empty($user_data['alergia_alimento']) || !empty($user_data['alergia_medicamento']) || !empty($user_data['alergia_inseto']) ? "border-bottom: none;" : "") . '">Aguardando Pagamento <i class="fa-solid fa-money-bill" style="color: #e35454;"></i></i></td>';
                    } else {
                        if ($user_data['status_pagamento'] == 1) {
                            $status = '<td style="text-align: center; vertical-align: middle;' . (!empty($user_data['alergia_alimento']) || !empty($user_data['alergia_medicamento']) || !empty($user_data['alergia_inseto']) ? "border-bottom: none;" : "") . '">Em Analise <i class="fa-solid fa-clock" style="color: #fff700;"></i></td>';
                        } else {
                            if ($user_data['status_pagamento'] == 2) {
                                $status = '<td style="text-align: center; vertical-align: middle;' . (!empty($user_data['alergia_alimento']) || !empty($user_data['alergia_medicamento']) || !empty($user_data['alergia_inseto']) ? "border-bottom: none;" : "") . '">Pago <i class="fa-solid fa-circle-check" style="color: #12ff12;"></i></td>';
                            }
                        }
                    }
                    echo "<tr style='text-align: center; vertical-align: middle; border-color: inherit;border-style: solid; border-width: 0;'>";
                    echo "<td style='text-align: center; vertical-align: middle;" . (!empty($user_data['alergia_alimento']) || !empty($user_data['alergia_medicamento']) || !empty($user_data['alergia_inseto']) ? "border-bottom: none;" : "") . "'>" . $user_data['idUser'] . "</td>";
                    echo "<td style='text-align: left; vertical-align: middle;" . (!empty($user_data['alergia_alimento']) || !empty($user_data['alergia_medicamento']) || !empty($user_data['alergia_inseto']) ? "border-bottom: none;" : "") . "'><div class='row'><div class='col-auto'>" . ucwords(strtolower($user_data['nome'])) . " " . ucwords(strtolower($user_data['sobrenome'])) . "</div><div class='col-auto'></div></div></td>";
                    echo "<td style='text-align: center; vertical-align: middle;" . (!empty($user_data['alergia_alimento']) || !empty($user_data['alergia_medicamento']) || !empty($user_data['alergia_inseto']) ? "border-bottom: none;" : "") . "'>" . $user_data['cell'] . "</td>";
                    echo "<td style='text-align: center; vertical-align: middle;" . (!empty($user_data['alergia_alimento']) || !empty($user_data['alergia_medicamento']) || !empty($user_data['alergia_inseto']) ? "border-bottom: none;" : "") . "'>" . $user_data['cpf'] . "</td>";
                    echo "<td style='text-align: center; vertical-align: middle;" . (!empty($user_data['alergia_alimento']) || !empty($user_data['alergia_medicamento']) || !empty($user_data['alergia_inseto']) ? "border-bottom: none;" : "") . "'>" . $user_data['idade'] . "</td>";
                    echo $status;

                    if (!empty($user_data['alergia_alimento']) || !empty($user_data['alergia_medicamento']) || !empty($user_data['alergia_inseto'])) {
                        // Exibir alergias em uma nova linha
                        echo "<tr style='border-bottom: 1px solid gainsboro;'><td></td>";
                        echo ((!empty($user_data['alergia_alimento'])) ? "<td style='text-align: left; padding-left: 30px;'><strong>Alergia Alimentar:</strong> " . $user_data['alergia_alimento'] . "</td>" : "");
                        echo ((!empty($user_data['alergia_medicamento'])) ? "<td style='text-align: left; padding-left: 30px;'><strong>Alergia Medicamental:</strong> " . $user_data['alergia_medicamento'] . "</td>" : "");
                        echo ((!empty($user_data['alergia_inseto'])) ? "<td style='text-align: left; padding-left: 30px;'><strong>Alergia a Inseto:</strong> " . $user_data['alergia_inseto'] . "</td>" : "");
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>