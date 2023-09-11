<style>
    .btn_botton {
        position: fixed;
        bottom: 28px;
        text-decoration: none;
        border-radius: 100%;
        border: 2px solid black;
        height: 60px;
        width: 60px;
        display: flex;
        flex-wrap: wrap;
        align-content: center;
        justify-content: center;
        box-shadow: -1px 1px 11px black;
        color: black;
        font-size: 26px;
        transition: 1s;
    }

    .btn_botton:hover {
        box-shadow: inset 0px 1px 7px black;
        height: 80px;
        width: 80px;
        font-size: 36px;
        transition: 1s;
    }

    #btn_pagamento {
        right: 36px;
        background-color: #ffc107;
    }

    #btn_ajuda {
        left: 36px;
        background-color: #4fff08;
    }

    @media(max-width: 767px) {
        #btn_pagamento {
            bottom: 10px;
            right: 10px;
            height: 60px;
            width: 60px;
            font-size: 32px;
        }

        #btn_ajuda {
            bottom: 10px;
            left: 10px;
            height: 60px;
            width: 60px;
            font-size: 36px;
        }
    }
</style>

<link rel="stylesheet" href="/formula/assets/css/style.css">
<!-- Navbar fixa no topo com cor setada manualmente -->
<nav class="navbar fixed-top navbar-expand-lg navbar-dark" id="navbar-top-fixed-custom">
    <div class="container" style="width: 100%;">
        <!-- Nome e Logo da Pagina -->
        <a class="navbar-brand  <?php echo ($tabPage == "home" ? ('active" id="pagiaAtual') : ''); ?>" href="<?php echo $siteConfig["url"] ?>" style="background: #505050; padding: 6px 18px; border-radius: 6px;">
            <i class="fa-solid fa-house" style="margin-right: 10px;"></i> Inicio
        </a>
        <!-- Definição para Navbar responsiva -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#conteudoNavbarSuportado" aria-controls="conteudoNavbarSuportado" aria-expanded="false" aria-label="Alterna navegação">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="conteudoNavbarSuportado">
            <!-- Navbar Esquerda -->
            <ul class="navbar-nav me-auto">
            </ul>
            <!-- NAV Bar direita -->
            <ul class="navbar-nav ms-auto">
                <?php
                if ($_SESSION['user_permissao'][1] || $_SESSION['user_permissao'][2]) {
                    echo '<li class="navbar-item">
                    <a class="nav-link' . (($tabPage == "validador") ? '" id="pagiaAtual' : '') .  '" href="' . $siteConfig["url"] . '/ticket/validador" class="sr-only">Validador <i class="fa-solid fa-qrcode"></i></i></a>
                </li>';
                }
                ?>
                <li class="navbar-item">
                    <a class="nav-link<?php echo ($tabPage == "status_pagamento") ? '" id="pagiaAtual' : '' ?>" href="<?php echo $siteConfig["url"] ?>/pagamento/status/" class="sr-only">Pagamento <i class="fa-solid fa-magnifying-glass-dollar <?php echo ($tabPage == "status_pagamento") ? '' : (($_SESSION['status_pagamento'] == 2) ? '" style="color: #12ff12;"' : 'fa-bounce" style="color: #ee4f00') ?>"></i></a>
                </li>
                <!-- Dropdown para Navbar -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle<?php echo ($tabPage == "user_list") ? ' active" id="pagiaAtual' : '' ?>" href="" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Olá, <?php echo ucwords(strtolower(explode(" ", $_SESSION['user_nome'])[0])) ?> <i class="fa-solid fa-user"></i>
                    </a>
                    <div class="dropdown-menu text-center" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item<?php echo ($tabPage == "home") ? '" id="pagiaAtual' : '' ?>" href="<?php echo $siteConfig["url"] ?>/user/">Meus Dados</a>
                        <?php
                        if ($_SESSION['user_permissao'][1]) {
                            echo '<a class="dropdown-item' . (($tabPage == "user_list") ? '" id="pagiaAtual' : '') . '" href="' . $siteConfig["url"] . '/user/list/">Inscritos <i class="fa-solid fa-users"></i></a>';
                        }
                        if ($_SESSION['user_permissao'][3]) {
                            echo '<a class="dropdown-item' . (($tabPage == "admin") ? '" id="pagiaAtual' : '') . '" href="' . $siteConfig["url"] . '/admin">Administração <i class="fa-solid fa-gear"></i></a>';
                        }
                        ?>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?php echo $siteConfig["url"] ?>/assets/componet/sair.php">Sair <i class="fa-solid fa-right-from-bracket" id="icosNav" style="color: black"></i></a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>

<?php
switch ($_SESSION['status_pagamento']) {
    case '2':
        echo '<a href="' . $siteConfig["url"] . '/ticket" class="fa-solid fa-ticket-simple btn_botton" id="btn_pagamento"></a>';
        break;

    default:
        echo '<a href="' . $siteConfig["url"] . '/pagamento/status" class="fa-regular fa-money-bill-1 btn_botton" id="btn_pagamento"></a>';
        break;
}

if (!$_SESSION['user_permissao'][1] || $_SESSION['status_pagamento'] == 1) {
    echo '<a class="fa-brands fa-whatsapp btn_botton" id="btn_ajuda" href="https://wa.me//' . $evento['contato_ajuda'] . '?text=Olá me chamo *' . ucwords(strtolower(explode(" ", $_SESSION['user_nome'])[0])) . '*,%0AEstou precisando de ajuda com a minha inscrição para o acampamento%0A%0AMinha inscrição: *' . $_SESSION['idUser'] . '*" target="_blank"><span class="sr-only"></span></a>;';
}
?>