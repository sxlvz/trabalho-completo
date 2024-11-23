<?php require __DIR__ . "/header.php"; ?>

<style>
    


    .button {
        border-radius: 6px; /* Bordas suaves */
        font-weight: 600;    /* Fonte mais forte */
        font-size: 1rem;     /* Tamanho de fonte uniforme */
        padding: 0.75rem;    /* Padding para dar mais espaço no botão */
        transition: all 0.3s ease; /* Animação suave ao passar o mouse */
    }

    /* Botões com cores mais suaves e neutras */
    .button.is-primary {
        background-color: #6C7DFF; /* Azul suave */
        border-color: #6C7DFF;
        color: white;
    }

    .button.is-primary:hover {
        background-color: #5A6CDB; /* Azul mais escuro no hover */
        border-color: #5A6CDB;
        color: white;
    }

    .button.is-danger {
        background-color: #D9534F; /* Vermelho suave para "Sair" */
        border-color: #D9534F;
        color: white;
    }

    .button.is-danger:hover {
        background-color: #C1443F; /* Vermelho mais escuro no hover */
        border-color: #C1443F;
    }

    /* Estilo para os Títulos */
    .title {
        font-size: 2rem;
        color: white;
        font-weight: 700;
        margin-bottom: 1.5rem;
    }

    .content {
        margin-bottom: 2rem;
    }

    /* Ajustes para tornar o layout mais limpo e organizado */
    .column.is-half {
        max-width: 700px;
    }

    .has-text-centered {
        text-align: center;
    }

    .button.is-fullwidth {
        width: 100%;
        margin-bottom: 1rem; /* Espaçamento entre os botões */
    }
</style>

<section class="section">
    <div class="container">
        <div class="columns is-centered">
            <div class="column is-half">
                <div class="box">
                    <?php
                    // Exibe o nome de usuário, se houver, ou uma saudação genérica
                    $username = isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : 'Nosso Querido Empresário';
                    ?>
                    <h1 class="title has-text-centered"><?php echo "Bem-vindo, " . $username . "!"; ?></h1>
                    <p class="has-text-centered">Aqui estão os conteúdos disponíveis para você acessar.</p>

                    <div class="content">
                        <div class="has-text-centered">
                            <!-- Botões principais -->
                            <a href="adicionar_estagio.php" class="button is-primary is-fullwidth mb-3">Adicionar Estágio da Sua Empresa</a>
                            <a href="listar_estagios.php" class="button is-primary is-fullwidth mb-3">Listar Seus Estágios</a>
                            <a href="avaliar_estagio.php" class="button is-primary is-fullwidth mb-3">Avaliar Estágio</a>
                            <a href="criar_relatorio.php" class="button is-primary is-fullwidth mb-3">Criar Relatório de Estágio</a>
                            <a href="registro_estagiario.php" class="button is-primary is-fullwidth mb-3">Registrar novo Estagiário</a>
                            <a href="listar_estagiarios.php" class="button is-primary is-fullwidth mb-3">Listar os Estagiários</a>
                        </div>
                    </div>

                    <!-- Botão de logout -->
                    <div class="has-text-centered">
                        <a href="logout.php" class="button is-danger is-fullwidth">Sair</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require __DIR__ . "/footer.php"; ?>
