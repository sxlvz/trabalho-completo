<?php 
session_start();

require __DIR__ . "/header.php"; 
require_once __DIR__ . '/app/Model/Estagiobanco.php';

$estagioBanco = new Estagiosbanco();
$usuarioId = $_SESSION['usuario_id'];
$estagios = $estagioBanco->listarestagios($usuarioId);

// Verificar se existe uma mensagem de sucesso na URL
$message = $_GET['message'] ?? null;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Estagiário</title>
</head>
<body>
    <section class="section">
        <div class="container">

            <!-- Exibir mensagem de sucesso -->
            <?php if ($message === 'sucesso'): ?>
                <div class="notification is-success has-text-centered">
                    Cadastro concluído com sucesso!
                </div>
            <?php endif; ?>

            <div class="card" style="max-width: 800px; margin: auto;">
                <header class="card-header">
                    <p class="card-header-title is-centered title is-4">Cadastro de Estagiário</p>
                </header>
                <div class="card-content">
                    <form action="app/Controller/CadastrarEstagiario.php" method="POST">
                        
                        <!-- Campo para o Nome -->
                        <div class="field">
                            <label class="label" for="nome">Nome:</label>
                            <div class="control">
                                <input class="input" type="text" id="nome" name="nome" required>
                            </div>
                        </div>

                        <!-- Campo para o CPF/CNPJ com limite de 11 a 18 dígitos -->
                        <div class="field">
                            <label class="label" for="cpf_cnpj">CPF/CNPJ:</label>
                            <div class="control">
                                <input class="input" type="text" id="cpf_cnpj" name="cpf_cnpj" maxlength="18" pattern="\d{11,18}" title="CPF deve conter 11 ou CNPJ deve conter 14 dígitos numéricos" required>
                            </div>
                        </div>

                        <!-- Campo para Data de Nascimento -->
                        <div class="field">
                            <label class="label" for="data_nascimento">Data de Nascimento:</label>
                            <div class="control">
                                <input class="input" type="date" id="data_nascimento" name="data_nascimento" required>
                            </div>
                        </div>

                        <!-- Campo para Telefone com limite de 10 a 11 dígitos (com DDD) -->
                        <div class="field">
                            <label class="label" for="telefone">Telefone:</label>
                            <div class="control">
                                <input class="input" type="tel" id="telefone" name="telefone" minlength="10" maxlength="11" pattern="\d{10,11}" title="Telefone deve conter entre 10 e 11 dígitos numéricos, incluindo DDD" required>
                            </div>
                        </div>

                        <!-- Seleção do Estágio -->
                        <div class="field">
                            <label class="label" for="estagio_id">Selecione o Estágio:</label>
                            <div class="control">
                                <select class="input" name="estagio_id" id="estagio_id" onchange="selectEstagio()" required>
                                    <option value="" disabled selected>Selecione um estágio</option>
                                    <?php if (isset($estagios) && is_array($estagios) && count($estagios) > 0) : ?>
                                        <?php foreach ($estagios as $estagio): ?>
                                            <option value="<?= htmlspecialchars($estagio['id']) ?>" data-inicio="<?= htmlspecialchars($estagio['data']) ?>">
                                                <?= htmlspecialchars($estagio['empresa']) ?> - <?= htmlspecialchars($estagio['data']) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <option value="" disabled>Nenhum estágio disponível</option>
                                    <?php endif; ?>
                                </select>
                                <input type="hidden" id="data_inicio" name="data_inicio">
                            </div>
                        </div>

                        <!-- Duração do Estágio -->
                        <div class="field">
                            <label class="label" for="duracao">Duração (meses):</label>
                            <div class="control">
                                <input class="input" type="number" id="duracao" name="duracao" min="1" required>
                            </div>
                        </div>

                        <!-- Botão de Enviar -->
                        <div class="field">
                            <div class="control">
                                <button class="button is-primary is-fullwidth" type="submit">Cadastrar Estagiário</button>
                            </div>
                        </div>
                    </form>
                    <div class="has-text-centered">
                        <a class="button is-light" href="conteudo.php">Voltar para Conteúdo</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Script para selecionar a data de início do estágio -->
    <script>
        function selectEstagio() {
            const estagioSelect = document.getElementById('estagio_id');
            const selectedOption = estagioSelect.options[estagioSelect.selectedIndex];
            const dataInicio = selectedOption.getAttribute('data-inicio');
            document.getElementById('data_inicio').value = dataInicio;
            alert("Data de Início selecionada: " + dataInicio);
        }
    </script>
</body>
</html>
