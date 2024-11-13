<?php

include 'header.php';

if (!isset($_GET['id'])) {
    echo "<p class='notification is-danger'>ID do estágio não especificado.</p>";
    exit; 
}

$db = new PDO('sqlite:banco.db');
$id = $_GET['id']; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['atualizar'])) {
        // Coleta os dados atualizados
        $empresa = $_POST['empresa'];
        $funcionario = $_POST['funcionario'];
        $data = $_POST['data'];
        $horario = $_POST['horario'];

      
        $stmt = $db->prepare("UPDATE estagios SET empresa = :empresa, funcionario = :funcionario, data = :data, horario = :horario WHERE id = :id");
        $stmt->bindValue(':empresa', $empresa, PDO::PARAM_STR);
        $stmt->bindValue(':funcionario', $funcionario, PDO::PARAM_STR);
        $stmt->bindValue(':data', $data, PDO::PARAM_STR);
        $stmt->bindValue(':horario', $horario, PDO::PARAM_STR);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        echo "<p class='notification is-success'>Estágio atualizado com sucesso!</p>";
    } elseif (isset($_POST['excluir'])) {
      
        $stmt = $db->prepare("DELETE FROM estagios WHERE id = :id");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

      
        header("Location: listar_estagios.php?message=excluido");
        exit;
    }
}


$stmt = $db->prepare("SELECT * FROM estagios WHERE id = :id");
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$result) {
    echo "<p class='notification is-danger'>Estágio não encontrado.</p>";
    exit;
}
?>

<section class="section">
    <div class="container">
        <h2 class="title has-text-centered">Editar Estágio</h2>
        <form method="post" action="">
            <div class="field">
                <label class="label">Empresa:</label>
                <div class="control">
                    <input class="input" type="text" name="empresa" value="<?= htmlspecialchars($result['empresa']) ?>" required>
                </div>
            </div>
            <div class="field">
                <label class="label">N° Funcionário:</label>
                <div class="control">
                    <input class="input" type="number" name="funcionario" value="<?= htmlspecialchars($result['funcionario']) ?>" required>
                </div>
            </div>
            <div class="field">
                <label class="label">Data:</label>
                <div class="control">
                    <input class="input" type="date" name="data" value="<?= htmlspecialchars($result['data']) ?>" required>
                </div>
            </div>
            <div class="field">
                <label class="label">Horário:</label>
                <div class="control">
                    <input class="input" type="time" name="horario" value="<?= htmlspecialchars($result['horario']) ?>" required>
                </div>
            </div>
            <div class="field">
                <div class="control">
                    <input class="button is-primary" type="submit" name="atualizar" value="Atualizar Estágio">
                    <button class="button is-danger" type="submit" name="excluir">Excluir Estágio</button>
                </div>
            </div>
        </form>
    </div>
</section>

<?php include 'footer.php'; ?>
