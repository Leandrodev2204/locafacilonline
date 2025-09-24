<?php
require __DIR__ . '/protect.php';
include __DIR__ . '/partials/header.php';

// Verifica caminhos possíveis para Database.php
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
if (!$database_loaded) die("<div class='alert alert-danger'>Erro: Arquivo Database.php não encontrado!</div>");

// Processa o formulário quando enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $assunto = trim($_POST['assunto'] ?? '');
    $mensagem = trim($_POST['mensagem'] ?? '');

    if ($nome && $email && $assunto && $mensagem) {
        try {
            $database = new Database();
            $db = $database->getConnection();

            $stmt = $db->prepare("INSERT INTO contatos (nome, email, assunto, mensagem)
                                  VALUES (:nome, :email, :assunto, :mensagem)");

            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':assunto', $assunto);
            $stmt->bindParam(':mensagem', $mensagem);

            $stmt->execute();

            echo "<div class='alert alert-success text-center'>Mensagem enviada com sucesso!</div>";

            // Limpa o POST para evitar reenvio
            $_POST = [];

        } catch (PDOException $e) {
            echo "<div class='alert alert-danger text-center'>Erro ao enviar mensagem: " . $e->getMessage() . "</div>";
        }
    } else {
        echo "<div class='alert alert-warning text-center'>Todos os campos são obrigatórios.</div>";
    }
}
?>

<section class="container py-5">
    <h2 class="text-center mb-4 text-success">Fale Conosco</h2>
    <p class="text-center mb-5">Tem alguma dúvida, sugestão ou precisa de ajuda? Envie uma mensagem!</p>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="" method="post">
                <div class="mb-3">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" name="nome" id="nome" class="form-control" required value="<?= htmlspecialchars($_POST['nome'] ?? '') ?>">
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" name="email" id="email" class="form-control" required value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
                </div>

                <div class="mb-3">
                    <label for="assunto" class="form-label">Assunto</label>
                    <input type="text" name="assunto" id="assunto" class="form-control" required value="<?= htmlspecialchars($_POST['assunto'] ?? '') ?>">
                </div>

                <div class="mb-3">
                    <label for="mensagem" class="form-label">Mensagem</label>
                    <textarea name="mensagem" id="mensagem" rows="5" class="form-control" required><?= htmlspecialchars($_POST['mensagem'] ?? '') ?></textarea>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-success btn-lg">Enviar Mensagem</button>
                </div>
            </form>
        </div>
    </div>
</section>

<?php include __DIR__ . '/partials/footer.php'; ?>
