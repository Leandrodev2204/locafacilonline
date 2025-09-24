<?php
//Inclui o arquivo de proteção, só loga se for um usuário cadastrado
require __DIR__ . '/protect.php';

//Verifica se o usuário é admin
if ($_SESSION['role'] === 'admin') {
  header('Location: admin.php');
  exit;
}
//Inclui o cabeçalho 
include __DIR__ . '/partials/header.php';
?>
<div class="d-flex align-items-center justify-content-between mb-3">
  <h2 class="h4 mb-0">Página do Usuário</h2>
  <span class="badge text-bg-secondary">Perfil: User</span>
</div>

<div class="alert alert-success">
  <strong>Bem-vindo(a)!</strong> Você está logado como <u><?php echo htmlspecialchars($_SESSION['first_name'] . ' ' . $_SESSION['last_name']); ?></u>.
</div>

<section class="hero text-center text-white d-flex align-items-center justify-content-center">
    <div class="container">
        <h1>Bem-vindo à Sua Locadora de Confiança</h1>
        <p>Alugue o carro ideal com segurança, conforto e praticidade.</p>
       <a href="frota.php" class="btn btn-success btn-lg mt-3">Alugar um Carro</a>
    </div>
</section>

<!-- Features Section -->
<section class="features py-5">
    <div class="container text-center">
        <h2 class="mb-4">Nossos Serviços</h2>
        <div class="row">
            <div class="col-md-4">
                <h4>Frota Variada</h4>
                <p>Modelos econômicos, sedans, SUVs e muito mais.</p>
            </div>
            <div class="col-md-4">
                <h4>Atendimento 24h</h4>
                <p>Suporte e assistência sempre que você precisar.</p>
            </div>
            <div class="col-md-4">
                <h4>Preços Competitivos</h4>
                <p>As melhores condições para você economizar.</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta text-center text-white py-5 bg-secondary">
    <div class="container">
        <h2>Pronto para pegar a estrada?</h2>
        <a href="frota.php" class="btn btn-light btn-lg mt-3">Ver Frota</a>
    </div>
</section>


<!-- inclue o footer no código -->
<?php include __DIR__ . '/partials/footer.php'; ?>
