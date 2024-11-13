<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['avaliar'])) {
    $usuarioId = $_SESSION['usuario_id'] ?? null;
    if ($usuarioId && isset($_POST['estagio_id'], $_POST['nota'])) {
       
        $estagioId = $_POST['estagio_id'];
        $nota = $_POST['nota'];
        $comentario = $_POST['comentario'];

        try {
           
            $pdo = new PDO("sqlite:banco.db");
            $stmt = $pdo->prepare("INSERT INTO avaliacoes (estagio_id, usuario_id, nota, comentario) VALUES (:estagio_id, :usuario_id, :nota, :comentario)");
            $stmt->bindParam(':estagio_id', $estagioId, PDO::PARAM_INT);
            $stmt->bindParam(':usuario_id', $usuarioId, PDO::PARAM_INT);
            $stmt->bindParam(':nota', $nota, PDO::PARAM_INT);
            $stmt->bindParam(':comentario', $comentario, PDO::PARAM_STR);
            $stmt->execute();

            echo "<p class='notification is-success'>Avaliação enviada com sucesso!</p>";
        } catch (PDOException $e) {
            echo "<p class='notification is-danger'>Erro ao enviar avaliação: " . $e->getMessage() . "</p>";
        }
    }
} else {
    echo "<p class='notification is-danger'>Erro: Usuário não autenticado.</p>";
    exit();
}
?>
