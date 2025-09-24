<?php 
include('header.php');
// Mensagens de feedback
if (isset($_SESSION['sucesso'])) {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            ' . $_SESSION['sucesso'] . '
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
          </div>';
    unset($_SESSION['sucesso']);
}
if (isset($_SESSION['erro'])) {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            ' . $_SESSION['erro'] . '
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
          </div>';
    unset($_SESSION['erro']);
}
?>

<!-- Hero Section -->
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

<?php include('footer.php'); ?>


