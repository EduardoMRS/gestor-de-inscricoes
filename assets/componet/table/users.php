<?php include("../../conf/config.php");
if ($_GET["search"] && !empty($_GET["search"])) {
    $search = " WHERE idUser LIKE '%" . $_GET["search"] . "%'";
} else {
    $search = "";
}
?>

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

            $resultList = $dbConect->query("SELECT * FROM `" . $db_conect_date['name'] . "`.`usuario`" . $search . " order by `nome`");
            //Enquanto $table_data receber os dados de $resultList sera adicionado os dados em linha
            while ($user_data = mysqli_fetch_assoc($resultList)) {
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
                echo "<td style='text-align: left; vertical-align: middle'>" . ucwords(strtolower($user_data['nome'])) . " " . ucwords(strtolower($user_data['sobrenome'])) . "</td>";
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
    $incricao = (mysqli_num_rows($dbConect->query("SELECT * FROM `" . $db_conect_date['name'] . "`.`usuario`")));
    $taxa_aguardando = (mysqli_num_rows($dbConect->query("SELECT * FROM `" . $db_conect_date['name'] . "`.`usuario` WHERE status_pagamento='0'")));
    $taxa_paga = (mysqli_num_rows($dbConect->query("SELECT * FROM `" . $db_conect_date['name'] . "`.`usuario` WHERE status_pagamento='2'")));
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

<script>
    document.querySelector("#btn_search").innerHTML = "Teste";
</script>