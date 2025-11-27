<div class="modal fade" id="modalEditar" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <form class="row g-3" action="modalFuncionamento/CRUD/processUpdate.php" method="POST">
                <input type="hidden" name="inputIdEditar" id="inputIdEditar" value="">
                <div class="modal-header">
                    <h5 class="modal-title">Alterações do funcionamento</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-4">
                        <div class="col-md-4">
                            <label for="aberturaFuncio" class="form-label">Horário de Abertura</label>
                            <input type="time" class="form-control" id="aberturaFuncio" name="aberturaFuncio">
                        </div>
                        <div class="col-md-4">
                            <label for="intervaloTempo" class="form-label">Intervalo de Tempo</label>
                            <div class="input-intervalo">
                                <select class="form-select" aria-label="Default select example" name="intervaloTempo"
                                    id="intervaloTempo">
                                    <option value="0">15 minutos</option>
                                    <option value="1">30 minutos</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="fechamentoFuncio" class="form-label">Horário de Fechamento</label>
                            <input type="time" class="form-control" id="fechamentoFuncio" name="fechamentoFuncio">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="col-12">
                        <button type="submit" name="alteracoes" class="btn btn-primary">Salvar Alterações</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>