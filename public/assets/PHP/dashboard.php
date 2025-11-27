<?php
include_once 'conexao.php';
include_once '../src/buscarIdEmpresa.php';
session_start();
$id_empresa = buscarIdEmpresa($_SESSION['username']);
// Verifica se foi efetuado o login
if (!isset($_SESSION['username'])) {
    header("Location: login.php?error=Você precisa fazer login para acessar esta página.");
    exit;
}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/dashboard.css">
    <link rel="stylesheet" href="../components/header.css">
    <link rel="stylesheet" href="../components/sidebar.css">
    <link rel="shortcut icon" href="../images/financeiro.png" type="image/x-icon">
    <link rel="stylesheet" href="../CSS/bootstrap.min.css">
    <link rel="stylesheet" href="../CSS/all.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Neo Gestão</title>
</head>

<body>
    <script> localStorage.setItem('activeItem', 'dashboard');</script>

    <?php
    /* card quadras */
    try {
        $quadras = $pdo->prepare(
            "SELECT
        COUNT(*) AS total_quadras
        FROM
        quadras
        WHERE 
        disponibilidade = 1
        AND
        id_empresa = :id_empresa
        "
        );
        $quadras->bindParam(':id_empresa', $id_empresa);
        $quadras->execute();
        $result_quadras = $quadras->fetchAll(PDO::FETCH_ASSOC);

        $total_quadras = [];
        foreach ($result_quadras as $quadra) {
            $total_quadras[] = $quadra['total_quadras'];
        }
    } catch (PDOException $e) {
        echo 'erro' . $e;
    }

    /* card agendamentos */
    try {
        $agendamentos = $pdo->prepare(
            "SELECT
        COUNT(*) AS total_agendamentos
        FROM 
        agendamentos
        WHERE 
        horario_agendado >= CURRENT_TIME()
        AND
        dt = CURRENT_DATE()
        AND
        id_empresa = :id_empresa
        "
        );

        $agendamentos->execute(array(':id_empresa' => $id_empresa));
        $result_agendamentos = $agendamentos->fetchAll(PDO::FETCH_ASSOC);
        $total_agendamentos = [];
        foreach ($result_agendamentos as $agendamento) {
            $total_agendamentos[] = $agendamento['total_agendamentos'];
        }
    } catch (PDOException $e) {
        echo 'error' . $e;
    }

    /* contas a pagar e receber */
    try {
        $queryContas = $pdo->prepare("SELECT 
                SUM(CASE WHEN categoria = 1 THEN valor ELSE 0 END) AS  total_contas_receber,
                SUM(CASE WHEN categoria = 0 THEN valor ELSE 0 END) AS total_contas_pagar
                FROM contas
                WHERE id_empresa = :id_empresa
                AND data_vencimento = CURDATE()");
        $queryContas->execute(['id_empresa' => $id_empresa]);
        $resultContas = $queryContas->fetch(PDO::FETCH_ASSOC);
    } catch (\Throwable $e) {
        echo 'erro' . $e;
    }

    /* card proximos horarios */
    try {
        $horarios = $pdo->prepare(
            "SELECT
        q.descr AS nome_quadra,
        DATE_FORMAT(a.horario_agendado, '%H:%i') AS horario_agendado
        
        FROM 
        agendamentos a

        JOIN
        quadras q ON a.id_quadra = q.id

        WHERE
        a.horario_agendado >= CURRENT_TIME()
        AND
        a.dt = CURRENT_DATE()
        AND
        a.id_empresa = :id_empresa

        ORDER BY
        a.horario_agendado
        ASC
        "
        );

        $horarios->execute(array(':id_empresa' => $id_empresa));

        $result_horarios = $horarios->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $e) {
        die('erro' . $e);
    }




    /*clientes cadastrado nos ultimos 6 meses para o gráfico */
    try {
        $clientes = $pdo->prepare(

            "SELECT 
        DATE_FORMAT(data_cadastro, '%m - %Y') AS mes_ano,
        COUNT(*) AS total_clientes

        FROM 
        clientes

        WHERE 
        data_cadastro BETWEEN DATE_SUB(NOW(), INTERVAL 6 MONTH) AND NOW()
        AND
        id_empresa = :id_empresa

        GROUP BY
        mes_ano

        ORDER BY
        mes_ano"
        );
    }
    /* caso não consiga fazer a consulta */ catch (PDOException $e) {
        echo 'erro' . $e;
    }

    /* passando para um vetor, para usar no gráfico */
    $clientes->bindParam(':id_empresa', $id_empresa);
    $clientes->execute();
    $result = $clientes->fetchAll(PDO::FETCH_ASSOC);

    $mes_ano = [];
    $total_clientes = [];

    foreach ($result as $row) {
        $mes_ano[] = $row['mes_ano'];
        $total_clientes[] = $row['total_clientes'];
    }


    /* gráfico de faturamento */
    try {
        $faturamento = $pdo->prepare(
            "SELECT 
        DATE_FORMAT(dt, '%m - %Y') AS mes_ano,
        SUM(valor) AS total_faturamento
        FROM fluxo_financeiro
        WHERE tipo = 0
        AND dt BETWEEN DATE_SUB(NOW(), INTERVAL 12 MONTH) AND NOW()
        AND id_empresa = :id_empresa
        GROUP BY mes_ano
        ORDER BY mes_ano ASC"
        );
        $faturamento->bindParam(':id_empresa', $id_empresa);
        $faturamento->execute();
        $result_faturamento = $faturamento->fetchAll(PDO::FETCH_ASSOC);

        $mes_ano_faturamento = [];
        $total_faturamento = [];
        foreach ($result_faturamento as $row) {
            $mes_ano_faturamento[] = $row['mes_ano'];
            $total_faturamento[] = $row['total_faturamento'];
        }
    } catch (PDOException $e) {
        echo 'erro' . $e;
    }
    ?>
    <div class="full-content">
        <?php require '../components/sidebar.php'; ?>
        <div id="main-content">
            <header><?php require '../components/header.php'; ?> </header>
            <div class="container">

                <div class="title">
                    <h2>Bem-Vindo, <label for="nomeEmpresa"><?= $_SESSION['username']; ?></label></h2>
                    <div class="data">
                        <i class="fa-solid fa-calendar"></i>
                        <h4><?= date('d/m/Y') ?></h4>
                    </div>
                </div>

                <div class="divisao"></div>
                <div class="subtitle">
                    <h6>DASHBOARD</h6>
                </div>

                <!-- cards -->

                <div class="cards">
                    <!-- card 1 -->
                    <div class="card-1">
                        <div class="icone-1">
                            <i class="fa-solid fa-gears fa-2xl"></i>
                        </div>
                        <div class="text">
                            <h5>Quadras Funcionando:</h5>
                            <h4><label for="quadrasFuncionando"><?= $total_quadras[0]; ?> </label></h4>
                        </div>
                        <div class="bottom-card">
                            <a href="Quadras.php">
                                <p>VER POR COMPLETO</p><i class="fa-solid fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                    <!-- card 2 -->
                    <div class="card-2">
                        <div class="icone-2">
                            <i class="fa-solid fa-calendar fa-2xl"></i>
                        </div>

                        <div class="text">
                            <h5>Horários Agendados</h5>
                            <h4><label for="agendamentosDiario"><?= $total_agendamentos[0]; ?></label></h4>
                        </div>

                        <div class="bottom-card">
                            <a href="Agendamentos.php">
                                <p>VER POR COMPLETO</p><i class="fa-solid fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                    <!-- card3 -->
                    <div class="card-3">
                        <div class="icone-3">
                            <i class="fa-solid fa-cart-shopping fa-2xl"></i>
                        </div>

                        <div class="text">
                            <h5>Contas a Receber</h5>
                            <h4><label>
                                    R$<?= number_format($resultContas['total_contas_receber'], 2, ',', '.') ?></label>
                            </h4>
                        </div>

                        <div class="bottom-card">
                            <a href="ListagemContas.php">
                                <p>VER POR COMPLETO</p><i class="fa-solid fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                    <!-- card 4 -->
                    <div class="card-4">
                        <div class="icone-4">
                            <i class="fa-solid fa-file-invoice-dollar fa-2xl"></i>
                        </div>

                        <div class="text">
                            <h5>Contas a Pagar</h5>
                            <h4><label>R$<?= number_format($resultContas['total_contas_pagar'], 2, ',', '.') ?></label>
                            </h4>
                        </div>

                        <div class="bottom-card">
                            <a href="ListagemContas.php">
                                <p>VER POR COMPLETO</p><i class="fa-solid fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- gráficos -->
                <div class="graficos">
                    <div class="grafico-clientes">
                        <canvas id="grafico-clientes"></canvas>
                    </div>
                    <div class="grafico-contas-a-receber">
                        <canvas id="grafico-contas-a-receber"></canvas>
                    </div>
                </div>

                <!-- relatorios -->
                <?php
                $queryAgendamentos = $pdo->prepare(
                    "SELECT * 
            FROM agendamentos 
            WHERE estado_conta != '3'
            AND dt = CURRENT_DATE()
            AND horario_agendado >= CURRENT_TIME()
            AND id_empresa = :id_empresa"
                );

                $queryAgendamentos->execute(array(':id_empresa' => $id_empresa));
                $queryTodosAgendamentos = $queryAgendamentos->fetchAll(PDO::FETCH_ASSOC);

                if (count($queryTodosAgendamentos) == 0):
                    ?>
                    <div class="sem-agendamento">
                        <i class="fa-solid fa-calendar fa-xl"></i>
                        <h2>NENHUM AGENDAMENTO ENCONTRADO HOJE</h2>
                        <div class="bottom-text-sem-agendamento">
                            <a href="Agendamentos.php"><small>Cadastre um agendamento <i
                                        class="fa-solid fa-arrow-right fa-2xs"></i></small></a>
                        </div>
                    </div>
                    <?php
                else:
                    ?>
                    <div class="agenda">
                        <div class="quadras-lista">
                            <h4>PRÓXIMOS AGENDAMENTOS:</h4>
                            <div class="main-text">
                                <div class="relogio">
                                    <i class="fa-solid fa-clock fa-2xl"></i>
                                </div>

                                <?php
                                $limit = 4;
                                $contador = 0;
                                foreach ($result_horarios as $horario):
                                    if ($contador >= $limit) {
                                        break;
                                    }
                                    ?>
                                    <div class="horarios">
                                        <div class="lista-horarios">
                                            <h5><label>Quadra: <?= $horario['nome_quadra'] ?></label></h5>
                                            <span><label>Horário: <?= $horario['horario_agendado'] ?>h</label></span>
                                        </div>
                                    </div>
                                    <?php
                                    $contador++;
                                endforeach ?>
                            </div>

                        </div>
                        <div class="bottom-horario">
                            <a href="Agendamentos.php"><span>VER POR COMPLETO</span><i
                                    class="fa-solid fa-arrow-right"></i></a>
                        </div>
                    </div>
                    <?php
                endif;
                ?>
            </div>

            <!-- end main -->
        </div>


        <script>

            /* função para pegar os últimos 6 meses */
            function seisMeses() {

                const hoje = new Date();
                const ultimosMeses = [];

                for (let i = 0; i < 6; i++) {
                    const mes = new Date(hoje);

                    mes.setMonth(hoje.getMonth() - i);

                    ultimosMeses.push(mes.toLocaleString('default', { month: 'long' }));
                }
                return ultimosMeses.reverse();
            }

            /* gráfico clientes */
            const mes_ano = <?php echo json_encode($mes_ano); ?>;
            const total_clientes = <?php echo json_encode($total_clientes); ?>;

            const ctx1 = document.getElementById('grafico-clientes');
            const grafico1 = new Chart(ctx1, {
                type: 'line',
                data: {
                    labels: mes_ano,
                    datasets: [{
                        label: 'Novos Clientes',
                        data: total_clientes,
                        backgroundColor: ['rgb(221, 187, 33)'],
                        borderColor: ['rgba(5, 62, 97, 0.733)'],
                        borderWidth: 1
                    }]
                },
                options: {
                    animations: {
                        tension: {
                            duration: 9000,
                            easing: 'easeInQuad',
                            from: 0.1,
                            to: 0.4,
                            loop: true
                        }
                    },
                    scales: {
                        y: {
                            min: 0,
                            max: 70
                        }
                    }
                }
            });

            const mes_ano_faturamento = <?php echo json_encode($mes_ano_faturamento); ?>;
            const total_faturamento = <?php echo json_encode($total_faturamento); ?>;
            /* grafico contas a receber */
            const ctx2 = document.getElementById('grafico-contas-a-receber').getContext('2d');
            const grafico2 = new Chart(ctx2, {
                type: 'bar',
                data: {
                    labels: mes_ano_faturamento,
                    datasets: [{
                        label: 'Faturamento (R$)',
                        data: total_faturamento,
                        backgroundColor: [
                            'rgba(221, 187, 33, 0.56)',
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: { display: true }
                    },
                    scales: {
                        y: { beginAtZero: true }
                    }
                }
            });
        </script>
        <script src="../components/sidebar.js"></script>
</body>

</html>