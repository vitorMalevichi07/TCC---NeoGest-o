<div class="modal fade" id="modalExcluir" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <form class="row g-3" action="" method="POST">
                <input type="hidden" id="inputIdExcluir" name="id_quadra" value="">
                <div class="modal-header">
                    <h5 class="modal-title">Exlusão da Quadra</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <h6>Deseja realmete excluir esta <span style="color: blue;">QUADRA</span>?</h6>
                        </div>
                    </div>
                    <div class="row g-4">
                        <div class="col-md-6">
                            <label for="descr_quadra_del" class="form-label">Quadra</label>
                            <input type="text" name="descr_quadra_del" id="descr_quadra_del" class="form-control"
                                disabled>
                        </div>
                        <div class="col-md-6">
                            <label for="mod_quadra_del" class="form-label">Modalidade</label>
                            <select class="form-select" id="mod_quadra_del" name="mod_quadra_del" disabled>
                                <?php
                                $stmtMod = $pdo->prepare("SELECT id, descr FROM modalidade_quadra");
                                $stmtMod->execute();
                                $modalidades = $stmtMod->fetchAll();
                                foreach ($modalidades as $modalidade) {
                                    echo "<option value='{$modalidade['id']}'>{$modalidade['descr']}</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="col-12">
                        <button type="submit" name="delete_quadra" class="btn btn-primary">Excluir</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>