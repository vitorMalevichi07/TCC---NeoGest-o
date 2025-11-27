<div class="modal fade" id="modalInfo" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <form class="row g-3" action="#" method="POST">
                <input type="hidden" id="inputIdInfo" name="id_quadra" value="">
                <div class="modal-header">
                    <h5 class="modal-title">Informações da Quadra</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <label for="descr_quadra_info" class="form-label">Quadra</label>
                            <input type="text" class="form-control" id="descr_quadra_info" name="descr_quadra_info"
                                placeholder="Quadra" disabled>
                        </div>
                        <div class="col-md-6">
                            <label for="disp_quadra_info" class="form-label">Disponibilidade</label>
                            <select class="form-select" id="disp_quadra_info" name="disp_quadra_info" disabled>
                                <option value="1">Disponível</option>
                                <option value="0">Indisponível</option>
                            </select>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="mod_quadra_info" class="form-label">Modalidade</label>
                            <select name="mod_quadra_info" id="mod_quadra_info" class="form-select" disabled>
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
                        <div class="col-md-6">
                            <label for="valor_quadra_info" class="form-label">Valor do Agendamento</label>
                            <input type="number" min="0" class="form-control" id="valor_quadra_info"
                                name="valor_quadra_info" placeholder="Ex:100.00" disabled>
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