<?php 
    $isProprietario = false; 
    $isAdmin = false; 
    $isLoggato = false;
    
    if (isset($templateParams["utente"]) && !is_null($templateParams["utente"])) {
        $isLoggato = true;
        $ruolo = strtolower($templateParams["utente"]["ruolo"]);
        $isProprietario = ($ruolo == "proprietario");
        $isAdmin = ($ruolo == "admin"); // Controllo ruolo admin
    }
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" type="text/css" href="./css/style.css">
    <title><?php echo $templateParams["titolo"]; ?></title>
</head>

<body class="d-flex flex-column min-vh-100">

<!-- Desktop Header -->
<header class="d-none d-lg-flex justify-content-between align-items-center p-3 bg-unibo-red shadow-sm">
    <a href="index.php">
        <img src="upload/logoUnibo.png" alt="Logo" style="height: 65px;">
    </a>
    <nav class="d-flex gap-5 fs-5">
        <a <?php isActive("index.php");?> href="index.php">Home</a>
        <div class="vr bg-white" style="height: 30px; opacity: 1;"></div>
        <a <?php isActive("preferiti.php");?> href="preferiti.php">Salvati</a>
        
        <div class="vr bg-white" style="height: 30px; opacity: 1;"></div>
        <?php if($isProprietario): ?>
            <a <?php isActive("pubblica.php");?> href="pubblica.php">Pubblica</a>
            <div class="vr bg-white" style="height: 30px; opacity: 1;"></div>
            <a <?php isActive("miei-annunci.php");?> href="miei-annunci.php">Annunci</a>
        <?php else: ?>
            <a <?php isActive("richiedi.php");?> href="richiedi.php">Richiedi</a>
            <div class="vr bg-white" style="height: 30px; opacity: 1;"></div>
            <a <?php isActive("prenotazioni.php");?> href="prenotazioni.php">Prenotazioni</a>
        <?php endif; ?>
        <?php if($isAdmin): ?>
            <div class="vr bg-white" style="height: 30px; opacity: 1;"></div>
            <a <?php isActive("admin-index.php");?> href="admin-index.php" class="fw-bold text-warning">Admin Panel</a>
        <?php endif; ?>
    </nav>
    <?php if($isLoggato): ?>
        <a <?php isActive("profilo.php");?> href="profilo.php" class="text-white">
            <i class="bi bi-person-circle fs-2"></i>
        </a>
    <?php else: ?>
        <div class="d-flex gap-2">
            <a href="registrazione.php" class="btn btn-outline-light rounded-3 px-3 py-1 fw-semibold">Register</a>
            <a href="login.php" class="btn btn-outline-light rounded-3 px-3 py-1 fw-semibold">Sign in</a>
        </div>
    <?php endif; ?>
</header>

<!-- Tablet Header -->
<header class="d-none d-md-flex d-lg-none justify-content-between align-items-center p-3 bg-unibo-red shadow-sm">
    <a href="index.php">
        <img src="upload/logoUnibo.png" alt="Logo" style="height: 50px;">
    </a>
    <div class="d-flex gap-4 align-items-center">
        <?php if($isLoggato): ?>
            <a <?php isActive("profilo.php");?> href="profilo.php" class="text-white">
                <i class="bi bi-person-circle fs-4"></i>
            </a>
        <?php else: ?>
            <a href="registrazione.php" class="btn btn-sm btn-outline-light rounded-pill px-3">Register</a>
            <a href="login.php" class="btn btn-sm btn-outline-light rounded-pill px-3">Sign in</a>
        <?php endif; ?>
    </div>
</header>

<!-- Mobile Header -->
<header class="d-flex d-md-none justify-content-between align-items-center p-3 bg-unibo-red shadow-sm">
    <a href="index.php">
        <img src="upload/logoUnibo.png" alt="Logo" style="height: 50px;">
    </a>
    <?php if($isLoggato): ?>
        <a <?php isActive("profilo.php");?> href="profilo.php" class="text-white">
            <i class="bi bi-person-circle" style="font-size: 32px;"></i>
        </a>
    <?php else: ?>
        <a href="registrazione.php" class="btn btn-sm btn-outline-light rounded-pill px-3">Register</a>
        <a href="login.php" class="btn btn-sm btn-outline-light rounded-pill px-3">Sign in</a>
    <?php endif; ?>
</header>

<main class="flex-grow-1 container-xl py-5">
    <?php if(isset($templateParams["nome"])) { require($templateParams["nome"]); } ?>
</main>

<footer class="bg-unibo-red py-3 mt-auto">
        <div class="container text-center text-white d-flex flex-column gap-1">
            <p class="fw-bold mb-0" style="font-size: 14px;">Campus Housing - Università di Bologna</p>
            <p class="mb-0" style="font-size: 13px;">Alma Mater Studiorum - Campus di Cesena</p>
            <p class="mb-0 opacity-75" style="font-size: 12px;">© A.A. 2025-2026 Tecnologie Web - Aresu Marco, Fronzi
                Andrea, Siboni Pietro</p>
        </div>
    </footer>

<nav class="fixed-bottom bg-white border-top shadow d-md-none">
    <ul style="list-style: none; display: flex; justify-content: space-around; padding: 10px; margin: 0;">
        <li style="text-align: center;">
            <a <?php isActive("index.php");?> href="index.php" class="text-dark text-decoration-none">
                <i class="bi bi-house" style="font-size: 24px;"></i>
                <p style="margin: 0; font-size: 0.8rem;">Home</p>
            </a>
        </li>
        <li style="text-align: center;">
            <a <?php isActive("preferiti.php");?> href="preferiti.php" class="text-dark text-decoration-none">
                <i class="bi bi-heart" style="font-size: 24px;"></i>
                <p style="margin: 0; font-size: 0.8rem;">Salvati</p>
            </a>
        </li>
        <?php if($isProprietario): ?>
            <li style="text-align: center;">
                <a <?php isActive("pubblica.php");?> href="pubblica.php" class="text-dark text-decoration-none">
                    <i class="bi bi-plus-circle" style="font-size: 24px;"></i>
                    <p style="margin: 0; font-size: 0.8rem;">Pubblica</p>
                </a>
            </li>
            <li style="text-align: center;">
                <a <?php isActive("miei-annunci.php");?> href="miei-annunci.php" class="text-dark text-decoration-none">
                    <i class="bi bi-pin-angle" style="font-size: 24px;"></i>
                    <p style="margin: 0; font-size: 0.8rem;">Annunci</p>
                </a>
            </li>
        <?php else: ?>
            <li style="text-align: center;">
                <a <?php isActive("richiedi.php");?> href="richiedi.php" class="text-dark text-decoration-none">
                    <i class="bi bi-arrow-up-circle" style="font-size: 24px;"></i>
                    <p style="margin: 0; font-size: 0.8rem;">Richiedi</p>
                </a>
            </li>
            <li style="text-align: center;">
                <a <?php isActive("prenotazioni.php");?> href="prenotazioni.php" class="text-dark text-decoration-none">
                    <i class="bi bi-calendar-event" style="font-size: 24px;"></i>
                    <p style="margin: 0; font-size: 0.8rem;">Prenotazioni</p>
                </a>
            </li>
        <?php endif; ?>
    </ul>
</nav>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/preferiti.js"></script>
</body>
</html>