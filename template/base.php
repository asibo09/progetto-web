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
<?php 
    // Definiamo la home in base al ruolo
    $homeUrl = (isset($_SESSION["ruolo"]) && $_SESSION["ruolo"] == 'admin') ? "admin-index.php" : "index.php";
?>
<!-- Desktop -->
<header class="d-none d-lg-flex justify-content-between align-items-center p-3 bg-unibo-red shadow-sm text-white">
    <a href="<?php echo $homeUrl; ?>">
        <img src="upload/logoUnibo.png" alt="Logo" style="height: 65px;">
    </a>
    <nav class="d-flex gap-5 fs-5 align-items-center">
        <?php if(isUserLoggedInID()): ?>
            <?php if($_SESSION["ruolo"] == 'studente'): ?>
                <a <?php isActive("index.php");?> href="index.php">Home</a>
                <div class="vr bg-white" style="height: 30px; opacity: 1;"></div>
                <a <?php isActive("preferiti.php");?> href="preferiti.php">Salvati</a>
                <div class="vr bg-white" style="height: 30px; opacity: 1;"></div>
                <a <?php isActive("richiestaSubaffitto.php");?> href="richiestaSubaffitto.php">Richiedi</a>
                <div class="vr bg-white" style="height: 30px; opacity: 1;"></div>
                <a <?php isActive("prenotazioni.php");?> href="prenotazioni.php">Prenotazioni</a>
            <?php elseif($_SESSION["ruolo"] == 'proprietario'): ?>
                <a <?php isActive("index.php");?> href="index.php">Home</a>
                <div class="vr bg-white" style="height: 30px; opacity: 1;"></div>
                <a <?php isActive("preferiti.php");?> href="preferiti.php">Salvati</a>
                <div class="vr bg-white" style="height: 30px; opacity: 1;"></div>
                <a <?php isActive("pubblica-annuncio.php");?> href="pubblica-annuncio.php">Pubblica</a>
                <div class="vr bg-white" style="height: 30px; opacity: 1;"></div>
                <a <?php isActive("iMieiAnnunci.php");?> href="iMieiAnnunci.php">Annunci</a>
            <?php endif; ?>
        <?php endif; ?>
    </nav>
    <div class="d-flex align-items-center gap-3">
        <?php if(!isUserLoggedInID()): ?>
            <a href="registrazione.php" class="btn btn-outline-light btn-sm fw-bold">Registrati</a>
            <a href="login.php" class="btn btn-light btn-sm fw-bold text-danger">Login</a>
        <?php else: ?>
            <a <?php isActive("utente.php");?> href="utente.php" class="text-white" title="Vai al tuo profilo"><em class="bi bi-person-circle fs-2"></em></a>
        <?php endif; ?>
    </div>
</header>

<!-- Tablet -->
<header class="d-none d-md-flex d-lg-none justify-content-between align-items-center p-3 bg-unibo-red shadow-sm text-white">
    <a href="<?php echo $homeUrl; ?>"><img src="upload/logoUnibo.png" alt="Logo" style="height: 50px;"></a>
    <div class="d-flex gap-4 align-items-center">
        <?php if(isUserLoggedInID()): ?>
            <?php if($_SESSION["ruolo"] == 'studente'): ?>
                <a <?php isActive("preferiti.php");?> href="preferiti.php"><em class="bi bi-heart fs-4"></em></a>
                <a <?php isActive("richiestaSubaffitto.php");?> href="richiestaSubaffitto.php"><em class="bi bi-arrow-up-circle fs-4"></em></a>
                <a <?php isActive("prenotazioni.php");?> href="prenotazioni.php"><em class="bi bi-calendar-event fs-4"></em></a>
            <?php elseif($_SESSION["ruolo"] == 'proprietario'): ?>
                <a <?php isActive("preferiti.php");?> href="preferiti.php"><em class="bi bi-heart fs-4"></em></a>
                <a <?php isActive("pubblica-annuncio.php");?> href="pubblica-annuncio.php"><em class="bi bi-plus-circle fs-4"></em></a>
                <a <?php isActive("iMieiAnnunci.php");?> href="iMieiAnnunci.php"><em class="bi bi-pin fs-4"></em></a>
            <?php endif; ?>
            <a <?php isActive("utente.php");?> href="utente.php" title="Vai al tuo profilo"><em class="bi bi-person-circle fs-4 text-white"></em></a>
        <?php else: ?>
            <a href="registrazione.php" class="btn btn-outline-light btn-sm fw-bold">Registrati</a>
            <a href="login.php" class="btn btn-light btn-sm fw-bold text-danger">Login</a>
        <?php endif; ?>
    </div>
