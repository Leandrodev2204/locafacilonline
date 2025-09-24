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

try {
    $database = new Database();
    $db = $database->getConnection();
    
    // Buscar carros disponíveis com informações da categoria
    $query = "SELECT c.*, cat.nome as categoria_nome 
              FROM carros c 
              LEFT JOIN categorias cat ON c.categoria_id = cat.id 
              WHERE c.status = 'disponivel'
              ORDER BY c.categoria_id, c.valor_diaria"; 
    $stmt = $db->prepare($query);
    $stmt->execute();
    $carros = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
} catch (PDOException $e) {
    echo "<div class='alert alert-danger'>Erro ao carregar frota: " . $e->getMessage() . "</div>";
    $carros = [];
} catch (Exception $e) {
    echo "<div class='alert alert-danger'>Erro: " . $e->getMessage() . "</div>";
    $carros = [];
}

// POSSÍVEIS LOCAIS (filesystem) + URL correspondentes para a pasta de imagens.
// Ajuste / remova entradas conforme sua estrutura real.
$img_locations = [
    ['dir' => __DIR__ . '/img/',        'url' => 'img/'],       // pasta img ao lado deste arquivo
    ['dir' => __DIR__ . '/../img/',     'url' => '../img/'],    // img um nível acima
    ['dir' => __DIR__ . '/../../img/',  'url' => '../../img/'], // img dois níveis acima
    ['dir' => $_SERVER['DOCUMENT_ROOT'] . '/img/', 'url' => '/img/'], // img na raiz do site (ex: /img/)
];

function resolve_image_src(array $img_locations, ?string $dbValue) : string {
    // limpa e pega só o basename (evita que o DB tenha caminhos perigosos)
    $filename = trim((string) $dbValue);
    $filename = basename($filename); // remove quaisquer subpastas
    if ($filename === '' || strtolower($filename) === 'null') {
        $filename = 'carro_defult.jpg';
    }

    // procura arquivo fisicamente nas pastas listadas
    foreach ($img_locations as $loc) {
        $fullpath = $loc['dir'] . $filename;
        if (is_file($fullpath)) {
            // retorna a url relativa/absoluta que será usada no atributo src
            return $loc['url'] . rawurlencode($filename);
        }
    }

    // se DB já contém uma URL absoluta ou caminho iniciado por '/', use-a (verifica sintaxe)
    if (!empty($dbValue)) {
        if (preg_match('#^(https?://|/)#i', $dbValue)) {
            return $dbValue;
        }
    }

    // fallback: primeira URL da lista + default.jpg (garanta que exista default.jpg)
    return $img_locations[0]['url'] . 'carro_defult.jpg';
}
?>

<section class="container py-5">
    <h2 class="text-center mb-4 text-success">Nossa Frota de Veículos</h2>
    
    <?php if (empty($carros)): ?>
        <div class="alert alert-warning text-center">
            Nenhum veículo disponível no momento.
        </div>
    <?php else: ?>
        <div class="row">
            <?php foreach ($carros as $carro): 
                // Resolve a URL da imagem para esse carro (verifica vários locais)
                $imgSrc = resolve_image_src($img_locations, $carro['imagem_principal'] ?? '');
            ?>
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <!-- Exibe a imagem do veículo -->
                    <img src="<?= htmlspecialchars($imgSrc, ENT_QUOTES, 'UTF-8') ?>" 
                         class="card-img-top" 
                         alt="<?= htmlspecialchars(($carro['marca'] ?? '') . ' ' . ($carro['modelo'] ?? ''), ENT_QUOTES, 'UTF-8') ?>"
                         style="height: 200px; object-fit: cover;">
                    
                    <div class="card-body">
                        <h5 class="card-title">
                            <?= htmlspecialchars(($carro['marca'] ?? '') . ' ' . ($carro['modelo'] ?? ''), ENT_QUOTES, 'UTF-8') ?>
                        </h5>
                        <p class="card-text">
                            <small class="text-muted">
                                <?= htmlspecialchars($carro['categoria_nome'] ?? 'Sem categoria', ENT_QUOTES, 'UTF-8') ?>
                            </small><br>
                            <?= nl2br(htmlspecialchars($carro['descricao'] ?? 'Sem descrição', ENT_QUOTES, 'UTF-8')) ?>
                        </p>
                        <p class="text-success fw-bold">
                            R$ <?= number_format($carro['valor_diaria'] ?? 0, 2, ',', '.') ?> / dia
                        </p>
                        <a href="reserva.php?carro_id=<?= (int) $carro['id'] ?>" 
                           class="btn btn-success w-100">Reservar</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</section>

<?php include __DIR__ . '/partials/footer.php'; ?>
