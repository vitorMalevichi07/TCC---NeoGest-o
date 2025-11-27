<?php
$quadras = $pdo->query("SELECT id, descr FROM quadras")->fetchAll();
?>
<div class="modal fade" id="modalInfo" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <form class="row g-3" action="modalAgendamento/CRUD/processDelete.php" method="POST">
                <input type="hidden" id="inputIdInfo" name="id_agendamento" value="">
                <div class="modal-header">
                    <h5 class="modal-title">Informações do Agendamento</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <label for="nome_cliente" class="form-label">Nome</label>
                            <input type="text" name="nome_cliente_info" id="nome_cliente_info" class="form-control"
                                disabled>
                        </div>
                        <div class="col-md-6">
                            <label for="sobrenome_cliente" class="form-label">Sobrenome</label>
                            <input type="text" name="sobrenome_cliente_info" id="sobrenome_cliente_info"
                                class="form-control" disabled>
                        </div>
                    </div>
                    <div class="row g-4">
                        <div class="col-md-6">
                            <label for="quadra_cliente" class="form-label">Quadra</label>
                            <select name="quadra_cliente_info" id="quadra_cliente_info" class="form-select" disabled>
                                <?php
                                foreach ($quadras as $quadra):
                                    ?>
                                    <option value="<?= $quadra['id'] ?>"><?= $quadra['descr'] ?></option>
                                    <?php
                                endforeach;
                                ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-label">Data do Agendamento</label>
                            <input type="date" class="form-control" id="data_agendamento_info"
                                name="data_agendamento_info" disabled>
                        </div>
                        <div class="col-md-6">
                            <label for="horarioAgend" class="form-label">Horário Início</label>
                            <input type="time" class="form-control" id="horario_agendamento_info"
                                name="horario_agendamento_info" disabled>
                        </div>
                        <div class="col-md-6">
                            <label for="horarioFimAgend" class="form-label">Horário Fim</label>
                            <input type="time" class="form-control" id="horario_fim_agendamento_info"
                                name="horario_fim_agendamento_info" disabled>
                        </div>
                        <div class="col-md-6">
                            <label for="valorAgend" class="form-label">Valor</label>
                            <input type="number" class="form-control" id="valor_agendamento_info"
                                name="valor_agendamento_info" placeholder="R$ 00,00" step="0.01" min="0" disabled>
                        </div>
                        <div class="col-md-6">
                            <label for="estadoContaAgend" class="form-label">Estado da Conta</label>
                            <select name="estadoContaAgend_info" class="form-select" id="estadoContaAgend_info"
                                disabled>
                                <option value="1">Pendente</option>
                                <option value="2">Pago</option>
                                <option value="3">Cancelado</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="col-12">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal"
                            aria-label="Fechar">Confirmar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>