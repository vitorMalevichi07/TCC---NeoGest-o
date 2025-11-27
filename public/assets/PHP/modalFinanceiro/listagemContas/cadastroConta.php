<div class="modal fade" id="modalCadastro" tabindex="-1" aria-labelledby="modalCadastroLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Cadastro de Conta</h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                    </div>
                    <div class="modal-body mb-5">
                        <form class="row g-3" action="" method="POST">
                        <div class="row g-4">
                            <div class="col-md-4">
                                <label for="descrConta" class="form-label">Descrição</label>
                                <input type="text" class="form-control" id="descrConta" name="descrConta" placeholder="Ex: Conta de Luz" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Categoria</label>
                                <select name="categoria" id="categoria" required class="form-select">
                                    <option aria-readonly="" selected>Selecione a categoria</option>
                                    <option value="0">Pagar</option>
                                    <option value="1">Receber</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="recorrencia" class="form-label">Recorrência</label>
                                <select name="recorrencia" id="recorrencia" class="form-select" required>
                                    <option aria-readonly="" value="" selected>Selecione a recorrência</option>
                                    <option value="0">Única</option>
                                    <option value="1">Semanal</option>
                                    <option value="2">15 dias</option>
                                    <option value="3">Mensal</option>
                                    <option value="4">Anual</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="valorConta" class="form-label">Valor</label>
                                <input type="number" step="10" class="form-control" id="valorConta" name="valorConta" placeholder="Valor da conta" required>
                            </div>
                            <div class="col-md-4">
                                <label for="dataVencimentoConta" class="form-label">Data Vencimento</label>
                                <input type="date" class="form-control" id="dataVencimentoConta" name="dataVencimentoConta" required>
                            </div>
                            <div class="col-md-4">
                                <label for="tipo" class="form-label">Tipo</label>
                                <select name="tipo" id="tipo"class="form-select" required>
                                    <option aria-readonly="" value="" selected>Selecione o tipo</option>
                                    <option value="1">Fornecedor</option>
                                    <option value="2">Funcionário</option>
                                    <option value="3">Cliente</option>
                                    <option value="4">Gasto Fixo</option>
                                    <option value="5">Outros</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="cpfCnpjConta" class="form-label">CPF/CNPJ</label>
                                <input type="text" class="form-control" id="cpfCnpjConta" name="cpfCnpjConta"  placeholder="CPF ou CNPJ">
                            </div>
                            <div class="col-md-8">
                                <label for="observacoesConta" class="form-label">Observações</label>
                                <input class="form-control"  id="observacoesConta" name="observacoesConta"  placeholder="Observações adicionais">
                            </div>
                        </div>
                    </div>   
                        <div class="modal-footer">
                            <div class="col-12">
                                <button type="submit" name="create_conta" class="btn btn-primary ">Adicionar Conta</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div> 