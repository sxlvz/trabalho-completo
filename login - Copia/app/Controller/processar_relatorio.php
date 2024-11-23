<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['criar_relatorio'])) {
    $usuarioId = $_SESSION['usuario_id'] ?? null;
    if ($usuarioId && isset($_POST['estagio_id'], $_POST['relatorio'])) {
        
        $estagioId = $_POST['estagio_id'];
        $relatorio = $_POST['relatorio'];

        try {
            // Conecta ao banco de dados e insere o relatório
            $pdo = new PDO("sqlite:banco.db");
            $stmt = $pdo->prepare("INSERT INTO relatorios (estagio_id, usuario_id, relatorio) VALUES (:estagio_id, :usuario_id, :relatorio)");
            $stmt->bindParam(':estagio_id', $estagioId, PDO::PARAM_INT);
            $stmt->bindParam(':usuario_id', $usuarioId, PDO::PARAM_INT);
            $stmt->bindParam(':relatorio', $relatorio, PDO::PARAM_STR);
            $stmt->execute();

            echo "<p class='notification is-success'>Relatório enviado com sucesso!</p>";
        } catch (PDOException $e) {
            echo "<p class='notification is-danger'>Erro ao enviar relatório: " . $e->getMessage() . "</p>";
        }
    }
} else {
    echo "<p class='notification is-danger'>Erro: Usuário não autenticado.</p>";
    exit();
}
?>
