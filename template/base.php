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

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="css/style.css">

    <title><?php echo $templateParams["titolo"]; ?></title>
</head>

<body class="d-flex flex-column min-vh-100">
    <!-- Desktop -->
    <header class=" d-lg-flex justify-content-between align-items-center p-3 bg-unibo-red shadow-sm">
        <a href="index.php">
            <img src="upload/logoUnibo.png" alt="Logo" style="height: 65px;">
        </a>
        <a href="utente.php"><i class="bi text bi-person-circle fs-2"></i></a>
    </header>

    <main class="flex-grow-1 container-xl py-5">
        <?php
        if (isset($templateParams["nome"])) {
            require($templateParams["nome"]);
        }
        ?>
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
                <a href="index.php" style="text-decoration: none; color: black;">
                    <i class="bi bi-house" style="font-size: 24px;"></i>
                    <p style="margin: 0; font-size: 0.8rem;">Home</p>
                </a>
            </li>
            <li style="text-align: center;">
                <a href="preferiti.html" style="text-decoration: none; color: black;">
                    <i class="bi bi-heart" style="font-size: 24px;"></i>
                    <p style="margin: 0; font-size: 0.8rem;">Salvati</p>
                </a>
            </li>
            <li style="text-align: center;">
                <a href="richiedi-delega.html" style="text-decoration: none; color: black;">
                    <i class="bi bi-plus-circle" style="font-size: 24px;"></i>
                    <p style="margin: 0; font-size: 0.8rem;">Richiedi</p>
                </a>
            </li>
            <li style="text-align: center;">
                <a href="prenotazioni.html" style="text-decoration: none; color: black;">
                    <i class="bi bi-calendar-event" style="font-size: 24px;"></i>
                    <p style="margin: 0; font-size: 0.8rem;">Prenotazioni</p>
                </a>
            </li>
        </ul>
    </nav>

<div class="modal fade" id="modalPrenotazione" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-unibo-red text-white">
                <h5 class="modal-title">Prenota una Stanza</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="processa-prenotazione.php" method="POST">
                <div class="modal-body">
                    <input type="hidden" id="modal-id-alloggio" name="id_alloggio">
                    
                    <div class="mb-3">
                        <label for="stanzaSelect" class="form-label fw-bold">Seleziona la stanza:</label>
                        <select class="form-select" id="stanzaSelect" name="id_stanza" required>
                            <option value="">Caricamento stanze...</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                    <button type="submit" id="btn-conferma-prenota" class="btn btn-unibo-red text-white fw-bold" disabled>Conferma Prenotazione</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/preferiti.js"></script>
<script src="js/prenotazione.js"></script> </body>
</body>

</html>