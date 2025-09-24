<?php 
// Proteção de acesso
require __DIR__ . '/protect.php';

// Cabeçalho
include __DIR__ . '/partials/header.php';

// Verifica vários caminhos possíveis para encontrar o arquivo Database.php
$possible_paths = [
    __DIR__ . '/Database.php',
    __DIR__ . '/../Database.php',
    __DIR__ . '/config/Database.php',
    __DIR__ . '/includes/Database.php',
    __DIR__ . '/classes/Database.php'
];

$database_loaded = false;
foreach ($possible_paths as $path) {
    if (file_exists($path)) {
        require_once $path;
        $database_loaded = true;
        break;
    }
}

if (!$database_loaded) {
    die("<div class='alert alert-danger'>Erro: Arquivo Database.php não encontrado!</div>");
}

// Captura o ID do carro
$carro_id = filter_input(INPUT_GET, 'carro_id', FILTER_VALIDATE_INT);

if (!$carro_id) {
    header("Location: frota.php");
    exit;
}

try {
    // Conexão com o banco
    $database = new Database();
    $db = $database->getConnection();
    
    // Busca os dados do veículo
    $query = "SELECT * FROM carros WHERE id = :id AND status = 'disponivel'";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':id', $carro_id, PDO::PARAM_INT);
    $stmt->execute();
    $carro = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // Se não encontrou veículo disponível
    if (!$carro) {
        $_SESSION['erro'] = "Veículo não disponível para reserva";
        header("Location: frota.php");
        exit;
    }
    
} catch (PDOException $e) {
    echo "<div class='alert alert-danger'>Erro: " . $e->getMessage() . "</div>";
    $carro = null;
}
?>

<section class="container py-5">
    <h2 class="text-center text-success mb-4">Reserva de Veículo</h2>

    <?php if ($carro): ?>
        <div class="alert alert-info">
            <strong>Veículo selecionado:</strong><br>
            <?= htmlspecialchars($carro['marca'] . ' ' . $carro['modelo']) ?><br>
            <strong>Valor diária:</strong> 
            R$ <?= number_format($carro['valor_diaria'], 2, ',', '.') ?>
        </div>

        <form method="post" action="salvar_reserva.php">
            <input type="hidden" name="carro_id" value="<?= $carro['id'] ?>">
            
            <h4 class="mb-3">Dados Pessoais</h4>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="nome" class="form-label">Nome Completo *</label>
                    <input type="text" name="nome" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="email" class="form-label">E-mail *</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="cpf" class="form-label">CPF *</label>
                    <input type="text" name="cpf" class="form-control" placeholder="000.000.000-00" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="telefone" class="form-label">Telefone *</label>
                    <input type="tel" name="telefone" class="form-control" placeholder="(11) 99999-9999" required>
                </div>
            </div>

            <h4 class="mb-3 mt-4">Período da Locação</h4>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="data_inicio" class="form-label">Data de Retirada *</label>
                    <input type="date" name="data_inicio" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="data_fim" class="form-label">Data de Devolução *</label>
                    <input type="date" name="data_fim" class="form-control" required>
                </div>
            </div>

            <button type="submit" class="btn btn-success btn-lg mt-3">Confirmar Reserva</button>
            <a href="frota.php" class="btn btn-secondary btn-lg mt-3 ms-2">Voltar</a>
        </form>
    <?php endif; ?>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const hoje = new Date().toISOString().split('T')[0];
    document.querySelectorAll('input[type="date"]').forEach(input => {
        input.min = hoje;
    });
});
</script>

<?php include __DIR__ . '/partials/footer.php'; ?>
