<?php require __DIR__ . "/header.php"; ?>

<section class="section">
    <div class="container">
        <h1 class="title">Listagem de Usuários</h1>
        <table class="table is-fullwidth is-striped">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Perfil Ativo</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if (isset($usuarios)): ?>
                    <?php foreach ($usuarios as $usuario): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($usuario->getUsername()); ?></td>
                            <td><?php echo htmlspecialchars($usuario->getPassword()); ?></td>
                            <td><?= $usuario->getAtivo() == "1"?"Sim":"Não" ?></td>
                            <td>
                                <a class="button is-small is-info" href="/index.php?acao=editar&id=<?=$usuario->getUsername()?>">Editar</a>
                                <a class="button is-small is-danger" href="/index.php?acao=excluir&id=<?=$usuario->getUsername()?>">Excluir</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="has-text-centered"><strong>Base de dados vazia!</strong></td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php require __DIR__ . "/footer.php"; ?>