<div class="modal fade" id="modalEditar" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <form class="row g-3" action="" method="POST">
                <input type="hidden" id="inputIdEditar" name="id_quadra" value="">
                <div class="modal-header">
                    <h5 class="modal-title">Alterações da Quadra</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <label for="descr_quadra_edit" class="form-label">Quadra</label>
                            <input type="text" class="form-control" id="descr_quadra_edit" name="descr_quadra_edit"
                                placeholder="Quadra">
                        </div>
                        <div class="col-md-6">
                            <label for="disp_quadra_edit" class="form-label">Disponibilidade</label>
                            <select class="form-select" id="disp_quadra_edit" name="disp_quadra_edit">
                                <option selected disabled>Selecione a disponibilidade</option>
                                <option value="1">Disponível</option>
                                <option value="0">Indisponível</option>
                            </select>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="mod_quadra_edit" class="form-label">Modalidade</label>
                            <select name="mod_quadra_edit" id="mod_quadra_edit" class="form-select">
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
                            <label for="valor_quadra_edit" class="form-label">Valor do Agendamento</label>
                            <input type="number" min="0" class="form-control" id="valor_quadra_edit"
                                name="valor_quadra_edit" placeholder="Ex:100.00">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="col-12">
                        <button type="submit" name="edit_quadra" class="btn btn-primary">Salvar Alterações</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>