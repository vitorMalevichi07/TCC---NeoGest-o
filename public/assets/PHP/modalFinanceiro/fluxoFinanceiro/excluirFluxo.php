<div class="modal fade" id="modalExcluir" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content p-2">
            <form class="row g-3" action="" method="POST">
                <input type="hidden" id="inputIdExcluir" name="id_fluxo" value="">
                <div class="modal-header">
                    <h5 class="modal-title">Exlusão de Transação</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body p-3">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <h6>Deseja realmete excluir esta <span style="color: blue;">TRANSAÇÃO</span>?</h6>
                        </div>
                    </div>
                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="form-label">Descrição</label>
                            <input type="text" name="descr_del" id="descr_del" class="form-control"
                                disabled>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="col-12">
                        <button type="submit" name="delete_fluxo" class="btn btn-primary">Excluir</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>