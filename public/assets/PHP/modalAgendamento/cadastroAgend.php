<?php
include_once __DIR__ . '/CRUD/createAgendamento.php';
?>
<div class="modal fade" id="modalCadastro" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <form class="row g-3" action="" method="POST">

                <div class="modal-header">
                    <h5 class="modal-title">Informações do Agendamento</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <label for="id_cliente" class="form-label">Cliente</label>
                            <select name="id_cliente" id="id_cliente" class="form-select">
                                <option value="">Selecione um cliente</option>
                                <?php
                                $stmtCli = $pdo->prepare("SELECT id, nome FROM clientes WHERE id_empresa = :id_empresa");
                                $stmtCli->execute([':id_empresa' => $id_empresa]);
                                $clientes = $stmtCli->fetchAll();
                                foreach ($clientes as $cliente) {
                                    echo "<option value='{$cliente['id']}'>{$cliente['nome']}</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="id_quadra" class="form-label">Quadra Agendada</label>
                            <select name="id_quadra" id="id_quadra" class="form-select">
                                <option value="">Selecione uma quadra</option>
                                <?php
                                $stmtQua = $pdo->prepare("SELECT id, descr FROM quadras WHERE id_empresa = :id_empresa AND disponibilidade > 0");
                                $stmtQua->execute([':id_empresa' => $id_empresa]);
                                $quadras = $stmtQua->fetchAll();
                                foreach ($quadras as $quadra) {
                                    echo "<option value='{$quadra['id']}'>{$quadra['descr']}</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="dataAgend" class="form-label">Data do Agendamento</label>
                            <input type="date" class="form-control" id="dataAgend" name="dataAgend">
                        </div>
                        <div class="col-md-4">
                            <label for="horarioAgend" class="form-label">Horário Início</label>
                            <input type="time" class="form-control" id="horarioAgend" name="horarioAgend">
                        </div>
                        <div class="col-md-4">
                            <label for="horarioFimAgend" class="form-label">Horário Fim</label>
                            <input type="time" class="form-control" id="horarioFimAgend" name="horarioFimAgend">
                        </div>
                        <div class="col-md-6">
                            <label for="valorAgend" class="form-label">Valor</label>
                            <input type="number" class="form-control" id="valorAgend" name="valorAgend"
                                placeholder="R$ 00,00" step="10" min="0">
                        </div>
                        <div class="col-md-6">
                            <label for="estadoContaAgend" class="form-label">Estado da Conta</label>
                            <select name="estadoContaAgend" aria-placeholder="selecione uma opção" class="form-select"
                                id="bosta" required>
                                <option value="estado_conta_agendamento" selected disabled>Selecione uma Opção</option>
                                <option value="1">Pendente</option>
                                <option value="2">Pago</option>
                                <option value="3">Cancelado</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="col-12">
                        <button type="submit" name="create_agendamento" class="btn btn-primary">Cadastrar Agendamento</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>