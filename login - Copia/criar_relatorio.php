<?php
include 'header.php';
session_start();
require_once __DIR__ . "/app/model/Estagiobanco.php";
$Estagiobanco = new Estagiosbanco();


$usuarioId = $_SESSION['usuario_id'] ?? null;

if ($usuarioId) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['enviar_relatorio'])) {
        // Recebe os dados do relatório
        $estagioId = $_POST['estagio_id'];
        $relatorio = $_POST['relatorio'];

        try {
           
            $pdo = new PDO("sqlite:banco.db");
            $stmt = $pdo->prepare("INSERT INTO relatorios (estagio_id, usuario_id, relatorio) VALUES (:estagio_id, :usuario_id, :relatorio)");
            $stmt->bindParam(':estagio_id', $estagioId, PDO::PARAM_INT);
            $stmt->bindParam(':usuario_id', $usuarioId, PDO::PARAM_INT);
            $stmt->bindParam(':relatorio', $relatorio, PDO::PARAM_STR);
            $stmt->execute();

            $mensagem = "<p class='notification is-success'>Relatório enviado com sucesso!</p>";
        } catch (PDOException $e) {
            $mensagem = "<p class='notification is-danger'>Erro ao enviar relatório: " . $e->getMessage() . "</p>";
        }
    }

   
    $estagios = $Estagiobanco->listarestagios($usuarioId);
?>

<section class="section">
    <div class="container">
        <h2 class="title has-text-centered">Relatório do Estágio</h2>

        <?php if (isset($mensagem)) { echo $mensagem; } ?>

        <?php if (!empty($estagios)): ?>
        
            <form method="post" action="">
                <div class="field">
                    <label class="label">Escolha o estágio:</label>
                    <div class="control">
                        <select class="input" name="estagio_id" required>
                            <?php foreach ($estagios as $estagio): ?>
                                <option value="<?= htmlspecialchars($estagio['id']) ?>">
                                    <?= htmlspecialchars($estagio['empresa']) ?> - <?= htmlspecialchars($estagio['data']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="field">
                    <label class="label">Relatório:</label>
                    <div class="control">
                        <textarea class="textarea" name="relatorio" required></textarea>
                    </div>
                </div>

                <div class="field">
                    <div class="control">
                        <button class="button is-primary" type="submit" name="enviar_relatorio">Enviar Relatório</button>
                    </div>
                </div>
                <div class="has-text-centered">
            <a class="button is-light" href="conteudo.php">Voltar para Conteúdo</a>
        </div>
            </form>
        <?php else: ?>
            <p class="notification is-warning">Você não tem estágios para gerar relatórios.</p>
        <?php endif; ?>

    </div>
</section>

<?php
} else {
    echo "<p class='notification is-danger'>Erro: Usuário não autenticado.</p>";
    exit();
}

include 'footer.php';
?>
