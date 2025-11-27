    <div class="modal fade" id="modalEditar" tabindex="-1" aria-labelledby="modalCadastroLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Alterações da Conta</h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                    </div>
                    <div class="modal-body mb-5">
                        <form class="row g-3" action="" method="POST">
                        <input type="hidden" id="inputIdEditar" name="id_conta" value="">
                        <div class="row g-4">
                            <div class="col-md-4">
                                <label for="descr_conta" class="form-label">Descrição</label>
                                <input type="text" class="form-control" id="descr_conta" name="descr_conta" required>
                            </div>
                            <div class="col-md-4">
                                <label for="categoria" class="form-label">Categoria</label>
                                <select name="categoria" id="categoria" class="form-select" required>
                                    <option value="0">Pagar</option>
                                    <option value="1">Receber</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="recorrencia" class="form-label">Recorrência</label>
                                <select name="recorrencia" id="recorrencia" required class="form-select">
                                    <option value="0">Única</option>
                                    <option value="1">Semanal</option>
                                    <option value="2">15 dias</option>
                                    <option value="3">Mensal</option>
                                    <option value="4">Anual</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="valor_conta" class="form-label">Valor</label>
                                <input type="number" step="10" class="form-control" id="valor_conta" name="valor_conta" placeholder="Valor da conta" required>
                            </div>
                            <div class="col-md-4">
                                <label for="data_vencimento" class="form-label">Data Vencimento</label>
                                <input type="date" class="form-control" id="data_vencimento" name="data_vencimento" required>
                            </div>
                            <div class="col-md-4">
                                <label for="tipo" class="form-label">Tipo</label>
                                <select name="tipo" id="tipo" required class="form-select">
                                    <option value="1">Fornecedor</option>
                                    <option value="2">Funcionário</option>
                                    <option value="3">Cliente</option>
                                    <option value="4">Gasto Fixo</option>
                                    <option value="5">Outros</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="cpf_cnpj" class="form-label">CPF/CNPJ</label>
                                <input type="text" class="form-control" id="cpf_cnpj" name="cpf_cnpj"  placeholder="CPF ou CNPJ">
                            </div>
                            <div class="col-md-8">
                                <label for="observacao_conta" class="form-label">Observações</label>
                                <input class="form-control"  id="observacao_conta" name="observacao_conta"  placeholder="Observações adicionais">
                            </div>
                        </div>
                    </div>   
                        <div class="modal-footer">
                            <div class="col-12">
                                <button type="submit" name="update_conta" class="btn btn-primary ">Adicionar Conta</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div> 