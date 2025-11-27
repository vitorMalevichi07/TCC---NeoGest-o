<?php
if (!isset($_SESSION['username'])) {
    header('Location: login.php?error=Você precisa fazer login para acessar esta página.');
    exit();
} 
include_once __DIR__ . '/../../conexao.php';

$usuario = $_SESSION['username'];
$id_empresa = buscarIdEmpresa($usuario);

try {
    $sql = "SELECT q.id, q.descr, q.disponibilidade, q.valor_hora, m.nome_modalidade 
            FROM quadras q 
            LEFT JOIN modalidades m ON q.id_modalidade = m.id 
            WHERE q.id_empresa = :id_empresa
            ORDER BY q.id";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':id_empresa' => $id_empresa));
    $quadras = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
} catch(PDOException $e) {
    echo "Erro: " . $e->getMessage();
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Quadras</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { border-collapse: collapse; width: 100%; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 12px; text-align: left; }
        th { background-color: #f2f2f2; }
        .btn { padding: 8px 12px; margin: 2px; text-decoration: none; border-radius: 4px; }
        .btn-edit { background-color: #4CAF50; color: white; }
        .btn-delete { background-color: #f44336; color: white; }
        .btn-new { background-color: #008CBA; color: white; margin-bottom: 20px; display: inline-block; }
        .status-disponivel { color: green; font-weight: bold; }
        .status-indisponivel { color: red; font-weight: bold; }
    </style>
</head>
<body>
    <h1>Gerenciamento de Quadras</h1>
    
    <a href="createQuadras.php" class="btn btn-new">+ Nova Quadra</a>
    
    <?php if (count($quadras) > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Descrição</th>
                    <th>Modalidade</th>
                    <th>Disponibilidade</th>
                    <th>Valor/Hora (R$)</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($quadras as $quadra): ?>
                    <tr>
                        <td><?= htmlspecialchars($quadra['id']) ?></td>
                        <td><?= htmlspecialchars($quadra['descr']) ?></td>
                        <td><?= htmlspecialchars($quadra['nome_modalidade'] ?? 'N/A') ?></td>
                        <td>
                            <span class="<?= $quadra['disponibilidade'] ? 'status-disponivel' : 'status-indisponivel' ?>">
                                <?= $quadra['disponibilidade'] ? 'Disponível' : 'Indisponível' ?>
                            </span>
                        </td>
                        <td>R$ <?= number_format($quadra['valor_hora'], 2, ',', '.') ?></td>
                        <td>
                            <a href="updateQuadras.php?id=<?= $quadra['id'] ?>" class="btn btn-edit">Editar</a>
                            <a href="deleteQuadras.php?id=<?= $quadra['id'] ?>" 
                               class="btn btn-delete" 
                               onclick="return confirm('Tem certeza que deseja excluir esta quadra?')">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Nenhuma quadra cadastrada ainda.</p>
    <?php endif; ?>
</body>
</html>