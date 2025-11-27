<!-- cadastro cli -->
<?php
include_once __DIR__ . '/CRUD/createCliente.php';
?>
<div class="modal fade" id="modalCadastro" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Cadastro de Cliente</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body">
                <form class="row g-3" action="" method="POST">
                    <div class="row g-4">
                        <div class="col-md-4">
                            <label for="nomeCli" class="form-label">Primeiro Nome</label>
                            <input type="text" class="form-control" id="nomeCli" name="nomeCli" placeholder="Seu nome"
                                required>
                        </div>
                        <div class="col-md-4">
                            <label for="sobrenomeCli" class="form-label">Sobrenome</label>
                            <input type="text" class="form-control" id="sobrenomeCli" name="sobrenomeCli"
                                placeholder="Seu sobrenome">
                        </div>
                        <div class="col-md-4">
                            <label for="dataNascCli" class="form-label">Data de Nascimento</label>
                            <input type="date" class="form-control" id="dataNascCli" name="dataNascCli">
                        </div>
                        <div class="col-md-4">
                            <label for="cpfCli" class="form-label">CPF</label>
                            <input type="text" class="form-control" id="cpfCli" name="cpfCli" maxlength="14"
                                placeholder="Seu CPF">
                        </div>
                        <div class="col-md-4">
                            <label for="cnpjCli" class="form-label">CNPJ</label>
                            <input type="text" class="form-control cnpj" id="cnpjCli" name="cnpjCli" maxlength="18"
                                placeholder="Ex: 00.000.000/0001-00">
                        </div>
                        <div class="col-md-4">
                            <label for="rgCli" class="form-label">RG (Registro Geral)</label>
                            <input type="text" class="form-control" id="rgCli" name="rgCli" maxlength="12"
                                placeholder="Ex: 00.000.000-0">
                        </div>
                        <div class="col-md-6">
                            <label for="celularCli" class="form-label">Celular</label>
                            <input type="text" class="form-control" id="celularCli" name="celularCli"
                                placeholder="ex: (99) 99999-9999" maxlength="15" required>
                        </div>
                        <div class="col-6">
                            <label for="emailCli" class="form-label">Email</label>
                            <input type="email" class="form-control" name="emailCli" id="emailCli"
                                placeholder="ex: seuemail@exemplo.com" required>
                        </div>
                        <div class="col-md-6">
                            <label for="cepCli" class="form-label">CEP</label>
                            <input type="text" class="form-control" id="cepCli" name="cepCli" maxlength="14"
                                placeholder="ex: 00.000-222">
                        </div>
                        <div class="col-md-6">
                            <label for="cidadeCli" class="form-label">Cidade</label>
                            <input type="text" class="form-control" id="cidadeCli" name="cidadeCli"
                                placeholder="ex: Sua Cidade">
                        </div>
                        <div class="col-md-6">
                            <label for="ruaCli" class="form-label">Rua</label>
                            <input type="text" class="form-control" id="ruaCli" name="ruaCli" placeholder="ex: Sua Rua">
                        </div>
                        <div class="col-md-3">
                            <label for="ufCli" class="form-label">Estado</label>
                            <input type="text" class="form-control" id="ufCli" name="ufCli" placeholder="ex: SP"
                                maxlength="2">
                        </div>
                        <div class="col-md-3">
                            <label for="ncasaCli" class="form-label">Nº Da Residência</label>
                            <input type="text" class="form-control" id="ncasaCli" name="ncasaCli" placeholder="ex: 123">
                        </div>
                        <div class="col-md-12">
                            <label for="complementocasaCli" class="form-label">Complementos</label>
                            <input type="text" class="form-control" id="complementocasaCli" name="complementocasaCli"
                                placeholder="ex: Apartamento 456">
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <div class="col-12">
                    <button type="submit" name="create_cliente" class="btn btn-primary">Adicionar Cliente</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>