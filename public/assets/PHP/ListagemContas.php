<?php
    include_once 'conexao.php';
    include_once '../src/buscarIdEmpresa.php';
    session_start();
    include_once './modalFinanceiro/listagemContas/CRUD/createContas.php';
    include_once './modalFinanceiro/listagemContas/CRUD/proccesDelete.php';
    include_once './modalFinanceiro/listagemContas/CRUD/proccesUpdate.php';
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
    <link rel="stylesheet" href="../CSS/listagemContas.css">
    <link rel="stylesheet" href="../components/mensagem.css">
    <link rel="stylesheet" href="../components/header.css">
    <link rel="stylesheet" href="../components/sidebar.css">
    <link rel="shortcut icon" href="../images/financeiro.png" type="image/x-icon">
    <link rel="stylesheet" href="../CSS/bootstrap.min.css">
    <link rel="stylesheet" href="../CSS/all.css">
    <title>Neo Gestão - Listagem Contas</title>
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
            <?php include_once './modalFinanceiro/listagemContas/cadastroConta.php';?>
            <?php include_once './modalFinanceiro/listagemContas/editarConta.php';?>
            <?php include_once './modalFinanceiro/listagemContas/excluirConta.php';?>
            <?php include_once './modalFinanceiro/listagemContas/infoConta.php';?>
            
            <div class="container">
                <section class="top-area d-flex justify-content-between align-items-center">
                        <div class="titulo">
                            <h3><strong>LISTAGEM DE CONTAS</strong></h3>
                        </div>
                        <div class="adicionar gap-4">
                            <button id='openPopUpCadastroConta'  type="button" data-bs-toggle="modal" data-bs-target="#modalCadastro">+ Adicionar Conta</button>
                        </div>
                </section>
                <?php 
                /* Total de contas a pagar */
                $contasPagar = $pdo->prepare("SELECT COUNT(*) FROM contas WHERE categoria = 0 AND id_empresa = :id_empresa");
                $contasPagar->bindParam(':id_empresa', $id_empresa, PDO::PARAM_INT);
                $contasPagar->execute();
                $totalContasPagar = $contasPagar->fetchColumn();

                /* Total de contas a receber */
                $contasReceber = $pdo->prepare("SELECT COUNT(*) FROM contas WHERE categoria = 1 AND id_empresa = :id_empresa");
                $contasReceber->bindParam(':id_empresa', $id_empresa, PDO::PARAM_INT);
                $contasReceber->execute();
                $totalContasReceber = $contasReceber->fetchColumn();

                /* Valor total contas a pagar */
                $valorPagar = $pdo->prepare("SELECT SUM(valor) FROM contas WHERE categoria = 0 AND id_empresa = :id_empresa");
                $valorPagar->bindParam(':id_empresa', $id_empresa, PDO::PARAM_INT);
                $valorPagar->execute();
                $valorTotalPagar = $valorPagar->fetchColumn();

                /* Valor total contas a receber */
                $valorReceber = $pdo->prepare("SELECT SUM(valor) FROM contas WHERE categoria = 1 AND id_empresa = :id_empresa");
                $valorReceber->bindParam(':id_empresa', $id_empresa, PDO::PARAM_INT);
                $valorReceber->execute();
                $valorTotalReceber = $valorReceber->fetchColumn();
                
                ?>
                <div class="mid-area">
                    <div class="total-contas-pagar">
                        <div class="grupo">
                            <h6>TOTAL DE CONTAS A PAGAR</h6>
                            <div class="main-total-contas-pagar">
                                <h1><label for="totalContasPagar"><?= $totalContasPagar; ?></label></h1>
                                <div class="icone-total-pagar">
                                    <i class="fa-solid fa-receipt"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="valor-contas-pagar">
                        <div class="grupo">
                            <h6>VALOR CONTAS A PAGAR</h6>
                            <div class="main-valor-contas-pagar">
                                <h1><label for="valorTotalContasPagar">R$ <?= number_format($valorTotalPagar, 2, ',', '.'); ?></label></h1>
                                <div class="icone-valor-pagar">
                                    <i class="fa-solid fa-dollar-sign"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="total-contas-receber">
                        <div class="grupo">
                            <h6>TOTAL DE CONTAS A RECEBER</h6>
                            <div class="main-total-contas-receber">
                                <h1><label for="totalContasReceber"><?= $totalContasReceber; ?></label></h1>
                                <div class="icone-total-receber">
                                    <i class="fa-solid fa-receipt"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="valor-contas-receber">
                        <div class="grupo">
                            <h6>VALOR CONTAS A RECEBER</h6>
                            <div class="main-valor-contas-receber">
                                <h1><label for="valorTotalContasReceber">R$ <?= number_format($valorTotalReceber, 2, ',', '.'); ?></label></h1>
                                <div class="icone-valor-receber">
                                    <i class="fa-solid fa-dollar-sign"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="filters-section mb-4">
                    <h2><i class="fas fa-filter"></i> Filtros</h2>
                    <form method="GET" action="ListagemContas.php" id="form-buscar">
                        <div class="filters mt-3">   

                            <input type="text" name="filtro_descricao" id="filtro_descricao" placeholder="Buscar por Descrição">

                            <select name="filtro_categoria" id="filtro_categoria">
                                <option aria-readonly="" value="" selected> Categoria</option>
                                <option value="0">Pagar</option>
                                <option value="1">Receber</option>
                            </select>

                            <select name="filtro_tipo" id="filtro_tipo">
                                <option aria-readonly="" value="" selected> Tipo</option>
                                <option value="1">Fornecedor</option>
                                <option value="2">Funcionário</option>
                                <option value="3">Cliente</option>
                                <option value="4">Gasto Fixo</option>
                                <option value="5">Outros</option>
                            </select>

                            <input type="date" name="filtro_data" id="filtro_data">

                            <div class="buttons">
                                <a href="ListagemContas.php"><button type="button" class="btn">Limpar</button></a>
                                <button type="submit" name="filtrar" class="btn">Buscar</button>
                            </div>

                        </div>
                    </form>
                </div>
                <?php
                $contas = [];
                try {
                    /* paginação */
                    $itensPorPagina = 10;
                    $paginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
                    if ($paginaAtual < 1) $paginaAtual = 1;
                    $offset = ($paginaAtual - 1) * $itensPorPagina;

                    $stmtTotal = $pdo->prepare(
                    "SELECT COUNT(*) AS total
                    FROM contas
                    WHERE id_empresa = :id_empresa
                    ");
                    $stmtTotal -> execute(array(":id_empresa" => $id_empresa));
                    $totalRegistros = $stmtTotal -> fetch(PDO::FETCH_ASSOC)['total'];
                    $totalPaginas = ceil($totalRegistros/$itensPorPagina);
                    
                    
                    /* filtragem */
                    if (isset($_GET['filtrar'])){
                    $descricao = $_GET['filtro_descricao'] ?? '';
                    $categoria = $_GET['filtro_categoria'] ?? '';
                    $tipo = $_GET['filtro_tipo'] ?? '';
                    $dataFiltro = $_GET['filtro_data'] ?? '';

                    $stmt = "SELECT * FROM contas WHERE id_empresa = :id_empresa";
                    $params = [':id_empresa' => $id_empresa];

                    if (!empty($descricao)) {
                        $stmt .= " AND descricao LIKE :descricao COLLATE utf8mb4_general_ci";
                        $params[':descricao'] = "%$descricao%";
                    }

                    if (!empty($categoria)) {
                        $stmt .= " AND categoria = :categoria";
                        $params[':categoria'] = $categoria;
                    }

                    if (!empty($tipo)) {
                        $stmt .= " AND tipo = :tipo";
                        $params[':tipo'] = $tipo;
                    }

                    if (!empty($dataFiltro)) {
                        $stmt .= " AND DATE_FORMAT(data_vencimento, '%Y-%m-%d') = :dataFiltro";
                        $params[':dataFiltro'] = $dataFiltro;
                    }
                    $stmt .= ' ORDER BY data_vencimento ASC LIMIT :limit OFFSET :offset';

                    $query = $pdo->prepare($stmt);
                    unset($params[':limit'], $params[':offset']);
                    foreach ($params as $key => $value) {
                        $query->bindValue($key, $value);
                    }
                    $query->bindValue(':limit', $itensPorPagina, PDO::PARAM_INT);
                    $query->bindValue(':offset', $offset, PDO::PARAM_INT);
                    $query->execute();
                    $contas  = $query ->fetchAll(PDO::FETCH_ASSOC);
                }
                else{
                    $query= $pdo ->prepare("SELECT * FROM contas 
                    WHERE id_empresa = :id_empresa 
                    ORDER BY data_vencimento ASC LIMIT :limit OFFSET :offset");

                    $query->bindParam(':id_empresa', $id_empresa, PDO::PARAM_INT);
                    $query->bindValue(':limit', $itensPorPagina, PDO::PARAM_INT);
                    $query->bindValue(':offset', $offset, PDO::PARAM_INT);
                    $query ->execute();
                    $contas  = $query ->fetchAll(PDO::FETCH_ASSOC);
                }

                } catch (PDOException $e) {
                    echo 'Erro ao buscar dados no b.d' . $e->getMessage();
                }
                if (count($contas) == 0):
                ?>
                    <div class='sem-conta'>
                        <i class="fa-solid fa-bag-shopping fa-2xl"></i>
                        <h2>Nenhuma conta cadastrada</h2>
                        <small>Adicione sua primeira conta</small>
                    </div>
                <?php
                else:
                ?>
                <div class="table-reponsive">
                    <table class="table table-striped table-hover">
                        <thead class="">
                            <tr class="text-align-center text-center">
                                <th>Descrição</th>
                                <th>Valor</th>
                                <th>Tipo</th>
                                <th>Categoria</th>
                                <th>Recorrência</th>
                                <th>Vencimento</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <?php 
                        /* if ($contas['tipo_conta']== 0) */ 
                        foreach($contas as $conta):
                        ?>
                        <tbody>
                            <tr class="text-center text-align-center">
                                <td><label for="<?= $conta['id']?>"><?= $conta['descricao']?></label></td>
                                <td>R$ <?= number_format($conta['valor'], 2, ',', '.') ?></td>

                                <td><?php if ($conta['tipo'] == 1){
                                    echo "Fornecedor";
                                }
                                else if ($conta['tipo'] == 2){
                                    echo "Funcionário";
                                }
                                else if ($conta['tipo'] == 3){
                                    echo "Cliente";
                                }
                                else if ($conta['tipo'] == 4){
                                    echo "Gasto Fixo";
                                }
                                else if ($conta['tipo'] == 5){
                                    echo "Outros";
                                }
                                else{
                                    echo "Não definido";
                                }?></td>

                                <?php if($conta['categoria'] == 0): ?>
                                    <td> <div class="pagar"><?= 'Pagar' ?></div> </td>

                                 <?php elseif ($conta['categoria'] == 1): ?>
                                    <td> <div class="receber"><?= 'Receber' ?></div> </td>

                                <?php else: ?>
                                    <td> <div class="nao-definido"><?= 'Não definido' ?></div> </td>
                                <?php endif; ?>

                                <td><?php if($conta['recorrencia'] == 0){
                                    echo "Única";
                                } else if($conta['recorrencia'] == 1){
                                    echo "Semanal";
                                } else if($conta['recorrencia'] == 2){
                                    echo "15 dias";
                                } else if($conta['recorrencia'] == 3){
                                    echo "Mensal";
                                } else if($conta['recorrencia'] == 4){
                                    echo "Anual";
                                }?></td>
                                <td><?= date('d/m/Y', strtotime($conta['data_vencimento'])) ?></td>
                                <td>
                                    <!-- botão de Editar -->
                                    <button data-bs-toggle="modal" data-bs-target="#modalEditar" 
                                    data-id="<?= $conta['id']; ?>"class="btn btn-primary btn-sm">
                                    <i class='fa-solid fa-pen-to-square first'></i></button>

                                    <!-- botão de Excluir -->
                                    <button data-bs-toggle="modal" data-bs-target="#modalExcluir"
                                    data-id="<?= $conta['id']; ?>" class="btn btn-danger btn-sm">
                                    <i class='fa-solid fa-trash second'></i></button>

                                    <!-- botão de Info -->
                                    <button data-bs-toggle="modal" data-bs-target="#modalInfo"
                                    data-id="<?= $conta['id']; ?>" class="btn btn-secondary btn-sm">
                                    <i class='fa-solid fa-info-circle third'></i></button>
                                </td>
                            </tr>
                        </tbody>
                        <?php 
                        endforeach;
                        ?>
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
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="modalFinanceiro/listagemContas/CRUD/updateContas.js"></script>
    <script src="modalFinanceiro/listagemContas/CRUD/deleteContas.js"></script>
    <script src="modalFinanceiro/listagemContas/CRUD/infoContas.js"></script>
    <script src="../components/sidebar.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>
</html>