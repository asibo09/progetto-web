<div class="container py-5 text-center">
    <h1 class="fw-bold mb-1"><?php echo $userData["nome"] . " " . $userData["cognome"]; ?></h1>
    <p class="h5 text-muted mb-5"><?php echo $userData["ruolo"]; ?></p>

    <div class="row justify-content-center">
        <div class="col-lg-10 p-4 p-md-5 border rounded-4 bg-light">
            <div class="row row-cols-1 row-cols-md-2 g-4 text-dark">
                
                <div class="col">
                    <div class="card h-100 p-4 shadow-sm card-menu-hover position-relative rounded-3">
                        <i class="bi bi-person-vcard fs-1 mb-2"></i>
                        <h3 class="h5 fw-bold">I TUOI DATI</h3>
                        <p class="text-muted small mb-0">Gestisci le tue informazioni personali e di contatto</p>
                        <a href="dati.php" class="stretched-link"></a>
                    </div>
                </div>

                <div class="col">
                    <div class="card h-100 p-4 shadow-sm card-menu-hover position-relative rounded-3">
                        <i class="bi bi-pin fs-1 mb-2"></i>
                        <h3 class="h5 fw-bold">I MIEI ANNUNCI</h3>
                        <p class="text-muted small mb-0">Ritrova gli alloggi che hai messo in affitto</p>
                        <a href="iMieiAnnunci.php" class="stretched-link"></a>
                    </div>
                </div>

                <div class="col">
                    <div class="card h-100 p-4 shadow-sm card-menu-hover position-relative rounded-3">
                        <i class="bi bi-bell fs-1 mb-2"></i>
                        <h3 class="h5 fw-bold">NOTIFICHE</h3>
                        <p class="text-muted small mb-0">Rimani aggiornato su messaggi e novità</p>
                        <a href="badgeNotifiche.php" class="stretched-link"></a>
                    </div>
                </div>

                <div class="col">
                    <div class="card h-100 p-4 shadow-sm card-menu-hover position-relative rounded-3">
                        <i class="bi bi-box-arrow-right fs-1 mb-2"></i>
                        <h3 class="h5 fw-bold">ESCI</h3>
                        <p class="text-muted small mb-0">Termina la tua sessione di lavoro</p>
                        <a href="logout.php" class="stretched-link"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>