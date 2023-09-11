<?php
include("../assets/conf/config_site.php");
include("../assets/conf/config_evento.php");
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $evento['nome']?> - Nova Incrição</title>
    <link rel="shortcut icon" href="<?php echo $siteConfig['favicon']; ?>" type="image/x-icon">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/fonts/fa/css/all.css">
    <link rel="stylesheet" href="../assets/css/form.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.8/jquery.inputmask.min.js"></script>

    <style>
        @media(min-width: 767px) {
            .body_adaptive_70 {
                width: 70vw;
            }
        }

        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
    </style>
</head>

<body class="d-flex align-items-center justify-content-center" style="background-image: url(<?php echo $siteConfig["fundo_wind"] ?>);
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-size: cover;
    background-position: center;">
    <div class="container" style="margin: 6rem 0 6rem 0;">
        <div class="container d-flex-column align-items-center justify-content-center body_adaptive_70" style="background-color: rgb(123, 123, 123); border-radius: 20px;">
            <div class="w-100 d-flex align-items-center justify-content-center pt-3">
                <div class="text-center d-flex align-items-center justify-content-center" style="width: 80px; height: 80px; font-size: 46px; background: white; border-radius: 100%;">
                    <i class="fa-solid fa-user"></i>
                </div>
            </div>
            <form action="../inscricao/confirmacao/index.php" method="post" class="row py-4 px-4 gap-2 d-flex align-items-center justify-content-center">
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
                        <div class="col-sm-auto">
                            <label for="user_membro" class="form-label">É membro ou frequenta alguma igreja?</label>
                            <select name="user_membro" id="user_membro" class="form-control">
                                <option value="0" selected>Não</option>
                                <option value="1">Sou membro</option>
                                <option value="2">Sou de outra</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-between" id="responsavel" style="display: none;">
                    <hr class="my-2">
                    <h4 class="text-uppercase" style="font-weight: bold;">Dados do Meu Responsavel</h4>
                    <div class="col-sm-7">
                        <label for="user_responsavel" class="form-label">Nome do Responsavel</label>
                        <input class="form-control" type="text" name="user_responsavel" id="user_responsavel" required disabled>
                    </div>
                    <div class="col-sm-4">
                        <label for="user_responsavel_cpf" class="form-label">CPF do Responsavel</label>
                        <input class="form-control" type="text" inputmode="numeric" name="user_responsavel_cpf" id="user_responsavel_cpf" placeholder="123.456.789-10" required disabled>
                    </div>
                    <hr class="mt-4">
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
                <hr class="mt-4">
                <div class="row mb-3 justify-content-center">
                    <h4 class="text-uppercase" style="font-weight: bold;">Alergias</h4>
                    <div class="row gap-3 justify-content-between">
                        <div class="col-sm">
                            <div class="row">
                                <label class="form-label" for="check_alergia_alimentos">Alimentos</label>
                                <select class="form-select col" name="check_alergia_alimentos" id="check_alergia_alimentos">
                                    <option value="0" selected>Não</option>
                                    <option value="1">Sim</option>
                                </select>
                            </div>
                            <div class="row mt-3" id="check_alergia_alimentos_box" style="display: none;">
                                <label class="form-label" for="check_alergia_alimentos_textarea">Quais?</label>
                                <textarea class="form-control" rows="3" name="check_alergia_alimentos_textarea" id="check_alergia_alimentos_textarea"></textarea>
                            </div>
                        </div>
                        <div class="col-sm">
                            <div class="row">
                                <label class="form-label" for="check_alergia_medicamento">Medicamentos</label>
                                <select class="form-select col" name="check_alergia_medicamento" id="check_alergia_medicamento">
                                    <option value="0" selected>Não</option>
                                    <option value="1">Sim</option>
                                </select>
                            </div>
                            <div class="row mt-3" id="check_alergia_medicamento_box" style="display: none;">
                                <label class="form-label" for="check_alergia_medicamento_textarea">Quais?</label>
                                <textarea class="form-control" rows="3" name="check_alergia_medicamento_textarea" id="check_alergia_medicamento_textarea"></textarea>
                            </div>
                        </div>
                        <div class="col-sm">
                            <div class="row">
                                <label class="form-label" for="check_alergia_insetos">Insetos</label>
                                <select class="form-select col" name="check_alergia_insetos" id="check_alergia_insetos">
                                    <option value="0" selected>Não</option>
                                    <option value="1">Sim</option>
                                </select>
                            </div>
                            <div class="row mt-3" id="check_alergia_insetos_box" style="display: none;">
                                <label class="form-label" for="check_alergia_insetos_textarea">Quais?</label>
                                <textarea class="form-control" rows="3" name="check_alergia_insetos_textarea" id="check_alergia_insetos_textarea"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center text-center pb-4 gap-2">
                    <div class="container">
                        <div class="form-check d-flex align-items-center justify-content-center gap-2">
                            <input class="form-check-input" type="checkbox" id="check_terms" disabled required>
                            <label class="form-check-label" for="check_terms" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal_terms">
                                Aceito os termos!
                            </label>
                        </div>
                    </div>
                    <div class="pb-2" style="width: 50vw;">
                        <button type="submit" class="btn btn-success w-100" style="height: 4rem;" name="btn_concluir" id="btn_concluir" disabled>
                            Finalizar Inscrição
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modal_terms" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal_termsLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modal_termsLabel">Requisitos Obrigatorios e Termos.</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <H4 style="color: red;">Atenção</H4>
                    <strong>O'Que Levar?</strong>
                    Levar: Prato e talher, barraca, colchonete e cobertor, itens de higiene pessoal, roupas leves e
                    decentes que podem sujar, repelente, protetor solar, boné, Bíblia.
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-outline-success" data-bs-dismiss="modal" id="btn_concordo">Concordo!</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Validação de idade
        const user_nascimento = document.getElementById("user_idade");
        user_nascimento.addEventListener("change", () => {
            if (user_nascimento.value >= 18) {
                document.getElementById("responsavel").style = "display: none";
                document.getElementById("user_responsavel").setAttribute("disabled", "disabled");
                document.getElementById("user_responsavel_cpf").setAttribute("disabled", "disabled");
            } else {
                document.getElementById("responsavel").style = "display: flex";
                document.getElementById("user_responsavel").removeAttribute("disabled");
                document.getElementById("user_responsavel_cpf").removeAttribute("disabled");
            }
        });

        // Seletores de Alergia
        // Alimentos
        const check_alergia_alimentos = document.getElementById("check_alergia_alimentos")
        check_alergia_alimentos.addEventListener("change", () => {
            if (check_alergia_alimentos.value === "1") {
                document.getElementById("check_alergia_alimentos_box").style = "display: flex";
            } else {
                document.getElementById("check_alergia_alimentos_box").style = "display: none";
            }
        });

        // Medicamentos
        const check_alergia_medicamento = document.getElementById("check_alergia_medicamento")
        check_alergia_medicamento.addEventListener("change", () => {
            if (check_alergia_medicamento.value === "1") {
                document.getElementById("check_alergia_medicamento_box").style = "display: flex";
            } else {
                document.getElementById("check_alergia_medicamento_box").style = "display: none";
            }
        });

        // Insetos
        const check_alergia_insetos = document.getElementById("check_alergia_insetos")
        check_alergia_insetos.addEventListener("change", () => {
            if (check_alergia_insetos.value === "1") {
                document.getElementById("check_alergia_insetos_box").style = "display: flex";
            } else {
                document.getElementById("check_alergia_insetos_box").style = "display: none";
            }
        });



        // Confirmação dos Termos
        const btn_concordo = document.getElementById("btn_concordo");
        btn_concordo.addEventListener("click", () => {
            document.getElementById("check_terms").removeAttribute("disabled");
            document.getElementById("check_terms").setAttribute("checked", "checked");
            btnConcluir.removeAttribute("disabled");
        });

        // Verifica se o checkbox está marcado
        const checkTerms = document.getElementById("check_terms");
        const btnConcluir = document.getElementById("btn_concluir");

        checkTerms.addEventListener("change", () => {
            if (checkTerms.checked) {
                btnConcluir.removeAttribute("disabled");
            } else {
                document.getElementById("check_terms").setAttribute("disabled", "disabled");
                btnConcluir.setAttribute("disabled", "disabled");
            }
        });

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