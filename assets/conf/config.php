<?php
$db_conect_date = array (
  'host' => '',
  'name' => '',
  'user' => '',
  'pass' => '',
);

$filtered_array = array_filter($db_conect_date);
if (count($filtered_array) > 3) {
  $dbConect = new mysqli($db_conect_date['host'], $db_conect_date['user'], $db_conect_date['pass'], $db_conect_date['name']);
}

$metaTagSite = '
    <meta charset="UTF-8">
    <meta name="keywords" content="IEAB, acampamento, formulario, inscrição">
    <meta name="author" content="Eduardo M. R. da Silva" />
    <meta name="copyright" content="© 2023 EncDesign" />
    <meta name="robots" content="index,nofollow">
    <meta name="generator" content="VS Code" />
    <meta name="revisit-after" content="2 days" />';
