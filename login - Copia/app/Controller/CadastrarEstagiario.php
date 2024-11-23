<?php
require __DIR__.'/../Database/Conectar.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capturar dados do POST
    $nome = $_POST['nome'] ?? null;
    $cpf_cnpj = $_POST['cpf_cnpj'] ?? null;
    $telefone = $_POST['telefone'] ?? null;
    $data_nascimento = $_POST['data_nascimento'] ?? null;
    $estagio_id = $_POST['estagio_id'] ?? null;
    $duracao = $_POST['duracao'] ?? null;
    $data_inicio = $_POST['data_inicio'] ?? null;
    $usuarioId = $_POST['usuario_id'] ?? null;

    if (!$usuarioId) {
        die("Erro: ID do usuário não enviado. Verifique o formulário.");
    }

    $databasePath = __DIR__ . '/../../banco.db';

    try {
        $pdo = new PDO("sqlite:" . $databasePath);

        $stmt = $pdo->prepare("INSERT INTO estagiarios (nome, cpf_cnpj, telefone, data_nascimento, estagio_id, duracao, data_inicio, usuario_id) 
                               VALUES (:nome, :cpf_cnpj, :telefone, :data_nascimento, :estagio_id, :duracao, :data_inicio, :usuario_id)");
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':cpf_cnpj', $cpf_cnpj);
        $stmt->bindParam(':telefone', $telefone);
        $stmt->bindParam(':data_nascimento', $data_nascimento);
        $stmt->bindParam(':estagio_id', $estagio_id);
        $stmt->bindParam(':duracao', $duracao);
        $stmt->bindParam(':data_inicio', $data_inicio);
        $stmt->bindParam(':usuario_id', $usuarioId);

        if ($stmt->execute()) {
            header("Location: /../registro_estagiario.php?message=sucesso");
            exit;
        } else {
            echo "Erro ao cadastrar o estagiário.";
        }
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
}
?>
