<div class="row justify-content-center">
    <h5 class="text-uppercase">Configurações do Site</h5>
    <div>
        <label for="url_input" class="form-label">URL</label>
        <input type="url" class="form-control text-center" name="url_input" id="url_input" placeholder="Insira a URL" value="<?php echo $siteConfig['url'] ?>">
    </div>
    <div class="col">
        <label for="favicon_input" class="form-label">Logo do Site</label>
        <div class="d-flex">
            <input onchange="img_input_chage_site()" type="url" class="form-control text-center" name="favicon_input" id="favicon_input" placeholder="https://example.com/logo.png" value="<?php echo $siteConfig['favicon'] ?>">
            <i class="fa-solid fa-pen-to-square edit_btn_conf" id="btn_edit_favico"></i>
        </div>
    </div>
    <div>
        <img class="img_preview" src="<?php echo $siteConfig['favicon'] ?>" alt="Imagem não encontrada" id="preview_favico">
    </div>

    <h5 style="margin-top: 1.5rem;">Fundo da Pagina</h5>
    <div>
        <label for="fundo_wind_input" class="form-label">Todas</label>
        <div class="d-flex">
            <input onchange="img_input_chage_site()" type="url" class="form-control text-center" name="fundo_wind_input" id="fundo_wind_input" placeholder="https://example.com/imagen.png" value="<?php echo $siteConfig['fundo_wind'] ?>">
            <i class="fa-solid fa-pen-to-square edit_btn_conf" id="btn_edit_img_wide"></i>
        </div>
        <img class="img_preview  text-center" src="<?php echo $siteConfig['fundo_wind'] ?>" alt="Imagem não encontrada" id="preview_img_wide">
    </div>
    <div class="col">
        <label for="fundo_login_input" class="form-label">Login</label>
        <div class="d-flex">
            <input onchange="img_input_chage_site()" type="url" class="form-control text-center" name="fundo_login_input" id="fundo_login_input" placeholder="https://example.com/imagen.png" value="<?php echo $siteConfig['fundo_login'] ?>">
            <i class="fa-solid fa-pen-to-square edit_btn_conf" id="btn_edit_img_login"></i>
        </div>
        <img class="img_preview  text-center" src="<?php echo $siteConfig['fundo_login'] ?>" alt="Imagem não encontrada" id="preview_img_login">
    </div>
</div>
<div class="row mt-3 justify-content-center" class="form-label">
    <button type="submit" class="btn btn-primary" name="edit_site" id="edit_site" style="width: 70%;">Salvar</button>
</div>