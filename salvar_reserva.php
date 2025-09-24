<?php
// Proteção de acesso
require __DIR__ . '/protect.php';

// Cabeçalho
include __DIR__ . '/partials/header.php';

// Verifica vários caminhos possíveis para Database.php
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

// Captura os dados enviados pelo formulário
$carro_id = $_POST['carro_id'] ?? null;
$nome = $_POST['nome'] ?? '';
$email = $_POST['email'] ?? '';
$cpf = $_POST['cpf'] ?? '';
$telefone = $_POST['telefone'] ?? '';
$data_inicio = $_POST['data_inicio'] ?? '';
$data_fim = $_POST['data_fim'] ?? '';

// Validação básica
if (!$carro_id || !$nome || !$email || !$cpf || !$telefone || !$data_inicio || !$data_fim) {
    die("<div class='alert alert-danger'>Todos os campos são obrigatórios.</div>");
}

try {
    // Conexão com o banco
    $database = new Database();
    $db = $database->getConnection();

    // Verifica se o carro ainda está disponível
    $stmt = $db->prepare("SELECT * FROM carros WHERE id = :id AND status = 'disponivel'");
    $stmt->bindParam(':id', $carro_id, PDO::PARAM_INT);
    $stmt->execute();
    $carro = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$carro) {
        $_SESSION['erro'] = "Veículo não disponível para reserva";
        header("Location: frota.php");
        exit;
    }

    // Converte datas para timestamps
$data_inicio_ts = strtotime($data_inicio);
$data_fim_ts = strtotime($data_fim);

// Calcula diferença em dias (+1 para incluir o dia de início)
$dias = ($data_fim_ts - $data_inicio_ts) / (60 * 60 * 24) + 1;

// Evita valores negativos ou zero
if ($dias <= 0) {
    die("<div class='alert alert-danger'>Datas inválidas.</div>");
}

// Calcula valor total
$valor_total = $dias * $carro['valor_diaria'];


    // Inserir reserva no banco
    $stmt = $db->prepare("INSERT INTO reservas
    (cliente_id, carro_id, data_inicio, data_fim, valor_total, status)
    VALUES
    (:cliente_id, :carro_id, :data_inicio, :data_fim, :valor_total, 'pendente')");

$stmt->bindParam(':cliente_id', $cliente_id);
$stmt->bindParam(':carro_id', $carro_id);
$stmt->bindParam(':data_inicio', $data_inicio);
$stmt->bindParam(':data_fim', $data_fim);
$stmt->bindParam(':valor_total', $valor_total);

$stmt->execute();

    // Atualiza status do carro para indisponível
    $stmt = $db->prepare("UPDATE carros SET status = 'indisponivel' WHERE id = :id");
    $stmt->bindParam(':id', $carro_id, PDO::PARAM_INT);
    $stmt->execute();

    echo "<div class='alert alert-success'>Reserva realizada com sucesso!</div>";
    echo "<a href='frota.php' class='btn btn-primary'>Voltar à frota</a>";

} catch (PDOException $e) {
    echo "<div class='alert alert-danger'>Erro ao salvar reserva: " . $e->getMessage() . "</div>";
}

include __DIR__ . '/partials/footer.php';
