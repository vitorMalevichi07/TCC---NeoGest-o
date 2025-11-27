<?php
$idEmpresa = buscarIdEmpresa($_SESSION['username']);
$buscaNomeEmpresa = $pdo->prepare('SELECT razão_social
  FROM
  empresa
  WHERE
  id = :idEmpresa
  ');
$buscaNomeEmpresa->execute(array(
  ':idEmpresa' => $idEmpresa
));
$empresa = $buscaNomeEmpresa->fetch(PDO::FETCH_ASSOC)
  ?>
<div id="header">
  <div id="logo">
    <a href="../PHP/dashboard.php"><img src="../images/financeiro.png" alt="logo_empresa"></a>
    <h2 id="title-sidebar">NEO GESTÃO</h2>
  </div>
  <div id="user-info">
    <h2 id="usuario"><label
        for="empresa"><?= isset($empresa['razão_social']) ? htmlspecialchars($empresa['razão_social']) : 'Empresa não encontrada' ?></label>
    </h2>
  </div>
</div>