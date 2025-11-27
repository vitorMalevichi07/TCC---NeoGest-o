<div class="modal fade" id="modalEditar" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <form class="row g-3" action="" method="POST">
                <input type="hidden" id="inputIdEditar" name="id_agendamento" value="">
                <div class="modal-header">
                    <h5 class="modal-title">Alterações do Agendamento</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <label for="cliente_agend_edit" class="form-label">Cliente</label>
                            <input type="text" class="form-control" id="cliente_agend_edit" name="cliente_agend_edit"
                                readonly placeholder="Nome" disabled>
                        </div>
                        <div class="col-md-6">
                            <label for="quadra_edit" class="form-label">Quadra Selecionada</label>
                            <select name="quadra_edit" id="quadra_edit" class="form-select" disabled>
                                <?php
                                foreach ($quadras as $quadra):
                                    ?>
                                    <?php
                                    $stmtQua = $pdo->prepare("SELECT id, descr FROM quadras WHERE id_empresa = :id_empresa");
                                    $stmtQua->execute([':id_empresa' => $id_empresa]);
                                    $quadras = $stmtQua->fetchAll();
                                    foreach ($quadras as $quadra) {
                                        echo "<option value='{$quadra['id']}'>{$quadra['descr']}</option>";
                                    }
                                    ?>
                                    <?php
                                endforeach;
                                ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="data_agendamento_edit" class="form-label">Data do Agendamento</label>
                            <input type="date" class="form-control" id="data_agendamento_edit"
                                name="data_agendamento_edit" readonly>
                        </div>
                        <div class="col-md-4">
                            <label for="horario_agend_edit" class="form-label">Horário Início</label>
                            <input type="time" class="form-control" id="horario_agend_edit" name="horario_agend_edit"
                                readonly>
                        </div>
                        <div class="col-md-4">
                            <label for="horario_fim_agend_edit" class="form-label">Horário Fim</label>
                            <input type="time" class="form-control" id="horario_fim_agend_edit"
                                name="horario_fim_agend_edit" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="valor_agend_edit" class="form-label">Valor</label>
                            <input type="number" class="form-control" id="valor_agend_edit" name="valor_agend_edit"
                                placeholder="R$ 00,00" step="0.01" min="0" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="estado_cont_agend_edit" class="form-label">Estado da Conta</label>
                            <select name="estado_cont_agend_edit" class="form-select" id="estado_cont_agend_edit">
                                <option value="1">Pendente</option>
                                <option value="2">Pago</option>
                                <option value="3">Cancelado</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="col-12">
                        <button type="submit" name="edit_agendamento" class="btn btn-primary">Salvar Alterações</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>