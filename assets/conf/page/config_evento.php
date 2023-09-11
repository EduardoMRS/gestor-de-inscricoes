<div class="row justify-content-center">
    <h5 class="text-uppercase">Configurações do Evento</h5>
    <div class="col-sm">
        <label for="nome_input" class="form-label">Nome</label>
        <input type="text" class="form-control text-center" name="nome_input" id="nome_input" placeholder="Acampamento SOB Pressão" value="<?php echo $evento['nome'] ?>">
    </div>
    <div class="col-sm">
        <label for="contato_ajuda_input" class="form-label">Telefone para contato</label>
        <input type="text" inputmode="numeric" class="form-control text-center" name="contato_ajuda_input" id="contato_ajuda_input" placeholder="5599999999999" value="<?php echo $evento['contato_ajuda'] ?>">
    </div>
    <div class="row">
        <label for="descricao_input" class="form-label">Descrição do evento</label>
        <textarea class="form-control" name="descricao_input" id="descricao_input" cols="30" rows="5"><?php echo str_replace("<strong>", "*<", str_replace("</strong>", ">*", $evento['descricao'])) ?></textarea>
    </div>
    <div class="col-sm">
        <h5>Inicio</h5>
        <div class="d-flex gap-2">
            <input type="date" class="form-control text-center" name="evento_inicio_data_input" id="evento_inicio_data_input" value="<?php echo $evento_inicio['ano'] . "-" . $evento_inicio['mes'] . "-" . $evento_inicio['dia'] ?>">
            <input class="form-control" type="time" name="evento_inicio_hora_input" id="evento_inicio_hora_input" style="width: 60%;" value="<?php echo $evento_inicio['hora'] . ":" . $evento_inicio['minuto'] ?>">
        </div>
    </div>
    <div class="col-sm">
        <h5>Termino</h5>
        <div class="d-flex gap-2">
            <input type="date" class="form-control text-center" name="evento_fim_data_input" id="evento_fim_data_input" value="<?php echo $evento_fim['ano'] . "-" . $evento_fim['mes'] . "-" . $evento_fim['dia'] ?>">
            <input class="form-control" type="time" name="evento_fim_hora_input" id="evento_fim_hora_input" style="width: 60%;" value="<?php echo $evento_fim['hora'] . ":" . $evento_fim['minuto'] ?>">
        </div>
    </div>

    <div class="row">
        <div class="col">
            <label for="favicon_input" class="form-label">Logo do Evento</label>
            <div class="d-flex">
                <input onchange="img_input_chage_evento()" type="url" class="form-control text-center" name="logo_input" id="logo_input" placeholder="https://example.com/logo.png" value="<?php echo $evento['logo'] ?>">
                <i class="fa-solid fa-pen-to-square edit_btn_conf" id="btn_edit_logo"></i>
            </div>
        </div>
        <div>
            <img class="img_preview" src=" <?php echo $evento['logo'] ?>" alt="Imagem não encontrada" id="preview_logo">
        </div>
    </div>
    <hr>
    <div class="col-5">
        <label for="custo_input" class="form-label">Entrada</label>
        <input type="text" inputmode="doubleval" class="form-control text-center" name="custo_input" id="custo_input" placeholder="100,00" value="<?php echo $evento['custo'] ?>">
    </div>
    <div class="col" id="box_pix_chave">
        <label for="chave_pix_input" class="form-label">Chave PIX</label>
        <div class="d-flex">
            <input readonly type="text" class="form-control text-center" name="chave_pix_input" id="chave_pix_input" value="<?php echo $evento['chave_pix'] ?>">
            <i class="fa-solid fa-pen-to-square edit_btn_conf" id="btn_edit_chave_pix"></i>
        </div>
    </div>
</div>
<div class="row" id="box_pix_qr">
    <label for="codigo_qr_pix_input" class="form-label">Codigo QR</label>
    <div class="d-flex">
        <input readonly type="text" class="form-control text-center" name="codigo_qr_pix_input" id="codigo_qr_pix_input" value="<?php echo $evento['codigo_qr_pix'] ?>">
        <i class="fa-solid fa-pen-to-square edit_btn_conf" id="btn_edit_codigo_qr"></i>
    </div>
</div>
<div class="row mt-3 justify-content-center">
    <button type="submit" class="btn btn-primary" name="edit_evento" id="edit_evento" style="width: 70%;">Salvar</button>
</div>

<script>
    const valor_entrada = document.getElementById("custo_input");

    valor_entrada.addEventListener("change", () => {
        verifica_valor();
    });

    verifica_valor();

    function verifica_valor() {
        if (parseInt(valor_entrada.value) === 0) {
            document.getElementById('box_pix_chave').style = "display: none";
            document.getElementById('box_pix_qr').style = "display: none";
        } else {
            document.getElementById('box_pix_chave').style = "display: block";
            document.getElementById('box_pix_qr').style = "display: block";
        }
    };
</script>