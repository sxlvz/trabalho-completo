<?php


include 'header.php';
session_start();
require_once 'app/Database/Conectar.php';
require_once 'app/Model/Estagiario.php';

$pdo = new PDO("sqlite:banco.db");
$estagiarioModel = new Estagiario($pdo);


$estagiarios = $estagiarioModel->listarEstagiarios();


$message = $_GET['message'] ?? null;
?>

<section class="section">
    <div class="container">
        <h2 class="title has-text-centered">Lista de Estagiários</h2>

       
        <?php if ($message == 'sucesso'): ?>
            <div class="notification is-success has-text-centered">
                Operação realizada com sucesso!
            </div>
        <?php elseif ($message == 'excluido'): ?>
            <div class="notification is-warning has-text-centered">
                Estagiário excluído com sucesso!
            </div>
        <?php endif; ?>

        <?php if (!empty($estagiarios)): ?>
            <table class="table is-fullwidth is-hoverable">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>CPF/CNPJ</th>
                        <th>Telefone</th>
                        <th>Curso</th>
                        <th>Data de Início</th>
                        <th>Duração</th>
                        <th>Ações</th> 
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($estagiarios as $estagiario): ?>
                        <tr>
                            <td><?= htmlspecialchars($estagiario['nome'] ?? '') ?></td>
                            <td><?= htmlspecialchars($estagiario['cpf_cnpj'] ?? '') ?></td>
                            <td><?= htmlspecialchars($estagiario['telefone'] ?? '') ?></td>
                            <td><?= htmlspecialchars($estagiario['empresa'] ?? '') ?></td>
                            <td><?= htmlspecialchars($estagiario['data_inicio'] ?? '') ?></td>
                            <td><?= htmlspecialchars($estagiario['duracao'] ?? '') ?> meses</td>
                            <td>
                                <a href="editarEstagiario.php?id=<?= htmlspecialchars($estagiario['id']) ?>" class="button is-link">Editar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody> 
            </table>
        <?php else: ?> 
            <p class="notification is-warning">Nenhum estagiário cadastrado.</p>
        <?php endif; ?>
    </div>
</section>

<div class="has-text-centered">
    <a class="button is-light" href="conteudo.php">Voltar para Conteúdo</a>
</div>

<?php include 'footer.php'; ?>
