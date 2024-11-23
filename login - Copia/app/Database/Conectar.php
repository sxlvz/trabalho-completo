<?php
try {
    $banco = new PDO("sqlite:" . __DIR__ . "/../../banco.db"); 
    $banco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
} catch (PDOException $e) {
    die("Erro ao conectar ao banco: " . $e->getMessage());
}
?>