</header>

<!-- Mobile -->
<header class="d-flex d-md-none justify-content-between align-items-center p-3 bg-unibo-red shadow-sm text-white">
    <a href="<?php echo $homeUrl; ?>"><img src="upload/logoUnibo.png" alt="Logo" style="height: 45px;"></a>
    <div class="d-flex align-items-center gap-2"> 
        <?php if(isUserLoggedInID()): ?>
            <a <?php isActive("utente.php");?> href="utente.php" title="Vai al tuo profilo">
                <em class="bi bi-person-circle fs-2 text-white"></em>
            </a>
        <?php else: ?>
            <a href="registrazione.php" class="btn btn-outline-light btn-sm fw-bold">Registrati</a>
            <a href="login.php" class="btn btn-light btn-sm fw-bold text-danger">Login</a>
        <?php endif; ?> 
    </div>
</header>

<main class="flex-grow-1 container-xl py-5">
    <?php if(isset($templateParams["nome"])) { require($templateParams["nome"]); } ?>
</main>

<nav class="fixed-bottom bg-white border-top shadow d-md-none">
    <?php if(isUserLoggedInID() && $_SESSION["ruolo"] != 'admin'): ?>
    <ul style="list-style: none; display: flex; justify-content: space-around; padding: 10px; margin: 0;">
        <li style="text-align: center;">
            <a <?php isActive("index.php");?> href="index.php" class="text-dark text-decoration-none text-center d-block">
                <em class="bi bi-house fs-4"></em><p class="m-0 small">Home</p>
            </a>
        </li>
        <li style="text-align: center;">
            <a <?php isActive("preferiti.php");?> href="preferiti.php" class="text-dark text-decoration-none text-center d-block">
                <em class="bi bi-heart fs-4"></em><p class="m-0 small">Salvati</p>
            </a>
        </li>
        <?php if($_SESSION["ruolo"] == 'studente'): ?>
            <li style="text-align: center;">
                <a <?php isActive("richiestaSubaffitto.php");?> href="richiestaSubaffitto.php" class="text-dark text-decoration-none text-center d-block">
                    <em class="bi bi-plus-circle fs-4"></em><p class="m-0 small">Richiedi</p>
                </a>
            </li>
            <li style="text-align: center;">
                <a <?php isActive("prenotazioni.php");?> href="prenotazioni.php" class="text-dark text-decoration-none text-center d-block">
                    <em class="bi bi-calendar-event fs-4"></em><p class="m-0 small">Prenota</p>
                </a>
            </li>
        <?php else: ?>
            <li style="text-align: center;">
                <a <?php isActive("pubblica-annuncio.php");?> href="pubblica-annuncio.php" class="text-dark text-decoration-none text-center d-block">
                    <em class="bi bi-plus-circle fs-4"></em><p class="m-0 small">Pubblica</p>
                </a>
            </li>
            <li style="text-align: center;">
                <a <?php isActive("iMieiAnnunci.php");?> href="iMieiAnnunci.php" class="text-dark text-decoration-none text-center d-block">
                    <em class="bi bi-pin fs-4"></em><p class="m-0 small">Annunci</p>
                </a>
            </li>
        <?php endif; ?>
    </ul>
    <?php endif; ?>
</nav>

<footer class="bg-unibo-red py-3 mt-auto">
    <div class="container text-center text-white d-flex flex-column gap-1">
        <p class="fw-bold mb-0" style="font-size: 14px;">Campus Housing - Università di Bologna</p>
        <p class="mb-0" style="font-size: 13px;">Alma Mater Studiorum - Campus di Cesena</p>
        <p class="mb-0 opacity-75" style="font-size: 12px;">© A.A. 2025-2026 Tecnologie Web - Aresu Marco, Fronzi
                Andrea, Siboni Pietro</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/preferiti.js"></script>
<script src="js/prenotazione.js"></script>
</body>
</html>