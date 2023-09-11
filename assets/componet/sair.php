<?php
session_start();
unset($_SESSION['user_nome']);
unset($_SESSION['user_mail']);
unset($_SESSION['user_cpf']);
unset($_SESSION['user_cell']);
unset($_SESSION['status_pagamento']);
$_SESSION['logado'] = false;
header("location: ../../");
