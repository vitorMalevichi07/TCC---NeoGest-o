<div class="modal" id="modalBuscar">
            <div class="modal-inner">
                <div class="top-pop-up">
                    <h3>Informações da Quadra</h3>
                    <a href="#" id="closePopUpBuscar" ><i class="fa-solid fa-x"></i></a>
                </div>
            <form class="row g-3" action="Quadras.php" method="POST">
                <div class="col-md-6">
                    <label for="nomeQuadra" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="nomeQuadra" name="nomeQuadra">
                </div>
                <div class="col-md-6">
                    <label for="disponibilidadeQuadra" class="form-label">Disponibilidade</label>
                    <input type="text" class="form-control" id="disponibilidadeQuadra" name="disponibilidadeQuadra">
                </div>
                <div class="col-md-6">
                    <label for="modalidadeQuadra">Modalidade</label>
                    <select class="form-select" aria-label="Default select example">
                        <option id="opFutebolSociety" value="1">Futebol Society</option>
                        <option id="opFutsal" value="2">Futsal</option>
                        <option id="opVoleiPraia" value="3">Vôlei de Praia</option>
                        <option id="opBasquete" value="4">Basquete</option>
                        <option id="opTenis" value="5">Tênis</option>
                        <option id="opBeachTennis" value="6">Beach Tennis</option>
                        <option id="opHandebol" value="7">Handebol</option>
                        <option id="opPadel" value="8">Padel</option>
                        <option id="opPeteca" value="9">Peteca</option>
                        <option id="opBadminton" value="10">Badminton</option>
                        <option id="opHoqueiIndoor" value="11">Hóquei Indoor</option>
                        <option id="opFutebolAreia" value="12">Futebol de Areia</option>
                        <option id="opVoleiIndoor" value="13">Vôlei Indoor</option>
                        <option id="opBasquete3x3" value="14">Basquete 3x3</option>
                        <option id="opSquash" value="15">Squash</option>
                        <option id="opFutebolInfantil" value="16">Futebol Infantil</option>
                        <option id="opTenisMesa" value="17">Tênis de Mesa</option>
                        <option id="opPickleball" value="18">Pickleball</option>
                        <option id="opFutebolAmericanoFlag" value="19">Futebol Americano Flag</option>
                        <option id="opRugbyTouch" value="20">Rugby Touch</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="valorhrQuadra" class="form-label">Valor do Agendamento</label>
                    <input type="int" class="form-control" id="valoragendQuadra" name="valoragendQuadra">
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Buscar Quadra</button>
                </div>
                </form>
            </div>
        </div>
