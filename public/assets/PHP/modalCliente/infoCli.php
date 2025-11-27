<div class="modal fade" id="modalInfo" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <form class="row g-3" action="#" method="POST">
                <input type="hidden" id="inputIdInfo" name="id_cliente" value="">
                <div class="modal-header">
                    <h5 class="modal-title">Informações do Cliente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <label for="name_cli_info" class="form-label">Nome</label>
                            <input type="text" class="form-control" id="name_cli_info" name="name_cli_info" readonly
                                placeholder="Nome" disabled>
                        </div>

                        <div class="col-md-6">
                            <label for="lastname_cli_info" class="form-label">Sobrenome</label>
                            <input type="text" class="form-control" id="lastname_cli_info" name="lastname_cli_info"
                                readonly placeholder="Sobrenome" disabled>
                        </div>

                        <div class="col-md-4">
                            <label for="dataNasc_cli_info" class="form-label">Data de Nascimento</label>
                            <input type="date" class="form-control" id="dataNasc_cli_info" name="dataNasc_cli_info"
                                disabled>
                        </div>

                        <div class="col-md-4">
                            <label for="dataCadast_cli_info" class="form-label">Data de Cadastro</label>
                            <input type="date" class="form-control" id="dataCadast_cli_info" name="dataCadast_cli_info"
                                disabled>
                        </div>

                        <div class="col-md-4">
                            <label for="email_cli_info" class="form-label">Email</label>
                            <input type="text" class="form-control" id="email_cli_info" name="email_cli_info" readonly
                                placeholder="email@email.com" disabled>
                        </div>

                        <div class="col-md-4">
                            <label for="cpf_cli_info" class="form-label">CPF</label>
                            <input type="text" class="form-control" id="cpf_cli_info" name="cpf_cli_info"
                                placeholder="000.000.000-00" disabled>
                        </div>

                        <div class="col-md-4">
                            <label for="cnpj_cli_info" class="form-label">CNPJ</label>
                            <input type="text" class="form-control" id="cnpj_cli_info" name="cnpj_cli_info"
                                placeholder="00.000.000/0000-00" disabled>
                        </div>

                        <div class="col-md-4">
                            <label for="cel_cli_info" class="form-label">Celular</label>
                            <input type="text" class="form-control" id="cel_cli_info" name="cel_cli_info"
                                placeholder="(00) 00000-0000" disabled>
                        </div>

                        <div class="col-md-6">
                            <label for="cep_cli_info" class="form-label">CEP</label>
                            <input type="text" class="form-control" id="cep_cli_info" name="cep_cli_info"
                                placeholder="00.000-000" disabled>
                        </div>

                        <div class="col-md-4">
                            <label for="cidade_cli_info" class="form-label">Cidade</label>
                            <input type="text" class="form-control" id="cidade_cli_info" name="cidade_cli_info"
                                placeholder="Várzea Paulista" disabled>
                        </div>

                        <div class="col-md-2">
                            <label for="uf_cli_info" class="form-label">UF</label>
                            <input type="text" class="form-control" id="uf_cli_info" name="uf_cli_info" placeholder="SP"
                                disabled>
                        </div>

                        <div class="col-md-6">
                            <label for="rua_cli_info" class="form-label">Rua</label>
                            <input type="text" class="form-control" id="rua_cli_info" name="rua_cli_info"
                                placeholder="Rua" disabled>
                        </div>

                        <div class="col-md-6">
                            <label for="numCasa_cli_info" class="form-label">Número</label>
                            <input type="text" class="form-control" id="numCasa_cli_info" name="numCasa_cli_info"
                                placeholder="123" disabled>
                        </div>

                        <div class="col-md-12">
                            <label for="complemento_cli_info" class="form-label">Complementos</label>
                            <input type="text" class="form-control" id="complemento_cli_info"
                                name="complemento_cli_info" placeholder="Apartamento, casa, etc." disabled>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <div class="col-12">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal"
                            aria-label="Fechar">Confirmar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>