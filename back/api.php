<?php
header('Content-Type: application/json');
include_once('conect.php');

    $conexao = pdo_connect_bd();
    $sql = "SELECT * FROM controle_usuario ORDER BY hSaida DESC";
    $query = $conexao->prepare($sql);
    $query->execute();
    $dados = $query->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($dados);