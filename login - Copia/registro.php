<?php
require __DIR__ . "/header.php"; 

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


if (isset($_SESSION['mensagem_sucesso'])) {
    echo '<div class="notification is-success">' . $_SESSION['mensagem_sucesso'] . '</div>';
    unset($_SESSION['mensagem_sucesso']);
} elseif (isset($_SESSION['mensagem_erro'])) {
    echo '<div class="notification is-danger">' . $_SESSION['mensagem_erro'] . '</div>';
    unset($_SESSION['mensagem_erro']);
}

?>
<section class="section">
    <div class="container">
        <div class="columns is-centered">
            <div class="column is-half">
                <div class="box">
                    <h1 class="title has-text-centered">Registro</h1>
                    <?php
                    if (isset($_SESSION['mensagem_erro'])) {
                        echo '<div class="notification is-danger">' . $_SESSION['mensagem_erro'] . '</div>';
                        unset($_SESSION['mensagem_erro']);
                    }
                    ?>
                    <form action="index.php?acao=cadastra" method="post">
                        <div class="field">
                            <label class="label">Usuario/Email</label>
                            <div class="control">
                                <input class="input" type="text" placeholder="Seu usuário" name="usuario" required>
                            </div>
                        </div>
                        <div class="field">
                            <label class="label">Senha</label>
                            <div class="control">
                                <input class="input" type="password" placeholder="Sua senha" name="senha" required>
                            </div>
                        </div>
                        <div class="field">
                            <label class="label">Confirmação de Senha</label>
                            <div class="control">
                                <input class="input" type="password" placeholder="Confirme sua senha" name="confirmacao_senha" required>
                            </div>
                        </div>
                        <div class="field">
                            <div class="control">
                                <input type="submit" class="button is-primary is-fullwidth" value="Registrar">
                            </div>
                        </div>
                    </form>
                    <div class="has-text-centered" style="margin-top: 15px;">
                        <a href="login.php" class="button is-dark is-fullwidth mb-2">Voltar para Login</a>
                        <a href="inicio.php" class="button is-dark is-fullwidth">Voltar para o Início</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require __DIR__ . "/footer.php"; ?>

<?php require __DIR__ . "/footer.php"; ?>
