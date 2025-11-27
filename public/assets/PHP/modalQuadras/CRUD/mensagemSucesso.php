<?php 
    if (!$result) 
?>
 <div class="alert alert-warning alert dismissable fade show" role="alert">
    <p>Dado inserido com sucesso</p>
 </div>
        var_dump($stmt->errorInfo());
        exit;
    
    else {
        echo $stmt->rowCount() . "Linhas Inseridas";
    }            