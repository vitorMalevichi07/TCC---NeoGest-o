<?php
    include_once 'conexao.php';
    include_once '../src/buscarIdEmpresa.php';
    session_start();
    include_once './modalFinanceiro/fluxoFinanceiro/CRUD/createFluxo.php';
    include_once './modalFinanceiro/fluxoFinanceiro/CRUD/proccesDelete.php';
    include_once './modalFinanceiro/fluxoFinanceiro/CRUD/proccesUpdate.php';

    $id_empresa = buscarIdEmpresa($_SESSION['username']);
    // Verifica se foi efetuado o login
    if(!isset($_SESSION['username'])){
        header("Location: login.php?error=Você precisa fazer login para acessar esta página.");
        exit;
    }

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/fluxoFinanceiro.css">
    <link rel="stylesheet" href="../components/mensagem.css">
    <link rel="stylesheet" href="../components/header.css">
    <link rel="stylesheet" href="../components/sidebar.css">
    <link rel="shortcut icon" href="../images/financeiro.png" type="image/x-icon">
    <link rel="stylesheet" href="../CSS/bootstrap.min.css">
    <link rel="stylesheet" href="../CSS/all.css">
    <title>Neo Gestão - Fluxo Financeiro</title>
</head>
<body>
    <div class="full-content">
        <?php require '../components/sidebar.php';?>
        <div id="main-content">
            <header><?php require '../components/header.php';?> </header> 
            <?php
            if (isset($_SESSION['message'])):
                $type = isset($_SESSION['message_type']) ? $_SESSION['message_type'] : 'info';
            ?>
            <div class="alert alert-<?= $type ?> alert-dismissible fade show alert-top-fixed" role="alert">
                <?= $_SESSION['message'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php
                unset($_SESSION['message']);
                unset($_SESSION['message_type']);
            endif;
            ?>
            <?php  include_once './modalFinanceiro/fluxoFinanceiro/cadastroFluxo.php';?>
            <?php  include_once './modalFinanceiro/fluxoFinanceiro/editarFluxo.php';?>
            <?php  include_once './modalFinanceiro/fluxoFinanceiro/excluirFluxo.php';?>
            <?php  include_once './modalFinanceiro/fluxoFinanceiro/infoFluxo.php';?> 
            <div class="container">
                <section class="top-area d-flex justify-content-between align-items-center p-1">
                        <div class="titulo">
                            <h3><strong>CONTROLE DE FLUXO FINANCEIRO</strong></h3>
                        </div>
                        <div class="adicionar gap-4 d-flex">
                            <button id='openPopUpCadastroTransacao' type="button" data-bs-toggle="modal" data-bs-target="#modalCadastroTransacao">+Adicionar Transação</button>
                        </div>
                </section>
                <div class="linha"></div>
                <div class="subtitle">
                    <h6>Valores Diários:</h6>
                </div>
                <!-- Cards de resumo -->
                <?php 
                $queryFluxo = $pdo->prepare("SELECT 
                    SUM(CASE WHEN tipo = 0 THEN valor ELSE 0 END) AS total_entrada,
                    SUM(CASE WHEN tipo = 1 THEN valor ELSE 0 END) AS total_saida,
                    SUM(CASE WHEN tipo = 0 THEN valor ELSE 0 END) - SUM(CASE WHEN tipo = 1 THEN valor ELSE 0 END) AS saldo
                    FROM fluxo_financeiro
                    WHERE id_empresa = :id_empresa
                    AND dt = CURDATE()");
                $queryFluxo->execute(['id_empresa' => $id_empresa]);
                $result = $queryFluxo->fetch(PDO::FETCH_ASSOC);
                ?>
                <div class="mid-area">
                    <div class="total primeiro">
                        <div class="grupo">
                            <h6>ENTRADA</h6>
                            <div class="main-total">
                                <h1><label for="totalContasPagar">R$ <?= number_format($result['total_entrada'], 2, ',', '.') ?></label></h1>
                                <div class="icone entrada">
                                    <i class="fas fa-arrow-up "></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="total segundo">
                        <div class="grupo">
                            <h6>SAÍDA</h6>
                            <div class="main-total">
                                <h1><label for="totalContasReceber">R$ <?= number_format($result['total_saida'], 2, ',', '.') ?></label></h1>
                                <div class="icone saida">
                                    <i class="fas fa-arrow-down "></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="total terceiro">
                        <div class="grupo">
                            <h6>SALDO</h6>
                            <div class="main-total">
                                <h1><label for="totalContasReceber">R$ <?= number_format($result['saldo'], 2, ',', '.') ?></label></h1>
                                <div class="icone saldo">
                                    <i class="fas fa-wallet"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="filters-section">
                    <h2><i class="fas fa-filter"></i> Filtros</h2>
                            <form action="" method="get">
                                <div class="filters mt-3">   
                                    <input type="text" name="descrFiltro" id="descrfiltro" placeholder="Buscar por Descrição">
                                    <select name="tipoFiltro" id="tipoFiltro">
                                        <option disabled selected>Tipo</option>
                                        <option value="0">Entrada</option>
                                        <option value="1">Saída</option>
                                    </select>
                                    <select name="categoriaFiltro" id="categoriaFiltro">
                                        <option aria-readonly="" value="" selected>Categoria</option>
                                        <option value="1">Venda</option>
                                        <option value="2">Serviço</option>
                                        <option value="3">Troca</option>
                                        <option value="4">Outros</option>
                                    </select>
                                    <input type="date" name="dataFiltro" id="dataFiltro" placeholder="Data">
                                    <div class="buttons">
                                        <a href="fluxoFinanceiro.php"><button type="button" class="btn">Limpar</button></a>
                                        <button type="submit" name="filtrarFluxo" class="btn">Buscar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <?php
                        $transacoes =[];
                        try {
                            /* paginação */
                            $itensPorPagina = 10;
                            $paginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
                            if ($paginaAtual < 1) $paginaAtual = 1;
                            $offset = ($paginaAtual - 1) * $itensPorPagina;

                            $stmtTotal = $pdo->prepare(
                            "SELECT COUNT(*) AS total
                            FROM fluxo_financeiro
                            WHERE id_empresa = :id_empresa
                            ");
                            $stmtTotal -> execute(array(":id_empresa" => $id_empresa));
                            $totalRegistros = $stmtTotal -> fetch(PDO::FETCH_ASSOC)['total'];
                            $totalPaginas = ceil($totalRegistros/$itensPorPagina);
                            
                            /* filtragem */
                            if (isset($_GET['filtrarFluxo'])){
                            $descricaoFiltro = $_GET['descrFiltro'] ?? '';
                            $categoriaFiltro = $_GET['categoriaFiltro'] ?? '';
                            $tipoFiltro = $_GET['tipoFiltro'];
                            $dataFiltro = $_GET['dataFiltro'] ?? '';

                            $stmt = "SELECT * FROM fluxo_financeiro WHERE id_empresa = :id_empresa";
                            $params = [':id_empresa' => $id_empresa];

                            if (!empty($descricaoFiltro)) {
                                $stmt .= " AND descr LIKE :descricao COLLATE utf8mb4_general_ci";
                                $params[':descricao'] = "%$descricaoFiltro%";
                            }

                            if (!empty($categoriaFiltro)) {
                                $stmt .= " AND categoria = :categoria";
                                $params[':categoria'] = $categoriaFiltro;
                            }

                            if (!empty($tipoFiltro)) {
                                $stmt .= " AND tipo = :tipo";
                                $params[':tipo'] = $tipoFiltro;
                            }

                            if (!empty($dataFiltro)) {
                                $stmt .= " AND DATE_FORMAT(dt, '%Y-%m-%d') = :dataFiltro";
                                $params[':dataFiltro'] = $dataFiltro;
                            }
                            $stmt .= ' ORDER BY dt ASC LIMIT :limit OFFSET :offset';

                            $query = $pdo->prepare($stmt);
                            unset($params[':limit'], $params[':offset']);
                            foreach ($params as $key => $value) {
                                $query->bindValue($key, $value);
                            }
                            $query->bindValue(':limit', $itensPorPagina, PDO::PARAM_INT);
                            $query->bindValue(':offset', $offset, PDO::PARAM_INT);
                            $query->execute();
                            $transacoes = $query ->fetchAll(PDO::FETCH_ASSOC);
                        }
                        else{
                            $query= $pdo ->prepare("SELECT * FROM fluxo_financeiro 
                            WHERE id_empresa = :id_empresa 
                            ORDER BY dt ASC LIMIT :limit OFFSET :offset
                            ");
                            $query->bindParam(':id_empresa', $id_empresa, PDO::PARAM_INT);
                            $query->bindValue(':limit', $itensPorPagina, PDO::PARAM_INT);
                            $query->bindValue(':offset', $offset, PDO::PARAM_INT);
                            $query ->execute();
                            $transacoes  = $query ->fetchAll(PDO::FETCH_ASSOC);
                        }
                        } catch ( PDOException $e) {
                            echo 'Erro ao tentar buscar dados'. $e->getMessage() ;
                        }
                        if (count($transacoes) == 0):
                        ?>
                            <div class='sem-transacao'>
                                <i class="fa-solid fa-credit-card fa-2xl"></i>
                                <h2>Nenhuma Transação Cadastrada</h2>
                                <small>Adicione sua primeira Transação</small>
                            </div>
                        <?php
                        else:
                        ?>
                        <div class="table-responsive mt-4">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr class="text-align-center text-center">
                                        <th>Descrição</th>
                                        <th>Tipo</th>
                                        <th>Categoria</th>
                                        <th>Data</th>
                                        <th>Valor</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <?php foreach ($transacoes as $transacao):?>
                                <tbody>
                                    <tr class="text-center text-align-center">
                                        <td><label for="<?=$transacao['id']?>"><?=$transacao['descr']?></label></td>
                                        <?php
                                        if($transacao['tipo'] == 0):?>
                                            <td> <div class="entrada-table">Entrada</div></td> 
                                        
                                        <?php else: ?> 
                                            <td> <div class="saida-table">Saída</div></td>
                                        
                                        <?php endif?>
                                        <td><?php 
                                        if($transacao['categoria'] == 1){
                                            echo 'Venda';
                                        }
                                        elseif($transacao['categoria'] == 2){
                                            echo 'Serviço';
                                        }
                                        elseif($transacao['categoria'] == 3){
                                            echo 'Troca';
                                        }
                                        else{
                                            echo 'Outros';
                                        }
                                        ?></td>
                                        <td><?= date('d/m/Y', strtotime($transacao['dt']))?></td>
                                        <td>R$ <?= number_format($transacao['valor'], 2, ',', '.') ?></td>
                                        <td>
                                            <button data-bs-toggle="modal" data-bs-target="#modalEditar" 
                                            data-id="<?= $transacao['id']; ?>"class="btn btn-primary btn-sm">
                                            <i class='fa-solid fa-pen-to-square first'></i></button>

                                            <!-- botão de Excluir -->
                                            <button data-bs-toggle="modal" data-bs-target="#modalExcluir"
                                            data-id="<?= $transacao['id']; ?>" class="btn btn-danger btn-sm">
                                            <i class='fa-solid fa-trash second'></i></button>

                                            <!-- botão de Info -->
                                            <button data-bs-toggle="modal" data-bs-target="#modalInfo"
                                            data-id="<?= $transacao['id']; ?>" class="btn btn-secondary btn-sm">
                                            <i class='fa-solid fa-info-circle third'></i></button>
                                        </td>
                                    </tr>
                                </tbody>
                                <?php endforeach;?>
                                <tfoot>
                                    <tr class="ms-2">
                                        <td colspan="12" class="">
                                            <nav aria-label="Navegação de página">
                                                <ul class="pagination d-flex justify-content-between">
                                                    <li class="page-item disabled">
                                                        <span class="page-link">Página:</span>
                                                    </li>
                                                    <div class="paginacao-info d-flex">
                                                        <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
                                                        <li class="page-item <?= ($i == $paginaAtual) ? 'active' : '' ?>">
                                                            <a class="page-link" href="?pagina=<?= $i ?>"><?= $i ?></a>
                                                        </li>
                                                        <?php endfor; ?>
                                                    </div>
                                                </ul>
                                            </nav>  
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    <?php endif ?>
                    </div>
                </div>
            </div>
        <script src="modalFinanceiro/fluxoFinanceiro/CRUD/updateFluxo.js"></script>
        <script src="modalFinanceiro/fluxoFinanceiro/CRUD/deleteFluxo.js"></script>
        <script src="modalFinanceiro/fluxoFinanceiro/CRUD/infoFluxo.js"></script>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <script src="../components/sidebar.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>
</html>