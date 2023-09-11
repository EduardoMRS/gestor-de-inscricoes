<?php
if (isset($_POST['edit_site'])) {
    $config['url'] = $_POST['url_input'];
    $config['favicon'] = $_POST['favicon_input'];
    $config['fundo_wind'] = $_POST['fundo_wind_input'];
    $config['fundo_login'] = $_POST['fundo_login_input'];

    // Lê o conteúdo atual do arquivo
    $fileContent = file_get_contents('./config_site.php');

    // Atualiza os valores no array e na variável
    $fileContent = preg_replace('/\$siteConfig\s*=\s*(.*?);/s', "\$siteConfig = " . var_export($config, true) . ";", $fileContent);

    // Escreve o conteúdo atualizado de volta no arquivo
    if (file_put_contents('./config_site.php', $fileContent)) {
        // echo "<script>console.log('Tudo Certo')</script>";
    } else {
        // echo "<script>console.log('Deu errado!')</script>";
    }

    header('location: ../../admin');

} elseif (isset($_POST['edit_evento'])) {
    $evento['nome'] = $_POST['nome_input'];
    $evento['descricao'] = str_replace("*<", "<strong>", str_replace(">*", "</strong>", $_POST['descricao_input']));
    $evento['logo'] = $_POST['logo_input'];
    $evento['chave_pix'] = $_POST['chave_pix_input'];
    $evento['codigo_qr_pix'] = $_POST['codigo_qr_pix_input'];
    $evento['custo'] = $_POST['custo_input'];
    $evento['contato_ajuda'] = str_replace(array("(", ")", "-"), "" , $_POST['contato_ajuda_input']);

    $evento_inicio['dia'] = explode('-', $_POST['evento_inicio_data_input'])[2];
    $evento_inicio['mes'] = explode('-', $_POST['evento_inicio_data_input'])[1];
    $evento_inicio['ano'] = explode('-', $_POST['evento_inicio_data_input'])[0];
    $evento_inicio['hora'] = explode(':', $_POST['evento_inicio_hora_input'])[0];
    $evento_inicio['minuto'] = explode(':', $_POST['evento_inicio_hora_input'])[1];

    $evento_fim['dia'] = explode('-', $_POST['evento_fim_data_input'])[2];
    $evento_fim['mes'] = explode('-', $_POST['evento_fim_data_input'])[1];
    $evento_fim['ano'] = explode('-', $_POST['evento_fim_data_input'])[0];
    $evento_fim['hora'] = explode(':', $_POST['evento_fim_hora_input'])[0];
    $evento_fim['minuto'] = explode(':', $_POST['evento_fim_hora_input'])[1];

    // Lê o conteúdo atual do arquivo
    $fileContent = file_get_contents('./config_evento.php');

    // Atualiza os valores no array e na variável
    $fileContent = preg_replace('/\$evento\s*=\s*(.*?);/s', "\$evento = " . var_export($evento, true) . ";", $fileContent);
    $fileContent = preg_replace('/\$evento_inicio\s*=\s*(.*?);/s', "\$evento_inicio = " . var_export($evento_inicio, true) . ";", $fileContent);
    $fileContent = preg_replace('/\$evento_fim\s*=\s*(.*?);/s', "\$evento_fim = " . var_export($evento_fim, true) . ";", $fileContent);

    // Escreve o conteúdo atualizado de volta no arquivo
    if (file_put_contents('./config_evento.php', $fileContent)) {
        // echo "<script>console.log('Tudo Certo')</script>";
    } else {
        // echo "<script>console.log('Deu errado!')</script>";
    }

    header('location: ../../admin');
}
