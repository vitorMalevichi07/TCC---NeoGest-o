    <div class="modal fade" id="modalInfo" tabindex="-1" aria-labelledby="modalInfoLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Informações da Conta</h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                    </div>
                    <div class="modal-body mb-5">
                        <form class="row g-3" action="#" method="POST">
                        <input type="hidden" id="inputIdInfo" name="id_conta" value="">
                        <div class="row g-4">
                            <div class="col-md-4">
                                <label for="descr_conta_info" class="form-label">Descrição</label>
                                <input type="text" class="form-control" id="descr_conta_info" name="descr_conta_info" disabled required>
                            </div>
                            <div class="col-md-4">
                                <label for="categoria_info" class="form-label">Categoria</label>
                                <select name="categoria_info" id="categoria_info" disabled required class="form-select" >
                                    <option value="0">Pagar</option>
                                    <option value="1">Receber</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="recorrencia_info" class="form-label">Recorrência</label>
                                <select name="recorrencia_info" id="recorrencia_info" disabled required class="form-select">
                                    <option value="0">Única</option>
                                    <option value="1">Semanal</option>
                                    <option value="2">15 dias</option>
                                    <option value="3">Mensal</option>
                                    <option value="4">Anual</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="valor_conta_info" class="form-label">Valor</label>
                                <input type="number" step="10" class="form-control" id="valor_conta_info" name="valor_conta_info" disabled required>
                            </div>
                            <div class="col-md-4">
                                <label for="data_vencimento_info" class="form-label">Data Vencimento</label>
                                <input type="date" class="form-control" id="data_vencimento_info" name="data_vencimento_info" disabled required>
                            </div>
                            <div class="col-md-4">
                                <label for="tipo_info" class="form-label">Tipo</label>
                                <select name="tipo_info" id="tipo_info" disabled required class="form-select">
                                    <option value="1">Fornecedor</option>
                                    <option value="2">Funcionário</option>
                                    <option value="3">Cliente</option>
                                    <option value="4">Gasto Fixo</option>
                                    <option value="5">Outros</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="cpf_cnpj_info" class="form-label">CPF/CNPJ</label>
                                <input type="text" class="form-control" id="cpf_cnpj_info" name="cpf_cnpj_info"  placeholder="CPF ou CNPJ" disabled>
                            </div>
                            <div class="col-md-8">
                                <label for="observacao_conta_info" class="form-label">Observações</label>
                                <input class="form-control"  id="observacao_conta_info" name="observacao_conta_info"  placeholder="Observações adicionais" disabled>
                            </div>
                        </div>
                    </div>   
                        <div class="modal-footer">
                            <div class="col-12">
                                <button type="button" data-bs-dismiss="modal" class="btn btn-primary">Voltar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div> 