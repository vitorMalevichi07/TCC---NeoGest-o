<div class="modal" id="modalBuscar">
            <div class="modal-inner">
                <div class="top-pop-up">
                    <h3>Informações do Agendamento</h3>
                    <a href="#" id="closePopUpBuscar" ><i class="fa-solid fa-x"></i></a>
                </div>
            <form class="row g-3" action="Clientes.php" method="POST">
                <div class="col-md-6">
                    <label for="nomeCli" class="form-label">Nome Cliente</label>
                    <input type="text" class="form-control" id="nomeCli" name="nomeCli">
                </div>
                <div class="col-md-6">
                    <label for="sobrenomeCli" class="form-label">Quadra Agendada</label>
                    <input type="text" class="form-control" id="sobrenomeCli" name="sobrenomeCli">
                </div>
                <div class="col-md-4">
                    <label for="dataNascCli" class="form-label">Data do Agendamento</label>
                    <input type="date" class="form-control" id="dataNascCli" name="dataNascCli">
                </div>
                <div class="col-md-4">
                    <label for="horarioInicioAgend" class="form-label">Horário Inicio</label>
                    <input type="int" class="form-control" id="horarioInicioAgend" name="horarioInicioAgend">
                </div>
                <div class="col-md-4">
                    <label for="cpfCli" class="form-label">Horário Fim</label>
                    <input type="int" class="form-control" id="horarioFimAgend" name="horarioFimAgend">
                </div>
                <div class="col-md-6">
                    <label for="contatoCli" class="form-label">Valor</label>
                    <input type="int" class="form-control" id="contatoCli" name="contatoCli">
                </div>
                <div class="col-6">
                    <label for="emailC li" class="form-label"></label>
                    <input type="text" class="form-control" id="emailCli" name="emailCli" disabled>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Buscar Agendamento</button>
                </div>
                </form>
            </div>
        </div>
