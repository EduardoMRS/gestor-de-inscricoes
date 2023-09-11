<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quase lá! - Formula</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.8/jquery.inputmask.min.js"></script>

    <style>
        @media(min-width: 767px) {
            .body_adaptive_70 {
                width: 70vw;
            }
        }
    </style>
</head>

<body class="d-flex justify-content-center align-items-center" style="padding: 6rem 0; background-color: #252525;">
    <div class="d-flex align-items-center justify-content-center body_adaptive_70" style="padding: 4rem;
        background-color: rgb(119 119 119 / 88%);
        box-shadow: 0px 8px 16px 8px black, inset 0px 2px 13px 17px #ffffff30;
        border-radius: 20px;
        backdrop-filter: blur(5px);">
        <div class="row gap-4">
            <div class="col-sm d-flex-column justify-content-center align-items-center">
                <h4 class="text-uppercase" style="font-weight: bold;">Quase lá</h4>
                <hr>
                <form class="row gap-3 justify-content-center align-items-center" action="../conect/check.php" method="post">
                    <div class="row">
                        <h5>Faça seu cadastro</h5>
                        <h6>Para finalizar a configuração inicial, faça seu cadastro para administrar o sistema mais tarde</h6>
                    </div>
                    <div class="d-flex row justify-content-between">
                        <h4 class="text-uppercase" style="font-weight: bold;">Meus Dados</h4>
                        <div class="col-sm">
                            <label for="user_nome" class="form-label">Nome</label>
                            <input class="form-control" type="text" name="user_nome" id="user_nome" required>
                        </div>
                        <div class="col-sm">
                            <label for="user_sobrenome" class="form-label">Sobrenome</label>
                            <input class="form-control" type="text" name="user_sobrenome" id="user_sobrenome" required>
                        </div>
                        <div class="col-sm-4">
                            <label for="user_idade" class="form-label">Idade</label>
                            <input class="form-control" type="number" inputmode="numeric" name="user_idade" id="user_idade" min="12" max="100" required>
                        </div>
                        <div class="row py-2">
                            <div class="col-sm-4">
                                <label for="user_cpf" class="form-label">CPF</label>
                                <input class="form-control" type="text" inputmode="numeric" name="user_cpf" id="user_cpf" placeholder="123.456.789-10" required>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <h4 class="text-uppercase" style="font-weight: bold;">Informações para Contato</h4>
                        <div class="col-sm">
                            <label for="user_estado" class="form-label">Estado:</label>
                            <select name="user_estado" id="user_estado" class="form-control" required>
                                <option value="">Selecione o estado</option>
                            </select>
                        </div>
                        <div class="col-sm">
                            <label for="user_cidade" class="form-label">Cidade:</label>
                            <select name="user_cidade" id="user_cidade" class="form-control" required>
                                <option value="">Selecione o estado primeiro</option>
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <label for="user_endereco_rua" class="form-label">Rua</label>
                            <input class="form-control" type="text" name="user_endereco_rua" id="user_endereco_rua" required>
                        </div>
                        <div class="col-sm">
                            <label for="user_endereco_bairro" class="form-label">Bairro</label>
                            <input class="form-control" type="text" name="user_endereco_bairro" id="user_endereco_bairro">
                        </div>
                        <div class="col-sm">
                            <label for="user_endereco_numero" class="form-label">Numero</label>
                            <input class="form-control" type="number" inputmode="numeric" name="user_endereco_numero" id="user_endereco_numero">
                        </div>
                        <div class="row justify-content-between mt-3">
                            <div class="col-sm-4">
                                <label for="user_cell" class="form-label">Celular / WhatsApp</label>
                                <input class="form-control" type="text" inputmode="numeric" name="user_cell" id="user_cell" placeholder="(69)99999-9999" required>
                            </div>
                            <div class="col-sm">
                                <label for="user_mail" class="form-label">E-Mail</label>
                                <input class="form-control" type="email" name="user_mail" id="user_mail" required>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center text-center pt-3">
                        <div style="width: 50vw;">
                            <button type="submit" class="btn btn-success w-100" style="height: 4rem;" name="cad_admin" id="cad_admin">
                                Finalizar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Adiciona mascara no CPF
        $(document).ready(function() {
            // Máscara de CPF para o campo user_cpf
            $('#user_cpf').inputmask('999.999.999-99');

            // Máscara de CPF para o campo user_responsavel_cpf
            $('#user_responsavel_cpf').inputmask('999.999.999-99');

            // Máscara para o campo user_cell
            $('#user_cell').inputmask('(99)[9]9999-9999');
        });


        ////////////////////////////////////////////////////////////////////////////////
        // Função para fazer a requisição à API do IBGE e preencher o seletor de estados
        function carregarEstados() {
            const url = "https://servicodados.ibge.gov.br/api/v1/localidades/estados";

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    const estadoSelect = document.getElementById("user_estado");

                    data.sort((a, b) => a.nome.localeCompare(b.nome));
                    data.forEach(estado => {
                        const option = document.createElement("option");
                        option.value = estado.sigla;
                        option.text = estado.nome;
                        estadoSelect.appendChild(option);
                    });
                })
                .catch(error => console.log(error));
        }


        // Função para carregar as cidades de um estado selecionado
        function carregarCidades(estado) {
            const url = `https://servicodados.ibge.gov.br/api/v1/localidades/estados/${estado}/municipios`;

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    const cidadeSelect = document.getElementById("user_cidade");
                    cidadeSelect.innerHTML = "";

                    data.sort((a, b) => a.nome.localeCompare(b.nome));
                    data.forEach(cidade => {
                        const option = document.createElement("option");
                        option.value = cidade.nome;
                        option.text = cidade.nome;
                        cidadeSelect.appendChild(option);
                    });
                })
                .catch(error => console.log(error));
        }

        // Carregar os estados ao carregar a página
        document.addEventListener("DOMContentLoaded", carregarEstados);

        // Evento para carregar as cidades ao selecionar um estado
        const estadoSelect = document.getElementById("user_estado");
        estadoSelect.addEventListener("change", () => {
            const estado = estadoSelect.value;
            carregarCidades(estado);
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
</body>

</html>