<?php
if (isset($_GET['db_host']) && isset($_GET['db_user']) && isset($_GET['db_pass']) && isset($_GET['db_name'])) {;
    $dbConect = new mysqli($_GET['db_host'], $_GET['db_user'], $_GET['db_pass'], $_GET['db_name']);

    // Verifica se ocorreu um erro na conexão
    if ($dbConect->connect_errno) {
        // echo "<script>console.log('Deu Certo')</script>";
    } else {
        // echo "<script>console.log('Deu erro')</script>";
        $db_conect_date['host'] = $_GET['db_host'];
        $db_conect_date['name'] = $_GET['db_name'];
        $db_conect_date['user'] = $_GET['db_user'];
        $db_conect_date['pass'] = $_GET['db_pass'];

        // Lê o conteúdo atual do arquivo
        $fileContent = file_get_contents('../../assets/conf/config.php');

        // Atualiza os valores no array e na variável
        $fileContent = preg_replace('/\$db_conect_date\s*=\s*(.*?);/s', "\$db_conect_date = " . var_export($db_conect_date, true) . ";", $fileContent);

        file_put_contents('../../assets/conf/config.php', $fileContent);


        $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
        $host = $_SERVER['HTTP_HOST'];
        $uri = $_SERVER['REQUEST_URI'];
        $url = $protocol . '://' . $host . $uri;
        $parsedUrl = parse_url($url);
        $url = $parsedUrl['scheme'] . '://' . $parsedUrl['host'] . $parsedUrl['path'];
        $url = str_replace("/setup/conect/check.php", "", $url);

        // echo $url;

        $siteConfig = array(
            'url' => $url,
            'favicon' => $url . '/favicon.ico',
            'fundo_wind' => $url . '/assets/img/fundo_wind.jpg',
            'fundo_login' => $url . '/assets/img/fundo_login.jpg',
        );

        $fileContent = file_get_contents('../../assets/conf/config_site.php');
        $fileContent = preg_replace('/\$siteConfig\s*=\s*(.*?);/s', "\$siteConfig = " . var_export($siteConfig, true) . ";", $fileContent);
        file_put_contents('../../assets/conf/config_site.php', $fileContent);
    }
} elseif (isset($_POST['cad_admin'])) {
    include("../../assets/conf/config.php");
    $user_nome = ucwords(strtolower($_POST['user_nome']));
    $user_sobrenome = ucwords(strtolower($_POST['user_sobrenome']));
    $user_cpf = $_POST['user_cpf'];
    $user_idade = $_POST['user_idade'];
    $user_mail = $_POST['user_mail'];
    $user_cell = $_POST['user_cell'];
    $user_cidade = $_POST['user_cidade'];
    $user_estado = $_POST['user_estado'];
    $user_endereco = $_POST["user_endereco_rua"] . " - " . $_POST["user_endereco_numero"] . ", " . $_POST["user_endereco_bairro"];

    $query_creat_table = "CREATE TABLE `" . $db_conect_date['name'] . "`.`usuario` (
        `idUser` int(11) NOT NULL AUTO_INCREMENT,
        `nome` varchar(60) NOT NULL,
        `sobrenome` varchar(60) NOT NULL,
        `cpf` varchar(45) NOT NULL,
        `alergia_alimento` mediumtext DEFAULT NULL,
        `alergia_medicamento` mediumtext DEFAULT NULL,
        `alergia_inseto` mediumtext DEFAULT NULL,
        `membro` varchar(45) DEFAULT NULL,
        `idade` int(11) NOT NULL,
        `email` varchar(130) NOT NULL,
        `cell` varchar(15) NOT NULL,
        `image` varchar(300) DEFAULT 'http://manosdapl.host/downup/assents/img/user.webp',
        `permissao` varchar(20) NOT NULL DEFAULT '1,0,0,0',
        `cidade` varchar(45) DEFAULT NULL,
        `estado` varchar(45) DEFAULT NULL,
        `endereco` varchar(300) DEFAULT NULL,
        `responsavel` varchar(200) DEFAULT NULL,
        `responsavel_cpf` varchar(45) DEFAULT NULL,
        `status_pagamento` int(11) DEFAULT 0,
        PRIMARY KEY (`idUser`),
        UNIQUE KEY `idUser_UNIQUE` (`idUser`),
        UNIQUE KEY `email_UNIQUE` (`email`)
      ) ENGINE=InnoDB AUTO_INCREMENT=345000 DEFAULT CHARSET=utf8mb4";

    if ($result = $dbConect->query($query_creat_table)) {
        $scriptQuery = "INSERT INTO `" . $db_conect_date['name'] . "`.`usuario` (`nome`, `sobrenome`, `cpf`, `idade`, `email`, `cell`, `cidade`, `estado`, `endereco`, `permissao`) VALUES ('$user_nome', '$user_sobrenome', '$user_cpf', '$user_idade', '$user_mail', '$user_cell', " . '"' . $user_cidade . '"' . ", '$user_estado', '$user_endereco', '1,1,1,1');";
        // echo $scriptQuery;
        if ($result = $dbConect->query($scriptQuery)) {
            // echo '<br>INSERT Realizado com Sucesso!';
            $_SESSION['user_nome'] = $user_nome;
            $_SESSION['user_mail'] = $user_mail;
            $_SESSION['user_cpf'] = $user_cpf;
            $_SESSION['user_cell'] = $user_cell;
            $_SESSION['user_permissao'] = explode(",", "1,0,0,0");
            $_SESSION['logado'] = true;

            header('location: ../../');
        } else {
            // echo '<br>Erro no INSERT';
        }
    }
}
