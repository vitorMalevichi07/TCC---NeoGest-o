<div class="modal fade" id="modalEditar" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <form class="row g-3" action="" method="POST">
                <input type="hidden" id="inputIdEditar" name="id_cliente" value="">
                <div class="modal-header">
                    <h5 class="modal-title">Alterações do Cliente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <label for="name_cli_edit" class="form-label">Nome</label>
                            <input type="text" class="form-control" id="name_cli_edit" name="name_cli_edit"
                                placeholder="Nome">
                        </div>

                        <div class="col-md-6">
                            <label for="lastname_cli_edit" class="form-label">Sobrenome</label>
                            <input type="text" class="form-control" id="lastname_cli_edit" name="lastname_cli_edit"
                                placeholder="Sobrenome">
                        </div>

                        <div class="col-md-4">
                            <label for="dataNasc_cli_edit" class="form-label">Data de Nascimento</label>
                            <input type="date" class="form-control" id="dataNasc_cli_edit" name="dataNasc_cli_edit">
                        </div>

                        <div class="col-md-4">
                            <label for="dataCadast_cli_edit" class="form-label">Data de Cadastro</label>
                            <input type="date" class="form-control" id="dataCadast_cli_edit" name="dataCadast_cli_edit"
                                disabled>
                        </div>

                        <div class="col-md-4">
                            <label for="email_cli_edit" class="form-label">Email</label>
                            <input type="text" class="form-control" id="email_cli_edit" name="email_cli_edit"
                                placeholder="email@email.com">
                        </div>

                        <div class="col-md-4">
                            <label for="cpf_cli_edit" class="form-label">CPF</label>
                            <input type="text" class="form-control" id="cpf_cli_edit" name="cpf_cli_edit"
                                placeholder="000.000.000-00" maxlength="14">
                        </div>

                        <div class="col-md-4">
                            <label for="cnpj_cli_edit" class="form-label">CNPJ</label>
                            <input type="text" class="form-control" id="cnpj_cli_edit" name="cnpj_cli_edit"
                                placeholder="00.000.000/0000-00" maxlength="18">
                        </div>

                        <div class="col-md-4">
                            <label for="cel_cli_edit" class="form-label">Celular</label>
                            <input type="text" class="form-control" id="cel_cli_edit" name="cel_cli_edit"
                                placeholder="(00) 00000-0000" maxlength="15">
                        </div>

                        <div class="col-md-6">
                            <label for="cep_cli_edit" class="form-label">CEP</label>
                            <input type="text" class="form-control" id="cep_cli_edit" name="cep_cli_edit"
                                placeholder="00.000-000" maxlength="14">
                        </div>

                        <div class="col-md-4">
                            <label for="cidade_cli_edit" class="form-label">Cidade</label>
                            <input type="text" class="form-control" id="cidade_cli_edit" name="cidade_cli_edit"
                                placeholder="Várzea Paulista" readonly>
                        </div>

                        <div class="col-md-2">
                            <label for="uf_cli_edit" class="form-label">UF</label>
                            <input type="text" class="form-control" id="uf_cli_edit" name="uf_cli_edit" placeholder="SP"
                                readonly>
                        </div>

                        <div class="col-md-6">
                            <label for="rua_cli_edit" class="form-label">Rua</label>
                            <input type="text" class="form-control" id="rua_cli_edit" name="rua_cli_edit"
                                placeholder="Rua" readonly>
                        </div>

                        <div class="col-md-6">
                            <label for="numCasa_cli_edit" class="form-label">Número</label>
                            <input type="text" class="form-control" id="numCasa_cli_edit" name="numCasa_cli_edit"
                                placeholder="123">
                        </div>

                        <div class="col-md-12">
                            <label for="complementos_cli_edit" class="form-label">Complementos</label>
                            <input type="text" class="form-control" id="complementos_cli_edit"
                                name="complementos_cli_edit" placeholder="Apartamento, casa, etc.">
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <div class="col-12">
                        <button type="submit" name="edit_cliente" class="btn btn-primary">Salvar Alterações</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>