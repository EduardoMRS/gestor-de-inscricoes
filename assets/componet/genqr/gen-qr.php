<?php
if($_GET['cod_pix']){
    require  "../phpqrcode/qrlib.php";
   QRcode::png($_GET['cod_pix'], './qr_code.png');
}


