<?php

include 'header.php';
session_start();
require_once 'app/Database/Conectar.php';
require_once 'app/Model/Estagiario.php';

$pdo = new PDO("sqlite:banco.db");
$estagiarioModel = new Estagiario($pdo);


if (isset($_GET['id'])) {
    $id = $_GET['id'];

    
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['acao']) && $_POST['acao'] === 'excluir') {
        $stmt = $pdo->prepare("DELETE FROM estagiarios WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            header("Location: listar_estagiarios.php?message=excluido");
            exit;
        } else {
            echo "Erro ao excluir o estagiário.";
        }
    }

    
    $stmt = $pdo->prepare("SELECT * FROM estagiarios WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $estagiario = $stmt->fetch(PDO::FETCH_ASSOC);

    
    if (!$estagiario) {
        header('Location: listar_estagiarios.php');
        exit;
    }
} else {
    header('Location: listar_estagiarios.php');
    exit;
}


if ($_SERVER['REQUEST_METHOD'] == 'POST' && !isset($_POST['acao'])) {
    
    $nome = $_POST['nome'];
    $cpf_cnpj = $_POST['cpf_cnpj'];
    $telefone = $_POST['telefone'];
    $empresa = $_POST['empresa'];
    $data_inicio = $_POST['data_inicio'];
    $duracao = $_POST['duracao'];

   
    $stmt = $pdo->prepare("UPDATE estagiarios SET nome = :nome, cpf_cnpj = :cpf_cnpj, telefone = :telefone, empresa = :empresa, data_inicio = :data_inicio, duracao = :duracao WHERE id = :id");
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':cpf_cnpj', $cpf_cnpj);
    $stmt->bindParam(':telefone', $telefone);
    $stmt->bindParam(':empresa', $empresa);
    $stmt->bindParam(':data_inicio', $data_inicio);
    $stmt->bindParam(':duracao', $duracao);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        header("Location: listar_estagiarios.php?message=sucesso");
        exit;
    } else {
        echo "Erro ao atualizar o estagiário.";
    }
}
?>

<section class="section">
    <div class="container">
        <h2 class="title has-text-centered">Editar Estagiário</h2>

        <!-- Formulário de atualização do estagiário -->
        <form action="editar_estagiario.php?id=<?= $id ?>" method="POST">
            <div class="field">
                <label class="label">Nome</label>
                <div class="control">
                    <input class="input" type="text" name="nome" value="<?= htmlspecialchars($estagiario['nome'] ?? '') ?>" required>
                </div>
            </div>

            <div class="field">
                <label class="label">CPF/CNPJ</label>
                <div class="control">
                    <input class="input" type="text" name="cpf_cnpj" value="<?= htmlspecialchars($estagiario['cpf_cnpj'] ?? '') ?>" required>
                </div>
            </div>

            <div class="field">
                <label class="label">Telefone</label>
                <div class="control">
                    <input class="input" type="text" name="telefone" value="<?= htmlspecialchars($estagiario['telefone'] ?? '') ?>" required>
                </div>
            </div>

            <div class="field">
                <label class="label">Curso</label>
                <div class="control">
                    <input class="input" type="text" name="empresa" value="<?= htmlspecialchars($estagiario['empresa'] ?? '') ?>" required>
                </div>
            </div>

            <div class="field">
                <label class="label">Data de Início</label>
                <div class="control">
                    <input class="input" type="date" name="data_inicio" value="<?= htmlspecialchars($estagiario['data_inicio'] ?? '') ?>" required>
                </div>
            </div>

            <div class="field">
                <label class="label">Duração (meses)</label>
                <div class="control">
                    <input class="input" type="number" name="duracao" value="<?= htmlspecialchars($estagiario['duracao'] ?? '') ?>" required>
                </div>
            </div>

            <div class="field">
                <div class="control">
                    <button class="button is-primary" type="submit">Atualizar</button>
                </div>
            </div>
        </form>

        <!-- Formulário de exclusão do estagiário -->
        <form action="editarEstagiario.php?id=<?= $id ?>" method="POST" onsubmit="return confirm('Tem certeza de que deseja excluir este estagiário?');">
            <input type="hidden" name="acao" value="excluir">
            <div class="field">
                <div class="control">
                    <button class="button is-danger" type="submit">Excluir Estagiário</button>
                </div>
            </div>
        </form>
    </div>
</section>

<div class="has-text-centered">
    <a class="button is-light" href="listar_estagiarios.php">Voltar para a lista</a>
</div>

<?php include 'footer.php'; ?>
