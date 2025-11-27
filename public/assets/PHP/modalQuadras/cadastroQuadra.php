<div class="modal fade" id="modalCadastro" tabindex="-1" aria-labelledby="modalCadastroLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="modalCadastroLabel">Cadastro de Quadra</h3>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
      </div>
      <form action="" method="POST">
        <div class="modal-body mt-2 mb-4">
          <div class="row g-3">
            <div class="col-md-6">
              <label for="nomeQuadra" class="form-label">Quadra</label>
              <input type="text" class="form-control" id="descr" name="descr" placeholder="Nome da quadra">
            </div>
            <div class="col-md-6">
              <label for="disponibilidadeQuadra" class="form-label">Disponibilidade</label>
              <select class="form-select" id="disponibilidadeQuadra" name="disponibilidadeQuadra">
                <option selected disabled>Selecione a disponibilidade</option>
                <option value="1">Disponível</option>
                <option value="0">Indisponível</option>
              </select>
            </div>
            <div class="col-md-6">
              <label for="modalidadeQuadra" class="form-label">Modalidade</label>
              <select class="form-select" id="modalidadeQuadra" name="modalidadeQuadra">
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
              <label for="valorhrQuadra" class="form-label">Valor do Agendamento</label>
              <input type="number" class="form-control" id="valoragendQuadra" name="valoragendQuadra"
                placeholder="Ex: 100.00">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" name="create_quadra" class="btn btn-primary">Adicionar Quadra</button>
        </div>
      </form>
    </div>
  </div>
</div>