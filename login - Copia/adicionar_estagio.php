<?php
session_start(); 
require_once __DIR__ . "/app/model/Estagiobanco.php";

include 'header.php';


$usuarioId = $_SESSION['usuario_id'] ?? null;

if ($usuarioId) {
    
    if (isset($_POST['empresa'], $_POST['funcionario'], $_POST['data'], $_POST['horario'], $_POST['duracao'])) {
        
        $empresa = $_POST['empresa'];
        $funcionario = $_POST['funcionario'];
        $data = $_POST['data'];
        $horario = $_POST['horario'];
        $duracaoMeses = $_POST['duracao'];

        
        $dataInicio = new DateTime($data);
        $dataTermino = clone $dataInicio;
        $dataTermino->modify("+$duracaoMeses months");
        $dataTerminoStr = $dataTermino->format('Y-m-d');

       
        $Estagiobanco = new Estagiosbanco();
        $novoEstagioId = $Estagiobanco->cadastrarestagios($empresa, $funcionario, $data, $dataTerminoStr, $horario, $usuarioId,$duracaoMeses);

        if ($novoEstagioId) {
            try {
                
                $pdo = new PDO("sqlite:banco.db");
                $sql = "INSERT INTO user_est (usuario_id, estagio_id) VALUES (:usuario_id, :estagio_id)";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':usuario_id', $usuarioId, PDO::PARAM_INT);
                $stmt->bindParam(':estagio_id', $novoEstagioId, PDO::PARAM_INT);
                $stmt->execute();

                echo "<p class='notification is-success'>Estágio e associação salvos com sucesso!</p>";
            } catch (PDOException $e) {
                echo "<p class='notification is-danger'>Erro ao associar o estágio ao usuário: " . $e->getMessage() . "</p>";
            }
        } else {
            echo "<p class='notification is-danger'>Erro ao salvar o estágio.</p>";
        }
    }
}
?>

<section class="section">
    <div class="container">
        <h2 class="title has-text-centered">Adicionar Estágio</h2>
        <form method="post" action="">
            <div class="field">
                <label class="label">Curso:</label>
                <div class="control">
                    <input class="input" type="text" name="empresa" required>
                </div>
            </div>
            <div class="field">
                <label class="label">Número de Funcionário:</label>
                <div class="control">
                    <input class="input" type="number" name="funcionario" required>
                </div>
            </div>
            <div class="field">
                <label class="label">Data de Início:</label>
                <div class="control">
                    <input class="input" type="date" name="data" required>
                </div>
            </div>
            <div class="field">
                <label class="label">Horário:</label>
                <div class="control">
                    <input class="input" type="time" name="horario" required>
                </div>
            </div>
            <div class="field">
                <label class="label">Duração (em meses):</label>
                <div class="control">
                    <input class="input" type="number" name="duracao" required>
                </div>
            </div>
            <div class="field">
                <div class="control">
                    <input class="button is-primary" type="submit" value="Adicionar Estágio">
                </div>
            </div>
        </form>
        <div class="has-text-centered">
            <a class="button is-light" href="conteudo.php">Voltar para Conteúdo</a>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>
