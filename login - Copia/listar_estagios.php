<?php 
include 'header.php';
session_start();
require_once __DIR__ . "/app/model/Estagiobanco.php";
$Estagiobanco = new Estagiosbanco();

$usuarioId = $_SESSION['usuario_id'] ?? null;

if ($usuarioId) {
    $estagios = $Estagiobanco->listarestagios($usuarioId);

    if (isset($_GET['excluir_id'])) {
        $excluirId = $_GET['excluir_id'];

        try {
            $pdo = new PDO("sqlite:banco.db");
            $stmt = $pdo->prepare("DELETE FROM estagios WHERE id = :id");
            $stmt->bindParam(':id', $excluirId, PDO::PARAM_INT);
            $stmt->execute();

            $stmt = $pdo->prepare("DELETE FROM user_est WHERE estagio_id = :id");
            $stmt->bindParam(':id', $excluirId, PDO::PARAM_INT);
            $stmt->execute();

            header("Location: listar_estagios.php?message=excluido");
            exit;
        } catch (PDOException $e) {
            echo "<div class='notification is-danger'>Erro ao excluir estágio: " . $e->getMessage() . "</div>";
        }
    }
?>

<section class="section">
    <div class="container">
        <h2 class="title has-text-centered">Lista de Estágios</h2>

        <?php if (!empty($estagios)): ?>
            <table class="table is-fullwidth">
                <thead>
                    <tr>
                        <th>Curso</th>
                        <th>Funcionário</th>
                        <th>Data</th>
                        <th>Horário</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($estagios as $estagio): ?>
                        <tr>
                            <td><?= htmlspecialchars($estagio['empresa'] ?? '') ?></td>
                            <td><?= htmlspecialchars($estagio['funcionario'] ?? '') ?></td>
                            <td><?= htmlspecialchars($estagio['data'] ?? '') ?></td>
                            <td><?= htmlspecialchars($estagio['horario'] ?? '') ?></td>
                            <td>
                                <a href="editar_estagio.php?id=<?= htmlspecialchars($estagio['id']) ?>" class="button is-link">Editar Estágio</a>
                                <a href="feedback_estagio.php?id=<?= htmlspecialchars($estagio['id']) ?>" class="button is-link">Ver Relatório</a>
                            </td>
                        </tr> 
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="notification is-warning">Você não tem estágios para exibir.</p>
        <?php endif; ?>
    </div>
</section>

<div class="has-text-centered">
    <a class="button is-light" href="conteudo.php">Voltar para Conteúdo</a>
</div>

<?php
} else {
    echo "<p class='notification is-danger'>Erro: Usuário não autenticado.</p>";
    exit();
}

include 'footer.php';
?>
