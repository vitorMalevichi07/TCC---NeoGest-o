<div class="modal fade" id="modalCadastroTransacao" tabindex="-1" aria-labelledby="modalCadastroLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Nova Transação</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body mb-5">
                <form class="row g-3" action="" method="POST">
                <div class="row g-4">
                    <div class="col-md-8">
                        <label for="descr" class="form-label">Descrição</label>
                        <input type="text" class="form-control" id="descr" name="descr" placeholder="Ex: Venda do Bar" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Categoria</label>
                        <select name="categoria" id="categoria" required class="form-select">
                            <option aria-readonly="" value="" selected>Selecione a Categoria</option>
                            <option value="1">Venda</option>
                            <option value="2">Serviço</option>
                            <option value="3">Troca</option>
                            <option value="4">Outros</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="tipo" class="form-label">Tipo</label>
                        <select name="tipo" id="tipo"class="form-select" required>
                            <option aria-readonly="" selected>Selecione o Tipo</option>
                            <option value="0">Entrada</option>
                            <option value="1">Saída</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="valor" class="form-label">Valor</label>
                        <input type="number" min="0"  class="form-control" id="valor" name="valor" placeholder="Valor da conta" required>
                    </div>
                    <div class="col-md-4">
                        <label for="data" class="form-label">Data Vencimento</label>
                        <input type="date" class="form-control" id="dt" name="dt" required>
                    </div>
                </div>
            </div>   
                <div class="modal-footer">
                    <div class="col-12">
                        <button type="submit" name="adicionar_fluxo" class="btn btn-primary">Adicionar Transação</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>